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
use yii\web\UploadedFile;
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
                        $dataProvider->query->andWhere(['branch_id' => Yii::$app->user->identity->branch_id]);
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
                

                if ($staff_enquiry->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($staff_enquiry)) {
                        if (Yii::$app->user->identity->branch_id != '0') {
                                Yii::$app->SetValues->currentBranch($staff_enquiry);
                        }
                        $attachments = UploadedFile::getInstances($staff_enquiry, 'attachments');
                        $staff_enquiry->attachments=0;  
                        if ($staff_enquiry->save()) {

                                if ($staff_enquiry->branch_id == '1') {
                                        $code = 'CPCSE';
                                } else if ($staff_enquiry->branch_id == '2') {
                                        $code = 'CPBSE';
                                }
                                if (!empty($attachments)) {
                                        $root_path = ['staff-enquiry', $staff_enquiry->id];
                                        Yii::$app->UploadFile->UploadSingle($attachments, $staff_enquiry, $root_path);
                                }
                                $staff_enquiry->enquiry_id = $code . '-' . date('d') . date('m') . date('y') . '-' . $staff_enquiry->id;
                                $staff_enquiry->update();
                                
                                
                                Yii::$app->getSession()->setFlash('success', 'Staff Enquiry Added Successfully');
                                return $this->redirect(array('index'));
                        }
                }

                return $this->render('_staff_enquiry_form', [
                            'staff_enquiry' => $staff_enquiry,
                            
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
               

                if ($staff_enquiry->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($staff_enquiry)) {
                        
                         $attachments = UploadedFile::getInstances($staff_enquiry, 'attachments');                       
                         $staff_enquiry->attachments=0;  
                        if ($staff_enquiry->save())
 if (!empty($attachments)) {
                                $root_path = ['staff-enquiry', $staff_enquiry->id];
                                Yii::$app->UploadFile->UploadSingle($attachments, $staff_enquiry, $root_path);
                        }
                         
      
                        if (isset($_POST['proceed'])) {
                                $staff_enquiry->proceed = '1';
                                $staff_enquiry->update();
                                return $this->redirect(['staff-info/procced/', 'id' => $staff_enquiry->id]);
                        } else {
                                Yii::$app->getSession()->setFlash('success', 'Updated Successfully');
                                return $this->redirect(array('index'));
                        }
                }

                return $this->render('_staff_enquiry_form', [
                            'staff_enquiry' => $staff_enquiry,
                            
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
                $paths = Yii::getAlias(Yii::$app->params['uploadPath']) . '/staff-enquiry/' . $id;
                if (file_exists($paths)) {
                        $files = Yii::$app->UploadFile->RemoveFiles($paths);
                }
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

 public function actionRemove($id, $name) {

                $root_path = Yii::$app->basePath . '/../uploads/staff-enquiry';
                $path = $root_path . '/' . $id . '/' . $name;
                if (file_exists($path)) {
                        unlink($path);
                }
                return $this->redirect(Yii::$app->request->referrer);
        }

}
