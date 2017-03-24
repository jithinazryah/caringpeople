<?php

namespace backend\modules\staff\controllers;

use Yii;
use common\models\StaffInfo;
use common\models\StaffInfoSearch;
use common\models\StaffOtherInfo;
use common\models\StaffPerviousEmployer;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * StaffInfoController implements the CRUD actions for StaffInfo model.
 */
class StaffInfoController extends Controller {

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
         * Lists all StaffInfo models.
         * @return mixed
         */
        public function actionIndex() {
                $searchModel = new StaffInfoSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        /**
         * Displays a single StaffInfo model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
        }

        /**
         * Creates a new StaffInfo model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate1() {
                $model = new StaffInfo();

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                } else {
                        return $this->render('create', [
                                    'model' => $model,
                        ]);
                }
        }

        public function actionCreate() {

                $model = new StaffInfo();
                $other_info = new StaffOtherInfo();
                $staff_previous_employer = new StaffPerviousEmployer();
                $prof_image_ext = '';
                $biodata_ext = '';

                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && Yii::$app->SetValues->currentBranch($model)) {
                        $model->dob = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post()['StaffInfo']['dob']));

                        if ($model->validate() && $model->save()) {
                                /* profile image upload */
                                $prof_image = UploadedFile::getInstance($model, 'profile_image_type');
                                $biodata = UploadedFile::getInstance($model, 'biodata');
                                $proofs = UploadedFile::getInstances($model, 'proofs');
                                if (!empty($prof_image)) {
                                        $model->profile_image_type = $prof_image->extension;
                                        $model->update();
                                        $this->upload($model, $prof_image, 'profile', $model->profile_image_type, $prof_image_ext);
                                }
                                /* biodata upload */
                                if (!empty($biodata)) {
                                        $model->biodata = $biodata->extension;
                                        $model->update();
                                        $this->upload($model, $biodata, 'biodata', $model->biodata, $biodata_ext);
                                }
                                /* proofs upload */
                                if (!empty($proofs)) {
                                        $root_path = ['staff', $model->id, 'proofs'];
                                        Yii::$app->UploadFile->UploadSingle($proofs, $model, $root_path);
                                }
                                $this->AddOtherInfo($model, Yii::$app->request->post(), $other_info, $staff_previous_employer);
                                Yii::$app->getSession()->setFlash('success', 'General Information Added Successfully');
                                $this->redirect('index');
                        }
                }
                return $this->render('_staff_form', [
                            'model' => $model,
                            'other_info' => $other_info,
                            'staff_previous_employer' => $staff_previous_employer,
                ]);
        }

        /**
         * Updates an existing StaffInfo model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {
                $model = $this->findModel($id);
                $other_info = StaffOtherInfo::findOne(['staff_id' => $model->id]);
                $staff_previous_employer = StaffPerviousEmployer::findOne(['staff_id' => $model->id]);
                $prof_image_ext = $model->profile_image_type;
                $biodata_ext = $model->biodata;

                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && Yii::$app->SetValues->currentBranch($model)) {
                        $model->dob = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post()['StaffInfo']['dob']));

                        if ($model->validate() && $model->save()) {
                                /* profile image upload */
                                $prof_image = UploadedFile::getInstance($model, 'profile_image_type');
                                $biodata = UploadedFile::getInstance($model, 'biodata');
                                $proofs = UploadedFile::getInstances($model, 'proofs');
                                if (!empty($prof_image)) {
                                        $model->profile_image_type = $prof_image->extension;
                                        $model->update();
                                        $this->upload($model, $prof_image, 'profile', $model->profile_image_type, $prof_image_ext);
                                } else {
                                        $model->profile_image_type = $prof_image_ext;
                                }
                                /* biodata upload */
                                if (!empty($biodata)) {
                                        $model->biodata = $biodata->extension;
                                        $model->update();
                                        $this->upload($model, $biodata, 'biodata', $model->biodata, $biodata_ext);
                                } else {
                                        $model->biodata = $biodata_ext;
                                }
                                /* proofs upload */
                                if (!empty($proofs)) {
                                        $model->proofs = '1';
                                        $model->update();
                                        $root_path = ['staff', $model->id, 'proofs'];
                                        Yii::$app->UploadFile->UploadSingle($proofs, $model, $root_path);
                                }
                                $this->AddOtherInfo($model, Yii::$app->request->post(), $other_info, $staff_previous_employer);
                                Yii::$app->getSession()->setFlash('success', 'Updated Successfully');
                                return $this->redirect('index');
                        }
                }
                return $this->render('_staff_form', [
                            'model' => $model,
                            'other_info' => $other_info,
                            'staff_previous_employer' => $staff_previous_employer,
                ]);
        }

        /**
         * Deletes an existing StaffInfo model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
                $staff_info = $this->findModel($id);
                $other_info = StaffOtherInfo::find()->where(['staff_id' => $id])->one();
                $staff_previous_employer = StaffPerviousEmployer::find()->where(['staff_id' => $id])->one();


                // ...other DB operations...
// or alternatively

                $transaction = StaffInfo::getDb()->beginTransaction();
                try {
                        if (!empty($staff_previous_employer)) {
                                $staff_previous_employer->delete();
                        }

                        if (!empty($other_info)) {
                                $other_info->delete();
                        }

                        if (!empty($staff_info)) {
                                $staff_info->delete();
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

        public function actionDelete2($id) {
                $staff_info = $this->findModel($id);
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
                        if (!empty($staff_info)) {
                                $staff_info->delete();
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

        /*
         * to add other informations
         *  */

        public function AddOtherInfo($model, $data, $other_info, $staff_previous_employer) {

                $other_info->staff_id = $model->id;
                $other_info->load($data);

                $staff_previous_employer->staff_id = $model->id;
                $staff_previous_employer->load($data);
                $staff_previous_employer->save();

                if ($other_info->validate() && $other_info->save()) {
                        return true;
                } else {
                        return FALSE;
                }
        }

        /*
         * to upload image
         *  */

        public function Upload($model, $image, $type, $extension, $exists_type) {

                $paths = ['staff', $model->id, $type];
                $file = '../uploads/staff/' . $model->id . '/' . $type . '/' . $model->id . '.' . $exists_type;


                if (file_exists($file)) {
                        unlink($file);
                } else {

                }

                $paths = Yii::$app->UploadFile->CheckPath($paths);
                $image->saveAs($paths . '/' . $model->id . '.' . $extension);
        }

        /**
         * Finds the StaffInfo model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return StaffInfo the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = StaffInfo::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

}
