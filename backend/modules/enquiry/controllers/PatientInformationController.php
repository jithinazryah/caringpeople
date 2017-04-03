<?php

namespace backend\modules\enquiry\controllers;

use Yii;
use common\models\PatientInformation;
use common\models\PatientInformationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Enquiry;

/**
 * PatientInformationController implements the CRUD actions for PatientInformation model.
 */
class PatientInformationController extends Controller {

        /**
         * @inheritdoc
         */
        public function behaviors() {
                return [
                    'verbs' => [
                        'class' => VerbFilter::className(),
                        'actions' => [
                            'delete' => ['POST'],
                        ],
                    ],
                ];
        }

        /**
         * Lists all PatientInformation models.
         * @return mixed
         */
        public function actionIndex() {
                $searchModel = new PatientInformationSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        /**
         * Displays a single PatientInformation model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
        }

        /**
         * Creates a new PatientInformation model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         * $id  is enquiry table id
         */
        public function actionCreate($id = false) {

                $model = new PatientInformation();
                $enquiry_data = Enquiry::find()->where(['id' => $id])->one();
                $check_data = PatientInformation::find()->where(['enquiry_id' => $id])->one();
                if ((!empty($enquiry_data))) {
                        if (empty($check_data)) {
                                $model = $this->SavePatientDatas($model, $enquiry_data);
                        } else {
                                return $this->redirect(['update', 'id' => $check_data->id]);
                        }
                }

                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
                        $model->follow_up_date = date('Y-m-d H:i:s', strtotime($model->follow_up_date));
                        if (Yii::$app->user->identity->branch_id != '0') {
                                Yii::$app->SetValues->currentBranch($model);
                        }
                        if ($model->save()) {
                                //   $model->patient_id = date('d') . date('m') . date('y') . '-' . sprintf("%03d", $model->id);
                                // $model->update();
                                return $this->redirect(['view', 'id' => $model->id]);
                        }
                }

                return $this->render('create', [
                            'model' => $model,
                ]);
        }

        /*
         * to save patient and contact person details from enquiry table to patient information table
         */

        public function SavePatientDatas($model, $enquiry_data) {
                $model->enquiry_id = $enquiry_data->id;
                $model->contact_name = $enquiry_data->caller_name;
                $model->contact_gender = $enquiry_data->caller_gender;
                $model->referral_source = $enquiry_data->referral_source;
                $model->contact_mobile_number_1 = $enquiry_data->mobile_number;
                $model->contact_mobile_number_2 = $enquiry_data->mobile_number_2;
                $model->contact_mobile_number_3 = $enquiry_data->mobile_number_3;
                $model->contact_city = $enquiry_data->city;
                $model->contact_zip_or_pc = $enquiry_data->zip_pc;
                $model->contact_email = $enquiry_data->email;
                $model->contact_perosn_relationship = $enquiry_data->relationship;
                $model->other_relationships = $enquiry_data->service_required_for_others;
                $model->contact_address = $enquiry_data->address;
                $model->patient_name = $enquiry_data->service_required_for;
                $model->patient_gender = $enquiry_data->person_gender;
                $model->patient_age = $enquiry_data->age;
                $model->patient_weight = $enquiry_data->weight;
                $model->veteran_or_spouse = $enquiry_data->veteran_or_spouse;
                $model->patient_address = $enquiry_data->person_address;
                $model->patient_city = $enquiry_data->person_city;
                $model->patient_postal_code = $enquiry_data->person_postal_code;
                $model->patient_current_status = $enquiry_data->patient_current_status;
                $model->notes = $enquiry_data->notes;
                return $model;
        }

        /**
         * Updates an existing PatientInformation model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {
                $model = $this->findModel($id);

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                } else {
                        return $this->render('update', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Deletes an existing PatientInformation model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
        }

        /**
         * Finds the PatientInformation model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return PatientInformation the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = PatientInformation::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

}
