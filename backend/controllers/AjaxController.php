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
use common\models\UploadCategory;
use yii\db\Expression;

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
                        $rand = rand();
                        $branch = $_POST['branch'];
                        $count = $_POST['count'];
                        if (isset($branch) && $branch != '') {
                                if ($branch == 1) {
                                        $category = 5;
                                } else if ($branch == 2) {
                                        $category = 17;
                                }
                                $hospital_name = \common\models\ContactSubcategory::find()->where(['category_id' => $category, 'status' => 1])->all();

                                $options = Html::dropDownList('addhospital[hospital_name][]', null, ArrayHelper::map($hospital_name, 'id', 'sub_category'), ['class' => 'form-control hospital', 'prompt' => '--Select--', 'id' => 'hospital_' . $count]);

                                $data = "<span>
<hr style='border-top: 1px solid #979898 !important;'>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <div class='form-group field-patientenquiryhospitaldetails-hospital_name'>
                                        <label class='control-label'>Hospital Name</label>
                                        $options
                                                   <a class='add-option-dropdown add-new' id='hospital_$count-1' style='margin-top:0px;'> + Add New</a>
                                </div>

                        </div>

                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <div class='form-group field-patientenquiryhospitaldetails-consultant_doctor'>
                                        <label class='control-label' for=''>Consultant Doctor</label>
                                         <select name='addhospital[consultant_doctor][]' class='form-control' id='doctor_$count'></select>
                                                 <a class='add-option-dropdown add-new' id='doctor_$count-1' style='margin-top:0px;'> + Add New</a>
                                </div>
                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <div class='form-group field-patientenquiryhospitaldetails-department'>
                                        <label class='control-label'>Department</label>
                                        <input type='text' class='form-control' name='addhospital[department][]' id='department_$count'>
                                </div>
                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <div class='form-group field-patientenquiryhospitaldetails-hospital_room_no'>
                                        <label class='control-label' >Hospital Room No</label>
                                        <input type='text' class='form-control' name='addhospital[hospital_room_no][]'>
                                </div>
                        </div>

                        <a id='remScnt' class='btn btn-icon btn-red remScnt' style='margin-top: 15px;'><i class='fa-remove'></i></a>
                        <div style='clear:both'></div>
                </span>";
                                echo $data;
                        } else {
                                echo '1';
                        }
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

                        if ($branch == '') {
                                echo '1';
                                exit;
                        } elseif ($staff_type == '') {
                                echo '2';
                        } else {
                                $staff_type_datas = \common\models\StaffInfo::find()->where(new Expression('FIND_IN_SET(:designation, designation)'))->addParams([':designation' => $staff_type])->andWhere(['branch_id' => $branch])->andWhere(['status' => 1])->orderBy(['staff_name' => SORT_ASC])->all();


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
         * show nurse manager based on branch in service form
         */

        public function actionStaffmanager() {
                $branch = $_POST['branch'];
                $patient = $_POST['patient'];
                $patient_manager = PatientGeneral::findOne($patient);
                if (isset($patient_manager->staff_manager) && $patient_manager->staff_manager != '') {
                        $patient_staff_mangager = $patient_manager->staff_manager;
                } else {
                        $patient_staff_mangager = '';
                }
                $mangers = \common\models\StaffInfo::find()->where(['branch_id' => $branch, 'status' => 1, 'post_id' => 6])->orderBy(['staff_name' => SORT_ASC])->all();
                $options = '<option value="">-Select-</option>';
                foreach ($mangers as $mangers) {
                        $options .= "<option value='" . $mangers->id . "'>" . $mangers->staff_name . "</option>";
                }
                echo $options;
        }

        public function actionAttachment() {
                $rand = rand();
                $uploads_type = UploadCategory::find()->where(['status' => 1])->all();
                $option = Html::dropDownList('creates[file_name][]', null, ArrayHelper::map($uploads_type, 'id', 'sub_category'), ['class' => 'form-control', 'prompt' => '--Select--', 'id' => 'atachment_' . $rand]);
                $vers = "<span>
                                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <div class='form-group field-staffperviousemployer-hospital_address'>
                                <label class='control-label'>Attachment</label>
                                <input type='file'  name='creates[file][]'>
                                </div>
                                </div>
                                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <div class='form-group field-staffperviousemployer-salary'>
                                <label class='control-label' >Attachment Name</label>
                              $option
                                  <a class='add-option-dropdown add-new' id='atachment_$rand-5' style='margin-top:0px;'> + Add New</a>
                                </div>
                                </div>
                                <a id='remAttach' class='btn btn-icon btn-red remAttach' style='margin-top: 15px;'><i class='fa-remove'></i></a>
                                <div style='claer:both'></div><br/>
                                </span><br/>";
                echo $vers;
        }

        public function actionDoctors() {
                if (Yii::$app->request->isAjax) {
                        $hospital = $_POST['hospital'];
                        if ($hospital == '') {
                                echo '0';
                                exit;
                        } else {
                                $doctors = \common\models\ContactDirectory::find()->where(['subcategory_type' => $hospital, 'designation' => 13])->all();

                                if (empty($doctors)) {
                                        echo '0';
                                        exit;
                                } else {
                                        $options = '<option value="">-Select-</option>';
                                        foreach ($doctors as $doctors) {
                                                $options .= "<option value='" . $doctors->id . "'>" . $doctors->name . "</option>";
                                        }
                                }
                        }

                        echo $options;
                }
        }

        public function actionDepartment() {
                if (Yii::$app->request->isAjax) {
                        $doctor = $_POST['doctor'];
                        if ($doctor == '') {
                                echo '0';
                                exit;
                        } else {
                                $doctors = \common\models\Doctors::findOne($doctor);
                                if (empty($doctors)) {

                                } else {
                                        echo $doctors->department;
                                }
                        }

                        //echo $options;
                }
        }

        public function actionHospitals() {
                if (Yii::$app->request->isAjax) {
                        $options = '';
                        $branch = $_POST['branch'];
                        if ($branch == 1) {
                                $category = 5;
                        } else if ($branch == 2) {
                                $category = 17;
                        }
                        $hosp = \common\models\ContactSubcategory::find()->where(['category_id' => $category, 'status' => 1])->all();
                        if (!empty($hosp)) {
                                $options = '<option value="">-Select-</option>';
                                foreach ($hosp as $value) {
                                        $options .= "<option value='" . $value->id . "'>" . $value->sub_category . "</option>";
                                }
                        }
                        echo $options;
                }
        }

}
