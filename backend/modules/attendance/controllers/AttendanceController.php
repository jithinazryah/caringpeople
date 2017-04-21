<?php

namespace backend\modules\attendance\controllers;

use Yii;
use common\models\Attendance;
use common\models\AttendanceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\StaffInfo;
use common\models\AttendanceEntry;

/**
 * AttendanceController implements the CRUD actions for Attendance model.
 */
class AttendanceController extends Controller {

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
         * Lists all Attendance models.
         * @return mixed
         */
        public function actionIndex() {


                $model = new Attendance();
                $model->date = date('d-M-Y');
                $employees = '';


                if (isset($_POST['Attendance'])) {
                        $model->load(Yii::$app->request->post());
                        /*
                         * To check attenadsnce is entere or not
                         */
                        $attendance = $this->selectUsers($model);
                        if (empty($attendance)) {
                                $employees = StaffInfo::find()->where(['branch_id' => $model->branch_id])->all();
                                return $this->render('create', ['model' => $model, 'employees' => $employees]);
                        } else {
                                Yii::$app->session['attendance'] = $attendance;
                                $employees = AttendanceEntry::find()->where(['attendance_id' => $attendance->id])->all();
                                return $this->render('update', ['model' => $model, 'employees' => $employees]);
                        }
                }

                /*
                 * add attendance
                 */
                if (isset($_POST['submit_attendance'])) {
                        $this->addAttendance($_POST);
                }

                /*
                 * update attendance
                 */

                if (isset($_POST['update_attendance'])) {
                        $this->updateAttendance($_POST);
                }


                if (!isset($_POST['Attendance'])) {
                        return $this->render('create', [
                                    'model' => $model, 'employees' => $employees
                        ]);
                }
        }

        /*
         * To check attenadsnce is entered or not
         */

        public function selectUsers($model) {
                $date = date('Y-m-d', strtotime($model->date));
                $barnch = $model->branch_id;
                Yii::$app->session['attendance'] = $model;
                $attendance = Attendance::find()->where(['date' => $date, 'branch_id' => $barnch])->one();
                return $attendance;
        }

        /*
         * Insert each staff entry into database
         */

        public function addAttendance($model) {
                if (isset(Yii::$app->session['attendance'])) {

                        $date = date('Y-m-d', strtotime(Yii::$app->session['attendance']->date));
                        $employees = StaffInfo::find()->where(['branch_id' => Yii::$app->session['attendance']->branch_id])->all();
                        $attendance = new Attendance;
                        $attendance->date = $date;
                        $attendance->branch_id = Yii::$app->session['attendance']->branch_id;
                        Yii::$app->SetValues->Attributes($attendance);
                        $transaction = Yii::$app->db->beginTransaction();
                        try {
                                $attendance->save(FALSE);
                                foreach ($employees as $employee) {
                                        $attendance_entry = new AttendanceEntry;
                                        $attendance_entry->attendance_id = $attendance->id;
                                        $attendance_entry->staff_id = $employee->id;
                                        $attendance_entry->total_hours = $model['total_' . $employee->id];
                                        $attendance_entry->over_time = $model['over_time_' . $employee->id];
                                        $attendance_entry->attendance = $model['attendance_' . $employee->id];
                                        $attendance_entry->save(FALSE);
                                }

                                $transaction->commit();

                                Yii::$app->getSession()->setFlash('success', 'Attendence for ' . $date . ' has been successfully added');
                                // $this->refresh();
                        } catch (Exception $e) {
                                $transaction->rollBack();
                                Yii::$app->getSession()->setFlash('error', "<strong>Technical error! </strong>{$e->getMessage()}");
                                // $this->refresh();
                        }
                } else {
                        Yii::$app->getSession()->setFlash('error', "<strong>Technical error! </strong> Please try again...!!!");
                }
        }

        /*
         * Update each staff entry into database
         */

        public function updateAttendance($model) {

                if (isset(Yii::$app->session['attendance'])) {
                        $attendence = AttendanceEntry::find()->where(['attendance_id' => Yii::$app->session['attendance']->id])->all();

                        $transaction = Yii::$app->db->beginTransaction();
                        try {
                                foreach ($attendence as $attendences) {
                                        $attendance_entry = AttendanceEntry::findOne($attendences->id);
                                        $attendance_entry->total_hours = $model['total_' . $attendences->id];
                                        $attendance_entry->over_time = $model['over_time_' . $attendences->id];
                                        $attendance_entry->attendance = $model['attendance_' . $attendences->id];
                                        // $attendance_entry->ub = Yii::app()->session['admin']['id'];
                                        $attendance_entry->save(FALSE);
                                        Yii::$app->getSession()->setFlash('success', 'Updated successfully');
                                }

                                $transaction->commit();
                        } catch (Exception $e) {
                                $transaction->rollBack();
                                Yii::$app->getSession()->setFlash('error', "<strong>Technical error! </strong>{$e->getMessage()}");
                                //$this->refresh();
                        }
                } else {
                        Yii::app()->user->setFlash('danger', "<strong>Technical error! </strong> Please try again...!!!");
                }
        }

        /*
         * Attendance Report
         */

        public function actionReport() {

                $model = new Attendance();
                $model->scenario = 'report';
                $report = '';
                $branch = '';

                if ($model->load(Yii::$app->request->post())) {
                        $from = date('Y-m-d', strtotime($model->date));
                        $to = date('Y-m-d', strtotime($model->DOC));
                        $branch = $model->branch_id;
                        $report = Attendance::find()->where(['branch_id' => $branch])->andWhere(['>=', 'date', $from])->andWhere(['<=', 'date', $to])->all();
                }
                return $this->render('report', [
                            'model' => $model, 'report' => $report, 'selected_branch' => $branch
                ]);
        }

        /**
         * Displays a single Attendance model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
        }

        /**
         * Creates a new Attendance model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {


                $model = new Attendance();


                if ($model->load(Yii::$app->request->post())) {
                        return $this->redirect(['view', 'id' => $model->id]);
                } else {
                        return $this->render('create', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Updates an existing Attendance model.
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
         * Deletes an existing Attendance model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
        }

        /**
         * Finds the Attendance model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return Attendance the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = Attendance::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.









                ');
                }
        }

}
