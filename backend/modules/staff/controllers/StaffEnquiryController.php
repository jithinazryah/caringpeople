<?php

namespace backend\modules\staff\controllers;

use Yii;
use common\models\StaffEnquiry;
use common\models\StaffEnquirySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Followups;
use common\models\FollowupsSearch;
use yii\data\ActiveDataProvider;

/**
 * StaffEnquiryController implements the CRUD actions for StaffEnquiry model.
 */
class StaffEnquiryController extends Controller {

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
         * Lists all StaffEnquiry models.
         * @return mixed
         */
        public function actionIndex() {
                $searchModel = new StaffEnquirySearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                if (Yii::$app->user->identity->branch_id != '0') {
                        $dataProvider->query->where(['branch_id' => Yii::$app->user->identity->branch_id]);
                }

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        /**
         * Displays a single StaffEnquiry model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
        }

        /**
         * Creates a new StaffEnquiry model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {
                $staff_enquiry = new StaffEnquiry();
                $followup_info = new Followups();

                if ($staff_enquiry->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($staff_enquiry)) {
                        if (Yii::$app->user->identity->branch_id != '0') {
                                Yii::$app->SetValues->currentBranch($staff_enquiry);
                        }
                        $staff_enquiry->follow_up_date = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post()['StaffEnquiry']['follow_up_date']));
                        $followup_info->load(Yii::$app->request->post());
                        if ($staff_enquiry->save()) {

                                if ($staff_enquiry->branch_id == '1') {
                                        $code = 'CPCSE';
                                } else if ($staff_enquiry->branch_id == '2') {
                                        $code = 'CPBSE';
                                }
                                $staff_enquiry->enquiry_id = $code . '-' . date('d') . date('m') . date('y') . '-' . $staff_enquiry->id;
                                $staff_enquiry->update();
                                $followup_info->status = '0';
                                Yii::$app->Followups->addfollowups('2', $staff_enquiry->id, $followup_info);
                                Yii::$app->getSession()->setFlash('success', 'Staff Enquiry Added Successfully');
                                return $this->redirect(['index']);
                        }
                }

                return $this->render('_staff_enquiry_form', [
                            'staff_enquiry' => $staff_enquiry,
                            'followup_info' => $followup_info,
                ]);
        }

        /**
         * Updates an existing StaffEnquiry model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {

                $staff_enquiry = $this->findModel($id);
                if (isset($_GET['followup']))
                        $followup_info = Followups::findOne($_GET['followup']);
                else
                        $followup_info = new Followups();

                $searchModel = new FollowupsSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andWhere(['type' => '2', 'type_id' => $id]);

                if ($staff_enquiry->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($staff_enquiry)) {
                        $staff_enquiry->follow_up_date = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post()['StaffEnquiry']['follow_up_date']));
                        $followup_info->load(Yii::$app->request->post());
                        if ($staff_enquiry->save())
                                if (isset($_GET['followup'])) {
                                        Yii::$app->Followups->Updatefollowups($_GET['followup'], $followup_info);
                                } else {
                                        $followup_info->status = '0';
                                        Yii::$app->Followups->addfollowups('2', $staff_enquiry->id, $followup_info);
                                }
                        if (isset($_POST['proceed'])) {
                                $staff_enquiry->proceed = '1';
                                $staff_enquiry->update();
                                return $this->redirect(['staff-info/procced/', 'id' => $staff_enquiry->id]);
                        } else {
                                Yii::$app->getSession()->setFlash('success', 'Updated Successfully');
                                return $this->redirect(['index']);
                        }
                }

                return $this->render('_staff_enquiry_form', [
                            'staff_enquiry' => $staff_enquiry,
                            'followup_info' => $followup_info,
                            'dataProvider' => $dataProvider,
                            'followup_id' => $_GET['followup'],
                ]);
        }

        /**
         * Deletes an existing StaffEnquiry model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
        }

        /**
         * Finds the StaffEnquiry model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return StaffEnquiry the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = StaffEnquiry::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

}
