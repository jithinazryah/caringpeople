<?php

namespace backend\modules\enquiry\controllers;

use Yii;
use common\models\Enquiry;
use common\models\EnquirySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\EnquiryHospital;
use common\models\EnquiryOtherInfo;

/**
 * EnquiryController implements the CRUD actions for Enquiry model.
 */
class EnquiryController extends Controller {

        public function init() {
                if (Yii::$app->user->isGuest)
                        $this->redirect(['/site/index']);

                if (Yii::$app->session['post']['enquiry'] != 1)
                        $this->redirect(['/site/home']);
        }

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
         * Lists all Enquiry models.
         * @return mixed
         */
        public function actionIndex() {
                $searchModel = new EnquirySearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        /**
         * Displays a single Enquiry model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                $hospital_info = EnquiryHospital::findOne(['enquiry_id' => $id]);
                $other_info = EnquiryOtherInfo::findOne(['enquiry_id' => $id]);
                return $this->render('view', [
                            'model' => $this->findModel($id), 'hospital_info' => $hospital_info, 'other_info' => $other_info,
                ]);
        }

        /**
         * Creates a new Enquiry model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {
                $model = new Enquiry();
                $model->scenario = 'create';


                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) /* && Yii::$app->SetValues->currentBranch($model) /* && $model->save() */) {

                        $model->contacted_date = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post()['Enquiry']['contacted_date']));
                        $model->outgoing_call_date = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post()['Enquiry']['outgoing_call_date']));
                        if (Yii::$app->user->identity->branch_id != '0') {
                                Yii::$app->SetValues->currentBranch($model);
                        }

                        if ($model->validate() && $model->save()) {
                                $model->enquiry_id = date('d') . date('m') . date('y') . '-' . sprintf("%03d", $model->id);
                                $model->update();
                                Yii::$app->getSession()->setFlash('success', 'General Information Added Successfully');
                                return $this->redirect(['enquiry-hospital/create', 'id' => $model->id]);
                        } else {
                                return $this->render('create', [
                                            'model' => $model,
                                ]);
                        }
                }

                return $this->render('create', [
                            'model' => $model,
                ]);
        }

        /**
         * Updates an existing Enquiry model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {

                $model = $this->findModel($id);

                $hospital_info = EnquiryHospital::find()->where(['enquiry_id' => $model->id])->one();
                $other_info = EnquiryOtherInfo::find()->where(['enquiry_id' => $model->id])->one();
                if (!empty($model)) {


                        if ($model->load(Yii::$app->request->post())) {
                                $model->contacted_date = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post()['Enquiry']['contacted_date']));
                                $model->outgoing_call_date = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post()['Enquiry']['outgoing_call_date']));
                                if ($model->validate() && $model->save()) {
                                        Yii::$app->getSession()->setFlash('success', 'General Information Updated Successfully');
                                        return $this->redirect(Yii::$app->request->referrer);
                                }
                        }
                        return $this->render('update', [
                                    'model' => $model,
                                    'hospital_info' => $hospital_info,
                                    'other_info' => $other_info,
                        ]);
                } else {
                        return $this->redirect(['create']);
                }
        }

        /**
         * Deletes an existing Enquiry model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
                $enquiry = $this->findModel($id);
                $hospital_info = EnquiryHospital::find()->where(['enquiry_id' => $id])->one();
                $other_info = EnquiryOtherInfo::find()->where(['enquiry_id' => $id])->one();



                // ...other DB operations...
// or alternatively

                $transaction = Enquiry::getDb()->beginTransaction();
                try {
                        if (!empty($other_info)) {
                                $other_info->delete();
                        }
                        if (!empty($hospital_info)) {
                                $hospital_info->delete();
                        }
                        if (!empty($enquiry)) {
                                $enquiry->delete();
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
         * Finds the Enquiry model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return Enquiry the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = Enquiry::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

}
