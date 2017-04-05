<?php

namespace backend\modules\patient\controllers;

use Yii;
use common\models\PatientEnquiryGeneralFirst;
use common\models\PatientEnquiryGeneralFirstSearch;
use common\models\PatientEnquiryGeneralSecond;
use common\models\PatientEnquiryHospitalFirst;
use common\models\PatientEnquiryHospitalSecond;
use common\models\Followups;
use common\models\FollowupsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PatientEnquiryGeneralFirstController implements the CRUD actions for PatientEnquiryGeneralFirst model.
 */
class PatientEnquiryGeneralFirstController extends Controller {

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
         * Lists all PatientEnquiryGeneralFirst models.
         * @return mixed
         */
        public function actionIndex() {
                $searchModel = new PatientEnquiryGeneralFirstSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        /**
         * Displays a single PatientEnquiryGeneralFirst model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                $patient_info_second = PatientEnquiryGeneralSecond::find()->where(['enquiry_id' => $id])->one();
                $patient_hospital = PatientEnquiryHospitalFirst::find()->where(['enquiry_id' => $id])->one();
                $patient_hospital_second = PatientEnquiryHospitalSecond::find()->where(['enquiry_id' => $id])->one();
                return $this->render('view', [
                            'model' => $this->findModel($id), 'patient_info_second' => $patient_info_second, 'patient_hospital' => $patient_hospital, 'patient_hospital_second' => $patient_hospital_second
                ]);
        }

        /**
         * Creates a new PatientEnquiryGeneralFirst model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {
                $patient_info = new PatientEnquiryGeneralFirst();
                $patient_info_second = new PatientEnquiryGeneralSecond();
                $patient_hospital = new PatientEnquiryHospitalFirst();
                $patient_hospital_second = new PatientEnquiryHospitalSecond();
                $followup_info = new Followups();
                $patient_info->scenario = 'create';

                if ($patient_info->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($patient_info) && $patient_hospital->load(Yii::$app->request->post()) && $patient_info_second->load(Yii::$app->request->post()) && $patient_hospital_second->load(Yii::$app->request->post())) {

                        $patient_info->contacted_date = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post()['PatientEnquiryGeneralFirst']['contacted_date']));
                        $patient_info->outgoing_call_date = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post()['PatientEnquiryGeneralFirst']['outgoing_call_date']));
                        $followup_info->load(Yii::$app->request->post());
                        $followup_info->status = '0';

                        if (Yii::$app->user->identity->branch_id != '0') {
                                Yii::$app->SetValues->currentBranch($patient_info);
                        }


                        if ($patient_info->validate() && $patient_info_second->validate() && $patient_hospital->validate() && $patient_hospital_second->validate() && $patient_info->save() && $patient_info_second->save() && $patient_hospital->save() && $patient_hospital_second->save()) {

                                if ($patient_info->branch_id == '1') {
                                        $code = 'CPCUE';
                                } else if ($patient_info->branch_id == '2') {
                                        $code = 'CPBUE';
                                }
                                $patient_info->enquiry_number = $code . '-' . date('d') . date('m') . date('y') . '-' . $patient_info->id;
                                $patient_info->update();
                                $this->AddGeneralInfo($patient_info, Yii::$app->request->post(), $patient_info_second);
                                $this->AddHospitalInfo($patient_info, Yii::$app->request->post(), $patient_hospital, $patient_hospital_second);
                                Yii::$app->Followups->addfollowups('0', $patient_info->id, $followup_info);
                                Yii::$app->History->UpdateHistory('patient-enquiry', $patient_info->id, 'create');
                                $this->sendMail($patient_info, $patient_info_second);
                                Yii::$app->getSession()->setFlash('success', 'General Information Added Successfully');
                                return $this->redirect(array('index'));
                        }
                }

                return $this->render('_enquiry_form', [
                            'patient_info' => $patient_info,
                            'patient_info_second' => $patient_info_second,
                            'patient_hospital' => $patient_hospital,
                            'patient_hospital_second' => $patient_hospital_second,
                            'followup_info' => $followup_info,
                ]);
        }

        /**
         * Updates an existing PatientEnquiryGeneralFirst model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {
                $patient_info = $this->findModel($id);
                $patient_info_second = PatientEnquiryGeneralSecond::find()->where(['enquiry_id' => $patient_info->id])->one();
                $patient_hospital = PatientEnquiryHospitalFirst::find()->where(['enquiry_id' => $patient_info->id])->one();
                $patient_hospital_second = PatientEnquiryHospitalSecond::find()->where(['enquiry_id' => $patient_info->id])->one();
                if (isset($_GET['followup']))
                        $followup_info = Followups::findOne($_GET['followup']);
                else
                        $followup_info = new Followups();

                $searchModel = new FollowupsSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andWhere(['type' => '0', 'type_id' => $id]);

                if (!empty($patient_info) && !empty($patient_info_second) && !empty($patient_hospital) && !empty($patient_hospital_second)) {

                        if ($patient_info->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($patient_info) && $patient_hospital->load(Yii::$app->request->post()) && $patient_info_second->load(Yii::$app->request->post()) && $patient_hospital_second->load(Yii::$app->request->post())) {

                                $patient_info->contacted_date = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post()['PatientEnquiryGeneralFirst']['contacted_date']));
                                $patient_info->outgoing_call_date = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post()['PatientEnquiryGeneralFirst']['outgoing_call_date']));
                                $followup_info->load(Yii::$app->request->post());

                                if ($patient_info->validate() && $patient_info->save() && $patient_info_second->validate() && $patient_info_second->save() && $patient_hospital->validate() && $patient_hospital->save() && $patient_hospital_second->validate() && $patient_hospital_second->save()) {

                                        $this->AddGeneralInfo($patient_info, Yii::$app->request->post(), $patient_info_second);
                                        $this->AddHospitalInfo($patient_info, Yii::$app->request->post(), $patient_hospital, $patient_hospital_second);
                                        if (isset($_GET['followup'])) {
                                                Yii::$app->Followups->Updatefollowups($_GET['followup'], $followup_info);
                                        } else {
                                                $followup_info->status = '0';
                                                Yii::$app->Followups->addfollowups('0', $patient_info->id, $followup_info);
                                        }
                                        Yii::$app->History->UpdateHistory('patient-enquiry', $patient_info->id, 'update');
                                        Yii::$app->getSession()->setFlash('success', 'Enquiry Updated Successfully');
                                        return $this->redirect(array('index'));
                                }
                        }
                        return $this->render('_enquiry_form', [
                                    'patient_info' => $patient_info,
                                    'patient_info_second' => $patient_info_second,
                                    'patient_hospital' => $patient_hospital,
                                    'patient_hospital_second' => $patient_hospital_second,
                                    'followup_info' => $followup_info,
                                    'dataProvider' => $dataProvider,
                                    'followup_id' => $_GET['followup'],
                        ]);
                } else {
                        throw new \yii\base\UserException("Error Code : 2000");
                }
        }

        /*
         * to add general second informations
         *  */

        public function AddGeneralInfo($patient_info, $data, $patient_info_second) {
                $patient_info->id;

                $patient_info_second->enquiry_id = $patient_info->id;
                $patient_info_second->load($data);
                $patient_info_second->expected_date_of_service = date('Y-m-d', strtotime($data['PatientEnquiryGeneralSecond']['expected_date_of_service']));
                if (!empty($data['PatientEnquiryGeneralSecond']['required_service']))
                        $patient_info_second->required_service = implode(",", $data['PatientEnquiryGeneralSecond']['required_service']);
                if ($patient_info_second->save(false)) {
                        return true;
                } else {
                        return FALSE;
                }
        }

        /*
         * to add hospital informations
         *  */

        public function AddHospitalInfo($patient_info, $data, $patient_hospital, $patient_hospital_second) {

                $patient_hospital->enquiry_id = $patient_info->id;
                $patient_hospital_second->enquiry_id = $patient_info->id;
                $patient_hospital->load($data);
                $patient_hospital_second->load($data);

                if ($patient_hospital->validate() && $patient_hospital->save() && $patient_hospital_second->validate() && $patient_hospital_second->save()) {
                        return true;
                } else {
                        return FALSE;
                }
        }

        /**
         * Deletes an existing PatientEnquiryGeneralFirst model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function sendMail($patient_info, $model) {

                $to = $model->email;
                $subject = 'Enquiry Received';
                $message = $this->renderPartial('send_mail', ['model' => $model, 'patient_info' => $patient_info]);

// To send HTML mail, the Content-type header must be set
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n" .
                        "From: info@caringpeople.in";
                mail($to, $subject, $message, $headers);
        }

        public function actionDelete($id) {

                $patient_info = $this->findModel($id);
                $patient_info_second = PatientEnquiryGeneralSecond::find()->where(['enquiry_id' => $id])->one();
                $patient_hospital = PatientEnquiryHospitalFirst::find()->where(['enquiry_id' => $id])->one();
                $patient_hospital_second = PatientEnquiryHospitalSecond::find()->where(['enquiry_id' => $id])->one();

// ...other DB operations...
// or alternatively

                $transaction = PatientEnquiryGeneralFirst::getDb()->beginTransaction();
                try {
                        if (!empty($patient_hospital_second)) {
                                $patient_hospital_second->delete();
                        }
                        if (!empty($patient_hospital)) {
                                $patient_hospital->delete();
                        }
                        if (!empty($patient_info_second)) {
                                $patient_info_second->delete();
                        }
                        if (!empty($patient_info)) {
                                $patient_info->delete();
                        }

// ...other DB operations...
                        $transaction->commit();
                } catch (\Exception $e) {
                        $transaction->rollBack();
                        throw $e;
                } catch (\Throwable $e) {
                        $transaction->rollBack();
                        throw $e;
                }
                Yii::$app->getSession()->setFlash('success', 'succuessfully deleted');
                return $this->redirect(['index']);
        }

        /**
         * Finds the PatientEnquiryGeneralFirst model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return PatientEnquiryGeneralFirst the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = PatientEnquiryGeneralFirst::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

}
