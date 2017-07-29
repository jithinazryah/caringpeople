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
use common\models\ServiceSchedule;
use common\models\PatientAssessment;
use common\models\ServiceDiscounts;
use yii\db\Expression;

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


                if (!empty(Yii::$app->request->queryParams['ServiceSearch']['status'])) {
                        $dataProvider->query->andWhere(['status' => Yii::$app->request->queryParams['ServiceSearch']['status']]);
                } else {
                        $dataProvider->query->andWhere(['<>', 'status', 2]);
                }
                if (Yii::$app->user->identity->branch_id != '0') {
                        $dataProvider->query->andWhere(['branch_id' => Yii::$app->user->identity->branch_id]);
                }if (Yii::$app->session['post']['id'] != '1') {
                        $dataProvider->query->andWhere(new Expression('FIND_IN_SET(:staffs, service_staffs)'))->addParams([':staffs' => Yii::$app->user->identity->id])->orWhere(['staff_manager' => Yii::$app->user->identity->id]);
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
                        $model->service_staffs = $model->CB . ',' . $model->staff_manager;
                        $branch_details = Branch::find()->where(['id' => $model->branch_id])->one();
                        $service_type = $this->ServiceType($model->service);
                        $model->validate();

                        if ($model->validate() && $model->save()) {
                                $code = $branch_details->branch_code . 'SR-' . $service_type . '-' . date('d') . date('m') . date('y') . '-' . $model->id;
                                $model->service_id = $code;
                                $model->update();
                                $this->ServiceSchedule($model);
                                return $this->redirect(['update', 'id' => $model->id]);
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
                $service_schedule = ServiceSchedule::find()->where(['service_id' => $id])->orderBy([new \yii\db\Expression('FIELD (status, 1,3,4,2)')])->all();
                $patient_assessment = PatientAssessment::find()->where(['service_id' => $id])->one();
                $discounts = ServiceDiscounts::find()->where(['service_id' => $id])->one();
                if (empty($patient_assessment)) {
                        $patient_assessment = new PatientAssessment ();
                        $patient_assessment->service_id = $id;
                        $patient_assessment->save(FALSE);
                }
                if (empty($discounts)) {
                        $discounts = new ServiceDiscounts();
                        $discounts->service_id = $id;
                        $discounts->save();
                }

                if (Yii::$app->request->post()) {
                        $patient_assessment->load(Yii::$app->request->post());
                        if (isset($_POST['patient_medical_procedures']) && $_POST['patient_medical_procedures'] != '') {
                                $patient_assessment->patient_medical_procedures = implode(',', $_POST['patient_medical_procedures']);
                        }
                        if (isset($_POST['suggested_professional']) && $_POST['suggested_professional'] != '') {
                                $patient_assessment->suggested_professional = implode(',', $_POST['suggested_professional']);
                        }
                        $discounts->load(Yii::$app->request->post());
                        $patient_assessment->save();
                        $discounts->save();
                        return $this->redirect(['index']);
                }
                return $this->render('create', [
                            'model' => $model,
                            'service_schedule' => $service_schedule,
                            'patient_assessment' => $patient_assessment,
                            'discounts' => $discounts
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

        /*
         * add service schedules
         */

        public function ServiceSchedule($model) {


                if (($model->duty_type == 5 || $model->duty_type == 3 || $model->duty_type == 4 ) && $model->frequency == 1) {
                        $schedule_count = $model->days;
                } else if ($model->duty_type == 1) {
                        $schedule_count = $model->days;
                } else {
                        $schedule_count = $model->hours * $model->days;
                }

                if ($model->duty_type == 5) {
                        if ($model->day_night_staff == 2) {
                                for ($x = 0; $x < $schedule_count; $x++) {
                                        $day_schedule = new ServiceSchedule();
                                        $night_schedule = new ServiceSchedule();
                                        $day_schedule->service_id = $model->id;
                                        if ($model->frequency == 1) {
                                                $day_schedule->date = date('Y-m-d', strtotime($model->from_date . ' + ' . $x . ' days'));
                                        }
                                        $day_schedule->patient_id = $model->patient_id;
                                        $day_schedule->status = 1;
                                        $day_schedule->rate = 0;

                                        $night_schedule->service_id = $model->id;
                                        if ($model->frequency == 1) {
                                                $night_schedule->date = date('Y-m-d', strtotime($model->from_date . ' + ' . $x . ' days'));
                                        }
                                        $night_schedule->patient_id = $model->patient_id;
                                        $night_schedule->status = 1;
                                        $night_schedule->rate = 0;
                                        $night_schedule->save(false);
                                        $day_schedule->save(false);
                                }
                        } else {
                                for ($x = 0; $x < $schedule_count; $x++) {
                                        $day_schedule = new ServiceSchedule();
                                        $day_schedule->service_id = $model->id;
                                        if ($model->frequency == 1) {
                                                $day_schedule->date = date('Y-m-d', strtotime($model->from_date . ' + ' . $x . ' days'));
                                        }
                                        $day_schedule->patient_id = $model->patient_id;
                                        $day_schedule->status = 1;
                                        $day_schedule->rate = 0;
                                        $day_schedule->save(false);
                                }
                        }
                } else {

                        for ($x = 0; $x < $schedule_count; $x++) {
                                $schedule = new ServiceSchedule();
                                $schedule->service_id = $model->id;
                                if ($model->frequency == 1) {
                                        $schedule->date = date('Y-m-d', strtotime($model->from_date . ' + ' . $x . ' days'));
                                }
                                $schedule->patient_id = $model->patient_id;
                                $schedule->rate = 0;
                                $schedule->status = 1;
                                $schedule->save(false);
                        }
                }
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
                $schedule = ServiceSchedule::find()->where(['service_id' => $id])->count();

                if ($schedule == 0) {
                        $delete = $this->findModel($id)->delete();
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
