<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Enquiry;
use common\models\Followups;
use common\models\Hospital;
use common\models\StaffInfoUploads;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use common\models\PatientGuardianDetails;
use common\models\PatientGeneral;

class AjaxController extends \yii\web\Controller {

        public function actionIndex() {
                return $this->render('index');
        }

        /*
         * This function select Countries based on the continent_id
         * return result to the view
         */

        public function actionState() {

                if (Yii::$app->request->isAjax) {
                        $country_id = $_POST['country_id'];
                        if ($country_id == '') {
                                echo '0';
                                exit;
                        } else {
                                $state_datas = \common\models\State::find()->where(['country_id' => $country_id])->all();
                                if (empty($state_datas)) {
                                        echo '0';
                                        exit;
                                } else {
                                        $options = '<option value="">-Select State-</option>';
                                        foreach ($state_datas as $state_data) {
                                                $options .= "<option value='" . $state_data->id . "'>" . $state_data->state_name . "</option>";
                                        }
                                }
                        }

                        echo $options;
                }
        }

        /*
         * This function select City based on the district_id
         * return result to the view
         */

        public function actionCity() {
                if (Yii::$app->request->isAjax) {
                        $state_id = $_POST['state_id'];
                        if ($state_id == '') {
                                echo '0';
                                exit;
                        } else {
                                $city_datas = \common\models\City::find()->where(['state_id' => $state_id])->all();
                                if (empty($city_datas)) {
                                        echo '0';
                                        exit;
                                } else {
                                        $options = '<option value="">-Select City-</option>';
                                        foreach ($city_datas as $city_data) {
                                                $options .= "<option value='" . $city_data->id . "'>" . $city_data->city_name . "</option>";
                                        }
                                }
                        }

                        echo $options;
                }
        }

        /*
         * This function select Caste based on the religion
         * return result to the view
         */

        public function actionReligion() {

                if (Yii::$app->request->isAjax) {
                        $religion = $_POST['religion'];
                        if ($religion == '') {
                                echo '0';
                                exit;
                        } else {
                                $caste_datas = \common\models\Caste::find()->where(['r_id' => $religion])->orderBy(['caste' => SORT_ASC])->all();
                                if (empty($caste_datas)) {
                                        echo '0';
                                        exit;
                                } else {
                                        $options = '<option value="">-Select-</option>';
                                        foreach ($caste_datas as $caste_data) {
                                                $options .= "<option value='" . $caste_data->id . "'>" . $caste_data->caste . "</option>";
                                        }
                                }
                        }

                        echo $options;
                }
        }

        /*
         * This function is for check email duplication
         *
         */

        public function actionEmail() {
                if (Yii::$app->request->isAjax) {
                        $email = $_POST['email'];
                        $exists = Enquiry::find()->where(['email' => $email])->exists();
                        if ($exists == 1) {
                                $user = Enquiry::find()->where(['email' => $email])->all();
                                if (count($user) > 1) {
                                        return 1;
                                } else {
                                        foreach ($user as $value) {
                                                return $value->id;
                                        }
                                }
                        } else {
                                return $data = 0;
                        }
                }
        }

        /*
         * This function is for update followup notes
         *
         */

        public function actionFollowup() {

                if (Yii::$app->request->isAjax) {
                        $followup_id = Yii::$app->EncryptDecrypt->Encrypt('decrypt', $_POST['followup_id']);
                        $followup = Followups::find()->where(['id' => $followup_id])->one();
                        $followup->followup_notes = $_POST['notes'];
                        $followup->DOU = date('Y-m-d H:i');
                        $followup->save();
                }
        }

        /*
         * This function is for update followup status
         *
         */

        public function actionFollowupstatus() {

                if (Yii::$app->request->isAjax) {
                        $followup_id = Yii::$app->EncryptDecrypt->Encrypt('decrypt', $_POST['followup_id']);
                        $followup = Followups::find()->where(['id' => $followup_id])->one();
                        $followup->status = 1;
                        $followup->update();
                }
        }

        /*
         * This function is for update followup status
         */

        public function actionPatienthospitaldetails() {
                if (Yii::$app->request->isAjax) {

                        $hospital_name = Hospital::find()->where(['status' => '1'])->all();
                        $options = Html::dropDownList('create[hospital_name][]', null, ArrayHelper::map($hospital_name, 'id', 'hospital_name'), ['class' => 'form-control', 'prompt' => '--Select--']);

                        $data = "<span>
<hr style='border-top: 1px solid #979898 !important;'>
                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                <div class='form-group field-patientenquiryhospitaldetails-hospital_name'>
                                        <label class='control-label'>Hospital Name</label>
                                        $options
                                </div>
                        </div>

                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                <div class='form-group field-patientenquiryhospitaldetails-consultant_doctor'>
                                        <label class='control-label' for=''>Consultant Doctor</label>
                                        <input type='text' class='form-control' name='create[consultant_doctor][]'>
                                </div>
                        </div>
                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                <div class='form-group field-patientenquiryhospitaldetails-department'>
                                        <label class='control-label'>Department</label>
                                        <input type='text' class='form-control' name='create[department][]'>
                                </div>
                        </div>
                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                <div class='form-group field-patientenquiryhospitaldetails-hospital_room_no'>
                                        <label class='control-label' >Hospital Room No</label>
                                        <input type='text' class='form-control' name='create[hospital_room_no][]'>
                                </div>
                        </div>

                        <a id='remScnt' class='btn btn-icon btn-red remScnt' style='margin-top: 15px;'><i class='fa-remove'></i></a>
                        <div style='clear:both'></div>
                </span>";
                        echo $data;
                }
        }

