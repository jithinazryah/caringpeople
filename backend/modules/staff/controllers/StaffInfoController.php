<?php

namespace backend\modules\staff\controllers;

use Yii;
use common\models\StaffInfo;
use common\models\StaffInfoSearch;
use common\models\StaffOtherInfo;
use common\models\StaffPerviousEmployer;
use common\models\Followups;
use common\models\FollowupsSearch;
use common\models\StaffInfoEducation;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use common\models\ContactDirectory;
use common\models\AdminUsers;
use common\models\StaffEnquiryInterviewFirst;
use common\models\StaffEnquiryInterviewSecond;
use common\models\StaffEnquiryInterviewThird;

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
         * $2y$13$n6k/SkumJoaMkMcrq/eGFeJ23xjUXyTQKrkXjm9ZBOx6PbwpJVwpK
         * Lists all StaffInfo models.
         * @return mixed
         */
        public function actionIndex() {

                $searchModel = new StaffInfoSearch();
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
         * Displays a single StaffInfo model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                $staff_edu = StaffInfoEducation::findOne(['staff_id' => $id]);

                $other_info = StaffOtherInfo::findOne(['staff_id' => $id]);
                $staff_previous_employer = StaffPerviousEmployer::findAll(['staff_id' => $id]);
                return $this->render('view', [
                            'staff_info' => $this->findModel($id),
                            'staff_edu' => $staff_edu,
                            'staff_other_info' => $other_info,
                            'staff_previous_employer' => $staff_previous_employer
                ]);
        }

        public function actionProcced($id) {

                $staff_info = new StaffInfo();
                $other_info = StaffOtherInfo::findOne(['enquiry_id' => $id]);
                $staff_education = StaffInfoEducation::findOne(['enquiry_id' => $id]);

                $staff_previous_employer = StaffPerviousEmployer::findAll(['enquiry_id' => $id]);
                $staff_interview_first = StaffEnquiryInterviewFirst::findOne(['enquiry_id' => $id]);
                $staff_interview_second = StaffEnquiryInterviewSecond::findOne(['enquiry_id' => $id]);
                $staff_interview_third = StaffEnquiryInterviewThird::findOne(['enquiry_id' => $id]);
                $model = \common\models\StaffEnquiry::findOne($id);

                $staff_info->staff_enquiry_id = $id;
                $staff_info->staff_name = $model->name;
                $staff_info->gender = $model->gender;
                $staff_info->contact_no = $model->phone_number;
                $staff_info->email = $model->email;
                $staff_info->permanent_address = $model->address;
                $staff_info->place = $model->place;
                $staff_info->designation = $model->designation;
                $staff_info->branch_id = $model->branch_id;
                $staff_info->status = 1;


                if ($staff_info->save()) {
                        $model->status = 2; /* 2=>status closed */
                        $model->proceed = 1;
                        $model->update();
                        $other_info->staff_id = $staff_info->id;
                        $staff_education->staff_id = $staff_info->id;
                        if (!empty($staff_previous_employer))
                                $staff_previous_employer->staff_id = $staff_info->id;

                        $staff_interview_first->staff_id = $staff_info->id;
                        $staff_interview_second->staff_id = $staff_info->id;
                        $staff_interview_third->staff_id = $staff_info->id;
                        $other_info->save();
                        $staff_education->save();

                        if (!empty($staff_previous_employer))
                                $staff_previous_employer->save();
                        $staff_interview_first->save();
                        $staff_interview_second->save();
                        $staff_interview_third->save();
                        return $this->redirect(['update', 'id' => $staff_info->id]);
                }
        }

        /**
         * Creates a new StaffInfo model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {


                $model = new StaffInfo();
                $model->setScenario('create');
                $staff_edu = new StaffInfoEducation();
                $other_info = new StaffOtherInfo();




                $staff_previous_employer = '';



                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {

                        $model->dob = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post()['StaffInfo']['dob']));
                        $other_info->load(Yii::$app->request->post());
                        $staff_edu->load(Yii::$app->request->post());
                        $other_info->current_from = date('Y-m-d', strtotime(Yii::$app->request->post()['StaffOtherInfo']['current_from']));
                        $other_info->current_to = date('Y-m-d', strtotime(Yii::$app->request->post()['StaffOtherInfo']['current_to']));
                        $model->username = Yii::$app->request->post()['StaffInfo']['username'];
                        $model->password = Yii::$app->security->generatePasswordHash(Yii::$app->request->post()['StaffInfo']['password']);
                        $model->post_id = Yii::$app->request->post()['StaffInfo']['post_id'];
//$this->AddToUsers($model);

                        if (Yii::$app->user->identity->branch_id != '0') {
                                Yii::$app->SetValues->currentBranch($model);
                        }
                        if ($model->validate() && $other_info->validate() && $staff_edu->validate() && $staff_edu->save() && $model->save() && $other_info->save()) {
                                $other_info->staff_id = $model->id;
                                $staff_edu->staff_id = $model->id;
                                $staff_edu->save(false);
                                $other_info->update();
                                $this->AddContactDirectory($model);
                                $this->Imageupload($model);


                                $this->AddOtherInfo($model, Yii::$app->request->post(), $other_info);
                                $this->sendMail($model);
                                Yii::$app->getSession()->setFlash('success', 'General Information Added Successfully');
                                return $this->redirect(array('index'));
                        }
                }
                return $this->render('_staff_form', [
                            'model' => $model,
                            'staff_edu' => $staff_edu,
                            'staff_previous_employer' => $staff_previous_employer,
                            'other_info' => $other_info,
                ]);
        }

        /*
         * to add staff  details to contact directory for future use
         * $model ->staff info table
         */

        public function AddContactDirectory($staff_info) {
                $model = new ContactDirectory();
                $model->category_type = 4; /* staff enquiry */
                $model->name = $staff_info->staff_name;
                $model->email_1 = $staff_info->email;
                $model->phone_1 = $staff_info->present_contact_no;
                $model->designation = $staff_info->designation;

                Yii::$app->SetValues->Attributes($model);
                if ($model->validate() && $model->save())
                        return TRUE;
                else
                        return FALSE;
        }

        public function AddToUsers($username, $password, $model) {
                $admin_users = new AdminUsers();
                $admin_users->setScenario('create');
                $admin_users->post_id = 5;
                $admin_users->user_name = $username;
                $admin_users->password = $password;
                $admin_users->name = $model->staff_name;
                $admin_users->email = $model->present_email;
                $admin_users->phone_number = $model->present_contact_no;
                $admin_users->staff_info_id = $model->id;
                if (Yii::$app->user->identity->branch_id != '0') {
                        $admin_users->branch_id = Yii::$app->user->identity->branch_id;
                }

                $admin_users->status = 1;

                if ($admin_users->validate() && Yii::$app->SetValues->Attributes($admin_users)) {
                        $admin_users->save(FALSE);
                        return true;
                } else {
                        Yii::$app->getSession()->setFlash('error', 'Username  already exist please use another');
                        return FALSE;
                }
        }

        /**
         * Updates an existing StaffInfo model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id = null, $data = null) {
                if (!empty($data)) {
                        $id = Yii::$app->EncryptDecrypt->Encrypt('decrypt', $data);
                }
                $model = $this->findModel($id);

                $other_info = StaffOtherInfo::findOne(['staff_id' => $model->id]);
                $staff_edu = StaffInfoEducation::findOne(['staff_id' => $model->id]);
                $staff_previous_employer = StaffPerviousEmployer::findAll(['staff_id' => $model->id]);


                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $staff_edu->load(Yii::$app->request->post())) {
                        $model->dob = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post()['StaffInfo']['dob']));
                        $other_info->staff_id = $model->id;
                        $other_info->load(Yii::$app->request->post());
                        $other_info->current_from = date('Y-m-d', strtotime(Yii::$app->request->post()['StaffOtherInfo']['current_from']));
                        $other_info->current_to = date('Y-m-d', strtotime(Yii::$app->request->post()['StaffOtherInfo']['current_to']));
                        if ($model->validate() && $other_info->validate() && $staff_edu->validate() && $model->save() && $other_info->save() && $staff_edu->save()) {

                                $model->username = Yii::$app->request->post()['StaffInfo']['username'];
                                //   $model->password = Yii::$app->security->generatePasswordHash(Yii::$app->request->post()['StaffInfo']['password']);
                                $model->post_id = Yii::$app->request->post()['StaffInfo']['post_id'];
                                $model->save();
                                $this->Imageupload($model);
                                $this->AddOtherInfo($model, Yii::$app->request->post(), $other_info);
                                Yii::$app->getSession()->setFlash('success', 'Updated Successfully');
                                return $this->redirect(array('index'));
                        }
                }

                return $this->render('_staff_form', [
                            'model' => $model,
                            'staff_edu' => $staff_edu,
                            'other_info' => $other_info,
                            'staff_previous_employer' => $staff_previous_employer,
                ]);
        }

        /*
         * edit user profile limit fields
         */

        public function actionEditprofile($id = null, $data = null) {
                if (!empty($data)) {
                        $id = Yii::$app->EncryptDecrypt->Encrypt('decrypt', $data);
                }
                $model = $this->findModel($id);

                $other_info = StaffOtherInfo::findOne(['staff_id' => $model->id]);
                $staff_edu = StaffInfoEducation::findOne(['staff_id' => $model->id]);

                $staff_previous_employer = StaffPerviousEmployer::findAll(['staff_id' => $model->id]);
                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $staff_edu->load(Yii::$app->request->post())) {
                        $model->dob = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post()['StaffInfo']['dob']));
                        if ($model->validate() && $other_info->validate() && $staff_edu->validate() && $model->save() && $other_info->save() && $staff_edu->save()) {

                                $model->username = Yii::$app->request->post()['StaffInfo']['username'];
                                $model->post_id = Yii::$app->request->post()['StaffInfo']['post_id'];
                                $model->save();
                                Yii::$app->getSession()->setFlash('success', 'Updated Successfully');
                                $datas = Yii::$app->EncryptDecrypt->Encrypt('encrypt', $model->id);
                                return $this->redirect(array('editprofile', 'data' => $datas));
                        }
                }
                return $this->render('_staff_form', [
                            'model' => $model,
                            'staff_edu' => $staff_edu,
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
                $staff_edu = StaffInfoEducation::findOne(['staff_id' => $id]);


                // ...other DB operations...

                $transaction = StaffInfo::getDb()->beginTransaction();
                try {
                        if (!empty($staff_previous_employer)) {
                                $staff_previous_employer->delete();
                        }
                        if (!empty($staff_edu)) {
                                $staff_edu->delete();
                        }


                        if (!empty($other_info)) {
                                $other_info->delete();
                        }

                        if (!empty($staff_info)) {
                                $staff_info->delete();
                        }
                        $paths = Yii::getAlias(Yii::$app->params['uploadPath']) . '/staff/' . $id;
                        if (file_exists($paths)) {
                                $files = Yii::$app->UploadFile->RemoveFiles($paths);
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
        }

        /*
         * to upload image
         *  */

        public function Imageupload($model) {

                if (isset($_POST['creates']) && $_POST['creates'] != '') {

                        $arrs = [];
                        $i = 0;

                        foreach ($_FILES['creates'] ['name'] as $row => $innerArray) {
                                $i = 0;
                                foreach ($innerArray as $innerRow => $value) {
                                        $arrs[$i]['name'] = $value;
                                        $i++;
                                }
                        }
                        $i = 0;
                        foreach ($_FILES['creates'] ['tmp_name'] as $row => $innerArray) {
                                $i = 0;
                                foreach ($innerArray as $innerRow => $value) {
                                        $arrs[$i]['tmp_name'] = $value;
                                        $i++;
                                }
                        }
                        $i = 0;

                        foreach ($_FILES['creates'] ['name'] as $row => $innerArray) {
                                $i = 0;
                                foreach ($innerArray as $innerRow => $value) {
                                        $ext = pathinfo($value, PATHINFO_EXTENSION);
                                        $arrs[$i]['extension'] = $ext;
                                        $i++;
                                }
                        }
                        $i = 0;
                        foreach ($_POST['creates']['file_name'] as $val) {
                                $arrs[$i]['file_name'] = $val;
                                $i++;
                        }

                        foreach ($arrs as $val) {
                                $this->Upload($model->id, $val['name'], $val['tmp_name'], $val['file_name'], $val['extension']);
                        }
                }
        }

        /*
         * to save the image in folder
         * if
         */

        public function Upload($id, $name, $Tmpfilename, $filename, $extension) {
                $paths = ['staff', $id];
                $paths = Yii::$app->UploadFile->CheckPath($paths);
                $target_dir = Yii::getAlias(Yii::$app->params['uploadPath']) . '/staff/' . $id . "/";
                if (empty($filename))
                        $filename = 'attachment';
                move_uploaded_file($Tmpfilename, $target_dir . $filename . "." . $extension);
        }

        /*
         * to send email
         */

        public function sendMail($model) {
                if (isset($model->email) && $model->email != '') {

                        $message = Yii::$app->mailer->compose('staff-mail', ['model' => $model]) // a view rendering result becomes the message body here
                                ->setFrom('info@caringpeople.in')
                                ->setTo($model->email)
                                ->setSubject('Welcome to Caringpeople');
                        $message->send();
                        return TRUE;
                }
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

        public function actionResetPassword() {
                if (Yii::$app->request->isAjax) {
                        $id = $_POST['id'];
                        $data = $this->findModel($id);
                        if (!empty($data)) {
                                $data->password = Yii::$app->security->generatePasswordHash($_POST['password']);
                                $data->update();
                                Yii::$app->getSession()->setFlash('success', 'Password changed successfully');
                                return true;
                        } else {
                                return false;
                        }
                }
        }

}
