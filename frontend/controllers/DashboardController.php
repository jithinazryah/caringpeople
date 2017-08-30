<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class DashboardController extends Controller {

        public $layout = '@app/views/layouts/dashboard';

        public function actionIndex() {
                $searchModel = new \common\models\ServiceSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andWhere(['patient_id' => Yii::$app->session['patient_id']]);
                $dataProvider->query->andWhere(['status' => 1]);
                $title = 'Services';
                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                            'title' => $title,
                ]);
        }

        public function actionViewSchedules($id) {
                $id = Yii::$app->EncryptDecrypt->Encrypt('decrypt', $id);
                $searchModel = new \common\models\ServiceScheduleSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andWhere(['service_id' => $id]);
                return $this->render('view-schedules', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        public function actionChangePassword() {

                $id = Yii::$app->user->identity->id;

                $model = \common\models\User::findOne($id);
                if (Yii::$app->request->post()) {
                        if (Yii::$app->getSecurity()->validatePassword(Yii::$app->request->post('old-password'), $model->password_hash)) {
                                if (Yii::$app->request->post('new-password') == Yii::$app->request->post('confirm-password')) {

                                        Yii::$app->getSession()->setFlash('success', 'Password changed successfully');
                                        $model->password_hash = Yii::$app->security->generatePasswordHash(Yii::$app->request->post('confirm-password'));
                                        $model->update();
                                        return $this->redirect(Yii::$app->request->referrer);
                                } else {
                                        Yii::$app->getSession()->setFlash('error', 'Password mismatch');
                                }
                        } else {
                                Yii::$app->getSession()->setFlash('error', 'Old password is wrong !');
                        }
                }
                return $this->render('change-password', [
                            'model' => $model,
                ]);
        }

        public function actionInvoices($id) {
                $id = Yii::$app->EncryptDecrypt->Encrypt('decrypt', $id);
                $searchModel = new \common\models\InvoiceSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andWhere(['service_id' => $id]);


                return $this->render('invoices', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        public function actionInvoicebill($id) {
                $model = \common\models\Invoice::findOne($id);
                echo $this->renderPartial('invoice_bill', [
                    'model' => $model,
                ]);
        }

        public function actionRemarks() {
                if (Yii::$app->request->isAjax) {
                        $schedule_id = $_POST['schedule_id'];
                        $form = $this->renderPartial('remarks', ['schedule_id' => $schedule_id]);
                        echo $form;
                }
        }

        public function actionAddRemarks() {
                if (Yii::$app->request->isAjax) {
                        $schedule_id = $_POST['scheduleid'];
                        $schedule = \common\models\ServiceSchedule::findOne($schedule_id);
                        $schedule->remarks_from_patient = $_POST['remarks_patient'];
                        $schedule->save();
                }
        }

        public function actionClosedServices() {
                $searchModel = new \common\models\ServiceSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andWhere(['patient_id' => Yii::$app->session['patient_id']]);
                $dataProvider->query->andWhere(['status' => 2]);
                $title = 'Closed Services';
                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                            'title' => $title,
                ]);
        }

}