        /*
         * This function select Caste based on the religion
         * return result to the view
         */

        public function actionContactcategory() {

                if (Yii::$app->request->isAjax) {
                        $category = $_POST['category'];
                        if ($category == '') {
                                echo '0';
                                exit;
                        } else {
                                $sub_cat_datas = \common\models\ContactSubcategory::find()->where(['category_id' => $category])->all();
                                if (empty($sub_cat_datas)) {
                                        echo '0';
                                        exit;
                                } else {
                                        $options = '<option value="">-Select-</option>';
                                        foreach ($sub_cat_datas as $sub_cat_data) {
                                                $options .= "<option value='" . $sub_cat_data->id . "'>" . $sub_cat_data->sub_category . "</option>";
                                        }
                                }
                        }

                        echo $options;
                }
        }

        /*
         * to remove images of staff (uploaded images in staff)
         */

        public function actionRemove() {

                $id = $_POST['id'];
                $name = $_POST['name'];
                $type = $_POST['type'];

                $root_path = Yii::$app->basePath . '/../uploads/staff';
                $path = $root_path . '/' . $id . '/' . $name;

                $staff_uploads = StaffInfoUploads::find()->where(['staff_id' => $id])->one();
                if (file_exists($path)) {

                        if (unlink($path)) {
                                $staff_uploads->$type = '';
                                $staff_uploads->update();
                        }
                }
        }

        /*
         * to remove images of staff-enquiry (uploaded images in staff-enquiry)
         */

        public function actionStaffenqremove() {

                $id = $_POST['id'];
                $name = $_POST['name'];

                $root_path = Yii::$app->basePath . '/../uploads/staff';
                $path = $root_path . '/' . $id . '/' . $name;


                if (file_exists($path)) {

                        if (unlink($path)) {

                        }
                }
        }

        /*
         * to remove images of patient (uploaded images in patient)
         */

        public function actionPatientremove() {

                $id = $_POST['id'];
                $name = $_POST['name'];
                $type = $_POST['type'];

                $root_path = Yii::getAlias(Yii::$app->params['uploadPath']) . '/patient';
                $path = $root_path . '/' . $id . '/' . $name;

                if (file_exists($path)) {

                        if (unlink($path)) {
                                if ($type == 'guardian_profile_image') {
                                        $data_update = PatientGuardianDetails::find()->where(['patient_id' => $id])->one();
                                        $data_update->guardian_profile_image = '';
                                } else if ($type == 'passport') {
                                        $data_update = PatientGuardianDetails::find()->where(['patient_id' => $id])->one();
                                        $data_update->passport = '';
                                } else if ($type == 'patient_image') {
                                        $data_update = PatientGeneral::find()->where(['id' => $id])->one();
                                        $data_update->patient_image = '';
                                }
                                $data_update->update();
                        }
                }
        }

        /*
         * This function select Caste based on the religion
         * return result to the view
         */

        public function actionStaffs() {

                if (Yii::$app->request->isAjax) {
                        $staff_type = $_POST['staff_type'];
                        $branch = $_POST['branch'];

                        if ($staff_type == '') {
                                echo '0';
                                exit;
                        } else {
                                $staff_type_datas = \common\models\StaffInfo::find()->where(['designation' => $staff_type, 'branch_id' => $branch, 'status' => 1])->orderBy(['staff_name' => SORT_ASC])->all();

                                if (empty($staff_type_datas)) {
                                        echo '0';
                                        exit;
                                } else {
                                        $options = '<option value="">-Select-</option>';
                                        foreach ($staff_type_datas as $staff_type_data) {
                                                $options .= "<option value='" . $staff_type_data->id . "'>" . $staff_type_data->staff_name . "</option>";
                                        }
                                }
                        }

                        echo $options;
                }
        }

        /*
         * popup content in terms and conditions
         */

        public function actionContent() {
                $data = $this->renderPartial('terms', ['id' => $_POST['id']]);
                echo $data;
        }

        /*
         * show patients based on branch in service form
         */

        public function actionPatients() {
                $branch = $_POST['branch'];
                $patients = PatientGeneral::find()->where(['branch_id' => $branch, 'status' => 1])->orderBy(['first_name' => SORT_ASC])->all();
                $options = '<option value="">-Select-</option>';
                foreach ($patients as $patient) {
                        $options .= "<option value='" . $patient->id . "'>" . $patient->first_name . "</option>";
                }
                echo $options;
        }

        /*
         * This function is for adding multiple followup details
         */

        public function actionFollowups() {
                if (Yii::$app->request->isAjax) {
                        $type_id = $_POST['type_id'];
                        $type = $_POST['type'];
                        $count = $_POST['count'];
                        $datas = $this->renderPartial('followup', ['type_id' => $type_id, 'type' => $type, 'count' => $count]);
                        echo $datas;
                }
        }

}
