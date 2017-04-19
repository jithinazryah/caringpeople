<?php

namespace backend\modules\enquiry\controllers;

use Yii;
use common\models\EnquiryOtherInfo;
use common\models\EnquiryOtherInfoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\EnquiryHospital;
use common\models\Enquiry;

/**
 * EnquiryOtherInfoController implements the CRUD actions for EnquiryOtherInfo model.
 */
class EnquiryOtherInfoController extends Controller {

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
         * Lists all EnquiryOtherInfo models.
         * @return mixed
         */
//	public function actionIndex() {
//		$searchModel = new EnquiryOtherInfoSearch();
//		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//
//		return $this->render('index', [
//			    'searchModel' => $searchModel,
//			    'dataProvider' => $dataProvider,
//		]);
//	}

        /**
         * Displays a single EnquiryOtherInfo model.
         * @param integer $id
         * @return mixed
         */
//	public function actionView($id) {
//		return $this->render('view', [
//			    'model' => $this->findModel($id),
//		]);
//	}

        /**
         * Creates a new EnquiryOtherInfo model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate($id = null) {
                /* $id is enquiry table auto increment id */


                if (!empty($id)) {
                        $hospital_info = EnquiryHospital::find()->where(['enquiry_id' => $id])->one();
                        $enquiry = Enquiry::find()->where(['id' => $id])->one();
                        if (!empty($enquiry)) {

                                $model = new EnquiryOtherInfo();
                                if ($model->load(Yii::$app->request->post())) {
                                        $model->nursing_assessment = date('Y-m-d', strtotime(Yii::$app->request->post()['EnquiryOtherInfo']['nursing_assessment']));
                                        $model->doctor_assessment = date('Y-m-d', strtotime(Yii::$app->request->post()['EnquiryOtherInfo']['doctor_assessment']));
                                        $model->followup_date = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post()['EnquiryOtherInfo']['followup_date']));
                                        $model->date_of_discharge = date('Y-m-d', strtotime(Yii::$app->request->post()['EnquiryOtherInfo']['date_of_discharge']));
                                        $model->expected_date_of_service = date('Y-m-d', strtotime(Yii::$app->request->post()['EnquiryOtherInfo']['expected_date_of_service']));
                                        $model->enquiry_id = $id;
                                        if ($model->validate() && $model->save()) {
                                                Yii::$app->getSession()->setFlash('success', 'Other Information Added Successfully');
                                                if ($hospital_info->required_service == '1') {
                                                        $required_service = 'Doctor Visit';
                                                } elseif ($hospital_info->required_service == '2') {
                                                        $required_service = 'Nursing Care';
                                                } elseif ($hospital_info->required_service == '3') {
                                                        $required_service = 'Physiotherapy';
                                                } elseif ($hospital_info->required_service == '4') {
                                                        $required_service = 'Companion Care';
                                                } elseif ($hospital_info->required_service == '5') {
                                                        $required_service = 'Bystander Service';
                                                } elseif ($hospital_info->required_service == '6') {
                                                        $required_service = 'General Information';
                                                }


                                                /* sending email */
//                                                $to = $enquiry->email;
//                                                $subject = 'Enquiry';
//                                                $message = '<html>
//                                                                <head>
//                                                                <title>Enquiry</title>
//                                                                </head>
//                                                                <body>
//                                                                <div class = "mail-body" style="width: 50%;text-align: center;border: 1px solid #000;">
//                                                                <div class = "content" style="margin-left:26px;">
//                                                                <img src="' . Yii::$app->homeUrl . '/images/logos/logo-1.png" style="width:200px">
//                                                                <h2>Enquiry </h2>
//
//                                                                <p>Hi ' . $enquiry->caller_name . ',</p>
//                                                                <p>Your request for ' . $required_service . ' has been accepted. We will contact you soon.</p>
//
//                                                                </div>
//                                                                </div>
//
//
//
//                                                                </body>
//                                                                </html>';
                                                // To send HTML mail, the Content-type header must be set
//                                                $headers = 'MIME-Version: 1.0' . "\r\n";
//                                                $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n" .
//                                                        "From: 'noreplay@caringpeople.com";
//                                                mail($to, $subject, $message, $headers);
                                                /* sending email */
                                                return $this->redirect(['update', 'id' => $id]);
                                        }
                                } else {
                                        return $this->render('create', [
                                                    'model' => $model,
                                                    'enquiry' => $enquiry,
                                                    'hospital_info' => $hospital_info,
                                        ]);
                                }
                        } else {
                                return $this->redirect(['enquiry/create']);
                        }
                } else {
                        return $this->redirect(['enquiry-hospital/create', 'id' => $id]);
                }
        }

        /**
         * Updates an existing EnquiryOtherInfo model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {
                $enquiry = \common\models\Enquiry::find()->where(['id' => $id])->one();
                $hospital_info = EnquiryHospital::find()->where(['enquiry_id' => $id])->one();
                $model = EnquiryOtherInfo::find()->where(['enquiry_id' => $id])->one();

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                        $model->nursing_assessment = date('Y-m-d', strtotime(Yii::$app->request->post()['EnquiryOtherInfo']['nursing_assessment']));
                        $model->doctor_assessment = date('Y-m-d', strtotime(Yii::$app->request->post()['EnquiryOtherInfo']['doctor_assessment']));
                        $model->followup_date = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post()['EnquiryOtherInfo']['followup_date']));
                        $model->date_of_discharge = date('Y-m-d', strtotime(Yii::$app->request->post()['EnquiryOtherInfo']['date_of_discharge']));
                        $model->expected_date_of_service = date('Y-m-d', strtotime(Yii::$app->request->post()['EnquiryOtherInfo']['expected_date_of_service']));
                        if ($model->validate() && $model->save()) {
                                Yii::$app->getSession()->setFlash('success', 'Other Information Updated Successfully');
                                return $this->redirect(['enquiry/index']);
                        }
                }
                return $this->render('update', [
                            'model' => $model,
                            'enquiry' => $enquiry,
                            'hospital_info' => $hospital_info,
                ]);
        }

        /**
         * Deletes an existing EnquiryOtherInfo model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
//	public function actionDelete($id) {
//		$this->findModel($id)->delete();
//
//		return $this->redirect(['index']);
//	}

        /**
         * Finds the EnquiryOtherInfo model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return EnquiryOtherInfo the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = EnquiryOtherInfo::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

}
