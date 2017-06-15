<?php

namespace backend\modules\services\controllers;

use Yii;
use common\models\Service;
use common\models\ServiceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Branch;
use common\models\MasterServiceTypes;

/**
 * ServiceController implements the CRUD actions for Service model.
 */
class ServiceController extends Controller {

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
         * Lists all Service models.
         * @return mixed
         */
        public function actionIndex() {
                $searchModel = new ServiceSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                if (Yii::$app->session['post']['id'] == '5') {
                        $dataProvider->query->andWhere(['IN', 'day_staff', Yii::$app->user->identity->id])->orWhere(['IN', 'night_staff', Yii::$app->user->identity->id]);
                } else if (Yii::$app->session['post']['id'] != '1') {
                        $dataProvider->query->andWhere(['branch_id' => Yii::$app->user->identity->branch_id]);
                }
                if (!empty(Yii::$app->request->queryParams['ServiceSearch']['status'])) {
                        $dataProvider->query->andWhere(['status' => Yii::$app->request->queryParams['ServiceSearch']['status']]);
                } else {
                        $dataProvider->query->andWhere(['<>', 'status', 2]);
                }

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        /**
         * Displays a single Service model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
        }

        /**
         * Creates a new Service model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {
                $model = new Service();
                $model->setScenario('create');

                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {

                        $model->from_date = date('Y-m-d', strtotime($model->from_date));
                        $model->to_date = date('Y-m-d', strtotime($model->to_date));
                        $model->duty_type = Yii::$app->request->post()['Service']['duty_type'];
                        $model->day_staff = Yii::$app->request->post()['Service']['day_staff'];
                        $model->night_staff = Yii::$app->request->post()['Service']['night_staff'];
                        $model->patient_advance_payment = Yii::$app->request->post()['Service']['patient_advance_payment'];
                        if (Yii::$app->user->identity->branch_id != '0') {
                                Yii::$app->SetValues->currentBranch($model);
                        } else {
                                $model->branch_id = Yii::$app->request->post()['Service']['branch_id'];
                        }
                        $branch_details = Branch::find()->where(['id' => $model->branch_id])->one();
                        $service_type = $this->ServiceType($model->service);
                        $code = $branch_details->branch_code . 'SR-' . $service_type . '-' . date('d') . date('m') . date('y');
                        $model->service_id = $code;
                        if ($model->validate() && $model->save()) {
                                $staff_availabilty = Yii::$app->SetValues->StaffAvailabilty($model);
                                $history_id = Yii::$app->SetValues->ServiceHistory($model, 1); /* 1 implies masterservice history type id 1 for new service */
                                if (!empty($history_id)) {
                                        $notifiactions = [
                                                [$history_id, $model->id, 1, 1, $model->day_staff], /* history_id,service_id,1 => notification type is service ,1=>day staff */
                                                [$history_id, $model->id, 1, 2, $model->night_staff], /* history_id,service_id,1 => notification type is service ,1=>night staff */
                                                [$history_id, $model->id, 1, 3, $model->staff_manager], /* history_id,service_id,1 => notification type is service ,1=>manager */
                                                [$history_id, $model->id, 1, 4, $model->CB], /* history_id,service_id,1 => notification type is service ,1=>superadmin */
                                        ];
                                        Yii::$app->SetValues->Notifications($history_id, $model->id, $notifiactions);
                                }

                                return $this->redirect(['/followup/followups/followups', 'type_id' => $model->id, 'type' => 5, 'service' => 'service']);
                        }
                }
                return $this->render('create', [
                            'model' => $model,
                ]);
        }

        /**
         * Updates an existing Service model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {
                $model = $this->findModel($id);
                $before_update = $this->findModel($id);

                if ($model->load(Yii::$app->request->post())) {

                        $model->from_date = date('Y-m-d', strtotime($model->from_date));
                        $model->to_date = date('Y-m-d', strtotime($model->to_date));
                        $model->duty_type = Yii::$app->request->post()['Service']['duty_type'];
                        $model->day_staff = Yii::$app->request->post()['Service']['day_staff'];
                        $model->night_staff = Yii::$app->request->post()['Service']['night_staff'];
                        $model->patient_advance_payment = Yii::$app->request->post()['Service']['patient_advance_payment'];
                        if ($model->validate() && $model->save()) {
                                $staff_availabilty = Yii::$app->SetValues->StaffAvailabilty($model, $before_update);
                                return $this->redirect(['/followup/followups/followups', 'type_id' => $model->id, 'type' => 5, 'service' => 'service']);
                        }
                }
                return $this->render('create', [
                            'model' => $model,
                ]);
        }

        public function ServiceType($service_type_id) {
                switch ($service_type_id) {
                        case 1:
                                $result = 'DV';
                                break;
                        case 2:
                                $result = 'NC';
                                break;
                        case 3:
                                $result = 'CS';
                                break;
                        case 4:
                                $result = 'PR';
                                break;
                        case 5:
                                $result = 'HC';
                                break;
                        default :
                                $result = 'OTR';
                                break;
                }
                return $result;
        }

        /**
         * Deletes an existing Service model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete1($id) {
                $model = $this->findModel($id);
                $history = \common\models\Followups::find()->where(['type_id' => $id])->exists();
                if ($history != '1')
                        $this->findModel($id)->delete();

                return $this->redirect(['index']);
        }

        public function actionDelete($id) {
                $model = $this->findModel($id);
                $history = \common\models\Followups::find()->where(['type_id' => $id])->exists();


                // ...other DB operations...

                $transaction = Service::getDb()->beginTransaction();
                try {
                        if ($history != '1')
                                $delete = $this->findModel($id)->delete();
                        // ...other DB operations...
                        $transaction->commit();
                } catch (\Exception $e) {

                        $transaction->rollBack();
                        throw $e;
                } catch (\Throwable $e) {
                        $transaction->rollBack();
                        throw $e;
                }

                if ($delete == '1')
                        Yii::$app->getSession()->setFlash('success', 'succuessfully deleted');
                else
                        Yii::$app->getSession()->setFlash('error', 'Oops! This  service cannot delete');
                return $this->redirect(['index']);
        }

        /**
         * Finds the Service model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return Service the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = Service::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

}
