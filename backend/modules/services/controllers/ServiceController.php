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
use yii\base\UserException;
use kartik\mpdf\Pdf;

/**
 * ServiceController implements the CRUD actions for Service model.
 */
class ServiceController extends Controller {

        public function beforeAction($action) {
                if (!parent::beforeAction($action)) {
                        return false;
                }
                if (Yii::$app->user->isGuest) {
                        $this->redirect(['/site/index']);
                        return false;
                }
                return true;
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
         * Lists all Service models.
         * @return mixed
         */
        public function actionIndex() {

                $check_exists = explode('?', Yii::$app->request->url);
                if (empty($check_exists[1]))
                        Yii::$app->session->remove('new_size');

                if (isset($_POST['size'])) {
                        $pagesize = $_POST['size'];
                        \Yii::$app->session->set('new_size', $pagesize);
                } else {
                        $pagesize = Yii::$app->session->get('new_size');
                }

                $searchModel = new ServiceSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->pagination->pageSize = $pagesize;



                if (Yii::$app->user->identity->branch_id != '0') {
                        $dataProvider->query->andWhere(['branch_id' => Yii::$app->user->identity->branch_id]);
                }
                if (Yii::$app->session['post']['id'] != '1' && Yii::$app->session['post']['id'] != '13' && Yii::$app->session['post']['id'] != '10') {
                        $dataProvider->query->andWhere(new Expression('FIND_IN_SET(:staffs, service_staffs)'))->addParams([':staffs' => Yii::$app->user->identity->id])->orWhere(['staff_manager' => Yii::$app->user->identity->id]);
                }

                if (!empty(Yii::$app->request->queryParams['ServiceSearch']['status'])) {
                        $dataProvider->query->andWhere(['status' => Yii::$app->request->queryParams['ServiceSearch']['status']]);
                } else {
                        $dataProvider->query->andWhere(['<>', 'status', 2]);
                        $dataProvider->query->andWhere(['<>', 'status', 3]);
                }

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                            'pagesize' => $pagesize,
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
                                $history_id = Yii::$app->SetValues->ServiceHistory($model, 1); /* 1 implies masterservice history type id 1 for new service */
                                if (!empty($history_id)) {
                                        Yii::$app->SetValues->Notifications($history_id, $model->id, $model, 1); /* 1 => notification type is service */
                                }
                                $code = $branch_details->branch_code . 'SR-' . $service_type . '-' . date('d') . date('m') . date('y') . '-' . $model->id;
                                $model->service_id = $code;
                                $ratecard = \common\models\RateCard::find()->where(['service_id' => $model->service, 'branch_id' => $model->branch_id, 'status' => 1, 'sub_service' => $model->sub_service])->one();
                                if ($model->duty_type == 1) {
                                        $type = 'rate_per_hour';
                                } else if ($model->duty_type == 2) {
                                        $type = 'rate_per_visit';
                                } else if ($model->duty_type == 3) {
                                        $type = 'rate_per_day';
                                } else if ($model->duty_type == 4) {
                                        $type = 'rate_per_night';
                                } else if ($model->duty_type == 5) {
                                        $type = 'rate_per_day_night';
                                }
                                $model->rate_card_value = $ratecard->$type;
                                $registration = 0;
                                if ($model->registration_fees == 1) {
                                        $registration = $model->registration_fees_amount;
                                }
                                $model->due_amount = $model->estimated_price + $registration;
                                $model->proforma_sent = 1;
                                $model->update();
//                                $this->ServiceSchedule($model);
                                Yii::$app->SetValues->ServiceScheduleHistory($model->id, 1, $model->days, $model->estimated_price);
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
                $previous_estimated_price = $model->estimated_price;
                $service_schedule = ServiceSchedule::find()->where(['service_id' => $id])->orderBy([new \yii\db\Expression('FIELD (status, 1,3,4,2)'), 'date' => SORT_ASC])->all();
                $patient_assessment = PatientAssessment::find()->where(['service_id' => $id])->one();
                $discounts = new ServiceDiscounts();
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
                        $model->load(Yii::$app->request->post());
                        $model->from_date = date('Y-m-d', strtotime($model->from_date));
                        $model->to_date = date('Y-m-d', strtotime($model->to_date));
                        $patient_assessment->load(Yii::$app->request->post());
                        if (isset($_POST['patient_medical_procedures']) && $_POST['patient_medical_procedures'] != '') {
                                $patient_assessment->patient_medical_procedures = implode(',', $_POST['patient_medical_procedures']);
                        }
                        if (isset($_POST['suggested_professional']) && $_POST['suggested_professional'] != '') {
                                $patient_assessment->suggested_professional = implode(',', $_POST['suggested_professional']);
                        }
                        $discounts->load(Yii::$app->request->post());
                        if ($previous_estimated_price != $model->estimated_price) {
                                $total_due = $this->CalculateAmount($model);
                                $model->estimated_price = $total_due - $model->registration_fees_amount;
                                $model->due_amount = $total_due;
                        } else {
                                $model->estimated_price = $model->estimated_price - $discounts->discount_value;
                                $model->due_amount = $model->due_amount - $discounts->discount_value;
                        }
                        $patient_assessment->save();
                        $transaction = Yii::$app->db->beginTransaction();
                        try {
                                if ($model->update()) {
                                        $discounts->service_id = $model->id;
                                        $discounts->date = date('Y-m-d');
                                        $discounts->save();
                                        $transaction->commit();
                                }
                        } catch (Exception $ex) {
                                $transaction->rollBack();
                                throw new UserException('Error Code:  1050');
                        }


                        return $this->redirect(['index']);
                }
                return $this->render('create', [
                            'model' => $model,
                            'service_schedule' => $service_schedule,
                            'patient_assessment' => $patient_assessment,
                            'discounts' => $discounts
                ]);
        }

