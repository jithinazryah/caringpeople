<?php

namespace backend\modules\accounts\controllers;

use Yii;
use common\models\StaffPayroll;
use common\models\StaffPayrollSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\ServiceSchedule;
use common\models\Service;

/**
 * StaffPayrollController implements the CRUD actions for StaffPayroll model.
 */
class StaffPayrollController extends Controller {

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
         * Lists all StaffPayroll models.
         * @return mixed
         */
        public function actionIndex() {
                $searchModel = new StaffPayrollSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        /**
         * Displays a single StaffPayroll model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
        }

        /**
         * Creates a new StaffPayroll model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {

                $model = new StaffPayroll();
                $model->scenario = 'payment';
                $service_schedule_amount = '';
                $paid_amount = '';
                $paided_details = '';
                $prev_date = '';
                $current_date = '';

                if (isset($_POST['get_amount'])) {
                        $model->load(Yii::$app->request->post());
                        $current_date = date('Y-m-d', strtotime('25-' . $model->month));
                        $prev_month = date('Y-m-d', strtotime($current_date . '-1 month'));
                        $prev_date = date('Y-m-d', strtotime($prev_month . ' + 1 days'));
                        $service_schedule_amount = ServiceSchedule::find()->where(['staff' => $model->staff_id])->andWhere(['>=', 'date', $prev_date])->andWhere(['<=', 'date', $current_date])->sum('rate');
                        $paid_amount = StaffPayroll::find()->where(['staff_id' => $model->staff_id, 'month' => $model->month])->sum('amount');
                        $paided_details = StaffPayroll::find()->where(['staff_id' => $model->staff_id, 'month' => $model->month])->all();
                        $model->scenario = 'cash-payment';
                } else if (isset($_POST['submit_amount'])) {

                        $model->load(Yii::$app->request->post());
                        if (!empty($model->payment_date))
                                $model->payment_date = date('Y-m-d', strtotime($model->payment_date));
                        $model->save(FALSE);
                        $model = new StaffPayroll();
                        Yii::$app->getSession()->setFlash('success', 'Payment added Successfully');
                }
                return $this->render('create', [
                            'model' => $model,
                            'service_schedule_amount' => $service_schedule_amount,
                            'paid_amount' => $paid_amount,
                            'paided_details' => $paided_details,
                            'prev_date' => $prev_date,
                            'current_date' => $current_date
                ]);
        }

        /**
         * Updates an existing StaffPayroll model.
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
         * Deletes an existing StaffPayroll model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
        }

        /**
         * Finds the StaffPayroll model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return StaffPayroll the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = StaffPayroll::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

}
