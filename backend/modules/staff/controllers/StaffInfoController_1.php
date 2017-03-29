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

                $other_info = StaffOtherInfo::findOne(['staff_id' => $id]);
                $staff_previous_employer = StaffPerviousEmployer::findAll(['staff_id' => $id]);
                return $this->render('view', [
                            'staff_info' => $this->findModel($id),
                            'staff_other_info' => $other_info,
                            'staff_previous_employer' => $staff_previous_employer
                ]);
        }

        /**
         * Creates a new StaffInfo model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {

                $model = new StaffInfo();
                $other_info = new StaffOtherInfo();
                $before_update = '';

                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && Yii::$app->SetValues->currentBranch($model)) {

                        $model->dob = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post()['StaffInfo']['dob']));
                        if ($model->validate() && $model->save()) {
                                if (Yii::$app->user->identity->branch_id != '0') {
                                        Yii::$app->SetValues->currentBranch($model);
                                }

                                $this->Imageupload($model, $before_update);
                                $this->AddOtherInfo($model, Yii::$app->request->post(), $other_info);
                                Yii::$app->getSession()->setFlash('success', 'General Information Added Successfully');
                                $this->redirect('index');
                        }
                }
                return $this->render('_staff_form', [
                            'model' => $model,
                            'other_info' => $other_info,
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
                $before_update = StaffInfo::findOne($id);
                $other_info = StaffOtherInfo::findOne(['staff_id' => $model->id]);
                $staff_previous_employer = StaffPerviousEmployer::findAll(['staff_id' => $model->id]);


                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
                        $model->dob = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post()['StaffInfo']['dob']));

                        if ($model->validate() && $model->save()) {

                                $this->Imageupload($model, $before_update);
                                $this->AddOtherInfo($model, Yii::$app->request->post(), $other_info);
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

        /*
         * to add other informations
         *  */

        public function AddOtherInfo($model, $data, $other_info) {

                $other_info->staff_id = $model->id;
                $other_info->load($data);
                $other_info->current_from = date('Y-m-d', strtotime($data['StaffOtherInfo']['current_from']));
                $other_info->current_to = date('Y-m-d', strtotime($data['StaffOtherInfo']['current_to']));

                /*
                 * to create additional previous employer
                 */

                if (isset($_POST['create']) && $_POST['create'] != '') {

                        $arr = [];
                        $i = 0;

                        foreach ($_POST['create']['hospitaladdress'] as $val) {
                                $arr[$i]['hospitaladdress'] = $val;
                                $i++;
                        }
                        $i = 0;
                        foreach ($_POST['create']['designation'] as $val) {
                                $arr[$i]['designation'] = $val;
                                $i++;
                        }
                        $i = 0;
                        foreach ($_POST['create']['length'] as $val) {
                                $arr[$i]['length'] = $val;
                                $i++;
                        }
                        $i = 0;
                        foreach ($_POST['create']['from'] as $val) {
                                $arr[$i]['from'] = $val;
                                $i++;
                        }
                        $i = 0;
                        foreach ($_POST['create']['to'] as $val) {
                                $arr[$i]['to'] = $val;
                                $i++;
                        }

                        foreach ($arr as $val) {
                                $add_previous = new StaffPerviousEmployer;
                                $add_previous->staff_id = $model->id;
                                $add_previous->hospital_address = $val['hospitaladdress'];
                                $add_previous->designation = $val['designation'];
                                $add_previous->length_of_service = $val['length'];
                                $add_previous->service_from = date('Y-m-d', strtotime($val['from']));
                                $add_previous->service_to = date('Y-m-d', strtotime($val['to']));
                                if (!empty($add_previous->hospital_address))
                                        $add_previous->save();
                        }
                }

                /*
                 * to update additional previous employer
                 */

                if (isset($_POST['updatee']) && $_POST['updatee'] != '') {

                        $arr = [];
                        $i = 0;
                        foreach ($_POST['updatee'] as $key => $val) {

                                $arr[$key]['hospitaladdress'] = $val['hospitaladdress'][0];
                                $arr[$key]['designation'] = $val['designation'][0];
                                $arr[$key]['length'] = $val['length'][0];
                                $arr[$key]['from'] = $val['from'][0];
                                $arr[$key]['to'] = $val['to'][0];
                                $i++;
                        }

                        foreach ($arr as $key => $value) {
                                $add_previous = StaffPerviousEmployer::findOne($key);
                                $add_previous->hospital_address = $value['hospitaladdress'];
                                $add_previous->designation = $value['designation'];
                                $add_previous->length_of_service = $value['length'];
                                $add_previous->service_from = date('Y-m-d', strtotime($value['from']));
                                $add_previous->service_to = date('Y-m-d', strtotime($value['to']));
                                $add_previous->update();
                        }
                }

                /*
                 * to delete additional previous employer
                 */

                if (isset($_POST['delete_port_vals']) && $_POST['delete_port_vals'] != '') {

                        $vals = rtrim($_POST['delete_port_vals'], ',');
                        $vals = explode(',', $vals);
                        foreach ($vals as $val) {

                                StaffPerviousEmployer::findOne($val)->delete();
                        }
                }

                if ($other_info->validate() && $other_info->save()) {
                        return true;
                } else {
                        return FALSE;
                }
        }

        /*
         * to upload image
         *  */

        public function Imageupload($model, $data) {

                $images = array('profile_image_type', 'biodata', 'sslc', 'hse', 'KNC', 'INC', 'marklist', 'experience', 'id_proof', 'PCC', 'authorised_letter');
                foreach ($images as $value) {
                        $image = UploadedFile::getInstance($model, $value);
                        $this->image($model, $data, $image, $value);
                }
        }

        /* to save exy=tension in database */

        public function image($model, $data, $image, $type) {
                if (!empty($image)) {

                        $model->$type = $image->extension;
                        $this->upload($model, $image, $type, $model->$type, $data->$type);
                } else {
                        $model->$type = $data->$type;
                }
                $model->update();
        }

        /*
         * to save the image in folder
         * if
         */

        public function Upload($model, $image, $type, $extension, $exists_type) {
                $paths = ['staff', $model->id];
                $file = Yii::getAlias(Yii::$app->params['uploadPath']) . '/staff/' . $model->id . '/' . $type . '.' . $exists_type;
                if (file_exists($file))
                        unlink($file);
                $paths = Yii::$app->UploadFile->CheckPath($paths);
                $image->saveAs($paths . '/' . $type . '.' . $extension);
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

        /*
         * to remove image (proofs-multiple image
         *  */

        public function actionRemove($id, $name) {
                $root_path = Yii::$app->basePath . '/../uploads/staff';
                $path = $root_path . '/' . $id . '/proofs/' . $name;
                if (file_exists($path)) {
                        unlink($path);
                }
                return $this->redirect(Yii::$app->request->referrer);
        }

}