        public function CalculateAmount($model) {

                $price = $model->estimated_price;
                $discounts = ServiceDiscounts::find()->where(['service_id' => $model->id])->all();
                $total_discount = 0;
                if (!empty($discounts)) {
                        foreach ($discounts as $value) {
                                $total_discount += $value->discount_value;
                        }
                }
                $total_due = $price - $total_discount + $model->registration_fees_amount;
                return $total_due;
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
                                        $day_schedule->day_night = 1;
                                        $day_schedule->rate = 0;

                                        $night_schedule->service_id = $model->id;
                                        if ($model->frequency == 1) {
                                                $night_schedule->date = date('Y-m-d', strtotime($model->from_date . ' + ' . $x . ' days'));
                                        }
                                        $night_schedule->patient_id = $model->patient_id;
                                        $night_schedule->status = 1;
                                        $night_schedule->day_night = 2;
                                        $night_schedule->rate = 0;
                                        $day_schedule->save(false);
                                        $night_schedule->save(false);
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
        public function actionDelete($id) {
                $service_bin = new \common\models\ServiceBin;
                $service = $this->findModel($id);
                $service_schedules = ServiceSchedule::findAll(['service_id' => $id]);
                $service_discounts = ServiceDiscounts::findAll(['service_id' => $id]);
                $service_schedule_history = \common\models\ServiceScheduleHistory::findAll(['service_id' => $id]);

                $service_bin->attributes = $service->attributes;
                $service_bin->service_table_id = $service->id;
                $service_bin->save();
                if (!empty($service_schedules)) {
                        foreach ($service_schedules as $service_scheduless) {
                                $service_schedule_bin = new \common\models\ServiceScheduleBin;
                                $service_schedule_bin->attributes = $service_scheduless->attributes;
                                $service_schedule_bin->service_id = $service_bin->id;
                                $service_schedule_bin->save();
                        }
                }
                if (!empty($service_discounts)) {
                        foreach ($service_discounts as $service_discountss) {
                                $service_discounts_bin = new \common\models\ServiceDiscountsBin;
                                $service_discounts_bin->attributes = $service_discountss->attributes;
                                $service_discounts_bin->service_id = $service_bin->id;
                                $service_discounts_bin->save();
                        }
                }

                $transaction = Service::getDb()->beginTransaction();
                try {
                        if (!empty($service_schedules)) {
                                foreach ($service_schedules as $value) {
                                        $value->delete();
                                }
                        }
                        if (!empty($service_discounts)) {
                                foreach ($service_discounts as $value1) {
                                        $value1->delete();
                                }
                        }

                        if (!empty($service_schedule_history)) {
                                foreach ($service_schedule_history as $value2) {
                                        $value2->delete();
                                }
                        }
                        $service->delete();

                        // ...other DB operations...
                        $transaction->commit();
                } catch (\Exception $e) {
                        $transaction->rollBack();
                        throw $e;
                } catch (\Throwable $e) {
                        $transaction->rollBack();
                        throw $e;
                }
                Yii::$app->getSession()->setFlash('success', 'Deleted succuessfully');
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

        public function actionTodayschedules() {
                $user = Yii::$app->user->identity->id;
                if (isset($_POST['branch'])) {
                        $branch = $_POST['branch'];

                        if ($branch == 0) {
                                $services = Service::find()->where(['status' => 1])->all();
                        } else {
                                $services = Service::find()->where(['status' => 1, 'branch_id' => $branch])->all();
                        }
                } else {
                        if (Yii::$app->session['post']['id'] == 1) {
                                $services = Service::find()->where(['status' => 1, 'branch_id' => Yii::$app->user->identity->branch_id])->all();
                        } else {
                                $services = Service::find()->where(['status' => 1])->andWhere(new Expression('FIND_IN_SET(:staffs, service_staffs)'))->addParams([':staffs' => Yii::$app->user->identity->id])->orWhere(['staff_manager' => Yii::$app->user->identity->id])->all();
                        }
                }
                if (isset($_POST['date']))
                        $date = date('Y-m-d', strtotime($_POST['date']));
                else
                        $date = date('Y-m-d');

                return $this->render('today-schedule', [
                            'services' => $services,
                            'date_now' => $date,
                ]);
        }

        public function actionEstimatedBill($id) {
                $model = $this->findModel($id);
                echo $this->renderPartial('estimated_bill', [
                    'model' => $model,
                ]);
        }

        public function actionPrint($id = null) {

                $model = $this->findModel($id);
                $pdf = new Pdf([
                    'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
                    'content' => $this->renderPartial('estimated_bill_print', [
                        'model' => $model,
                    ]),
                    'cssInline' => '.table{margin-top:20px;font-family: sans-serif;} ',
                    'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/other.css',
                ]);
                return $pdf->render();
        }

        public function actionConfirmService() {
                if (Yii::$app->request->isAjax) {
                        $model = Service::findOne($_POST['service_id']);
                        $model->proforma_sent = 2;
                        $model->save();
                        $this->ServiceSchedule($model);
                        //  Yii::$app->SetValues->ServiceScheduleHistory($model->id, 1, $model->days, $model->estimated_price);
                }
        }

}
