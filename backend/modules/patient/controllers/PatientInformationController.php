<?php

namespace backend\modules\patient\controllers;

use Yii;
use common\models\PatientInformation;
use common\models\PatientInformationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Enquiry;
use common\models\PatientGuardianDetails;
use common\models\PatientGeneral;
use common\models\PatientChronic;
use common\models\PatientPresentMedication;
use common\models\PatientPresentCondition;
use common\models\PatientBystanderDetails;
use common\models\PatientEnquiryGeneralFirst;
use common\models\PatientEnquiryHospitalFirst;
use common\models\PatientEnquiryGeneralSecond;
use common\models\PatientGeneralSearch;
use common\models\Followups;
use common\models\FollowupsSearch;
use yii\web\UploadedFile;
use common\models\ContactDirectory;
use common\models\PatientEnquiryHospitalSecond;
use common\models\PatientEnquiryHospitalDetails;
use common\models\Remarks;
use common\models\PatientAssessment;
use yii\db\Expression;

/**
 * PatientInformationController implements the CRUD actions for PatientInformation model.
 */
class PatientInformationController extends Controller {

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
         * Lists all PatientInformation models.
         * @return mixed
         */
        public function actionIndex() {
                $searchModel = new PatientGeneralSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                if (Yii::$app->user->identity->branch_id != '0') {
                        $dataProvider->query->andWhere(['branch_id' => Yii::$app->user->identity->branch_id]);
                }
                if (Yii::$app->session['post']['id'] == '6') {
                        $assigned_services = \common\models\Service::find()->where(new Expression('FIND_IN_SET(:service_staffs, service_staffs)'))->addParams([':service_staffs' => Yii::$app->user->identity->id])->andWhere(['status' => 1])->all();

                        $patient = array();
                        foreach ($assigned_services as $value) {
                                $patient[] = $value->patient_id;
                        }

                        $dataProvider->query->andWhere(['IN', 'patient_general.id', $patient]);
                }
                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        /**
         * Displays a single PatientInformation model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                $patient_general = PatientGeneral::find()->where(['id' => $id])->one();
                $guardian_details = PatientGuardianDetails::find()->where(['patient_id' => $patient_general->id])->one();
                $chronic_imformation = PatientChronic::find()->where(['patient_id' => $patient_general->id])->one();
                $pationt_medication_details = PatientPresentMedication::find()->where(['patient_id' => $id])->all();
                $present_condition = PatientPresentCondition::find()->where(['patient_id' => $id])->one();
                $bystander_details = PatientBystanderDetails::find()->where(['patient_id' => $id])->one();
                $assessment = PatientAssessment::find()->where(['patient_id' => $id])->one();
                return $this->render('view', [
                            'guardian_details' => $guardian_details,
                            'patient_details' => $patient_general,
                            'chronic_imformation' => $chronic_imformation,
                            'pationt_medication_details' => $pationt_medication_details,
                            'present_condition' => $present_condition,
                            'bystander_details' => $bystander_details,
                            'assessment' => $assessment
                ]);
        }

        /*
         * View followups of each staff
         */

        public function actionFollowups($id) {
                $searchModel = new FollowupsSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andWhere(['assigned_to' => $id]);
                $dataProvider->query->andWhere(['assigned_to_type' => 1]);

                return $this->render('followup', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider, 'id' => $id]);
        }

        /*
         * View remarks of each staff
         */

        public function actionRemarks($id) {
                $searchModel = new RemarksSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andWhere(['type_id' => $id]);
                return $this->render('remarks', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider, 'id' => $id]);
        }

        public function actionProcced($id) {

                $guardian_details = new PatientGuardianDetails();
                $patient_general = new PatientGeneral();
                $chronic_imformation = new PatientChronic();
                $present_condition = new PatientPresentCondition();
                $bystander_details = new PatientBystanderDetails();

                $enquiry_data = PatientEnquiryGeneralFirst::find()->where(['id' => $id])->one();
                $enquiry_patient_details = PatientEnquiryHospitalFirst::find()->where(['enquiry_id' => $id])->one();
                $guardian_contact_details = PatientEnquiryGeneralSecond::find()->where(['enquiry_id' => $id])->one();
                $patient_general = $this->SavePatientDatas($patient_general, $enquiry_patient_details, $enquiry_data, $id);
                $patient_hospital_second = PatientEnquiryHospitalSecond::find()->where(['enquiry_id' => $id])->one();
                $patient_assessment = PatientAssessment::find()->where(['patient_enquiry_id' => $id])->one();

                $hospital_details = PatientEnquiryHospitalDetails::findAll(['enquiry_id' => $id]);


                $transaction = PatientGeneral::getDb()->beginTransaction();
                try {
                        if ($patient_general->save(false)) {
                                $enquiry_data->status = 3;
                                $enquiry_data->patient_id = $patient_general->id;
                                $enquiry_data->update();
                                $guardian_details = $this->SaveGuardianDetials($guardian_details, $enquiry_data, $patient_general, $guardian_contact_details);
                                $guardian_details->save();
                        }
                        $chronic_imformation->patient_id = $patient_general->id;
                        $chronic_imformation->save();
                        $present_condition->patient_id = $patient_general->id;
                        $present_condition->save();
                        $bystander_details->patient_id = $patient_general->id;
                        $bystander_details->save();
                        $patient_assessment->patient_id = $patient_general->id;
                        $patient_assessment->save();

                        if (!empty($guardian_contact_details)) {
                                $guardian_contact_details->patient_id = $patient_general->id;
                                $guardian_contact_details->save();
                        }

                        if (!empty($enquiry_patient_details)) {
                                $enquiry_patient_details->patient_id = $patient_general->id;
                                $enquiry_patient_details->save();
                        }
                        if (!empty($patient_hospital_second)) {
                                $patient_hospital_second->patient_id = $patient_general->id;
                                $patient_hospital_second->save();
                        }

                        if (!empty($hospital_details)) {
                                foreach ($hospital_details as $value) {
                                        $value->patient_id = $patient_general->id;
                                        $value->save();
                                }
                        }


                        $transaction->commit();
                } catch (\Exception $e) {
                        $transaction->rollBack();
                        throw $e;
                } catch (\Throwable $e) {
                        $transaction->rollBack();
                        throw $e;
                }

                return $this->redirect(['update', 'id' => $patient_general->id]);
        }

        /**
         * Creates a new PatientInformation model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         * $id  is enquiry table id
         */
        public function actionCreate($id = null) {


                $guardian_details = new PatientGuardianDetails();
                $patient_general = new PatientGeneral();
                $chronic_imformation = new PatientChronic();
                $pationt_medication_details = '';
                $present_condition = new PatientPresentCondition();
                $bystander_details = new PatientBystanderDetails();
                $patient_assessment = new PatientAssessment();

                $before_update_guardian_details = '';
                $before_update_patient_details = '';


                $enquiry_data = PatientEnquiryGeneralFirst::find()->where(['id' => $id])->one();
                $check_data = PatientGeneral::find()->where(['patient_enquiry_id' => $id])->one();
                if ((!empty($enquiry_data))) {


                        if (empty($check_data)) {
                                $enquiry_patient_details = PatientEnquiryHospitalFirst::find()->where(['enquiry_id' => $id])->one();
                                $guardian_contact_details = PatientEnquiryGeneralSecond::find()->where(['enquiry_id' => $id])->one();
                                $patient_general = $this->SavePatientDatas($patient_general, $enquiry_patient_details, $id);
                                $guardian_details = $this->SaveGuardianDetials($guardian_details, $enquiry_data, $patient_general, $guardian_contact_details);
                        } else {

                                return $this->redirect(['update', 'id' => $check_data->id]);
                        }
                }


                if ($patient_general->load(Yii::$app->request->post()) && $guardian_details->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($patient_general)) {


                        $patient_general->weight = Yii::$app->request->post()['PatientGeneral']['weight'];
                        if (Yii::$app->user->identity->branch_id != '0') {
                                Yii::$app->SetValues->currentBranch($patient_general);
                        }

                        $patient_general->dob = date('Y-m-d', strtotime(Yii::$app->request->post()['PatientGeneral']['dob']));
                        $chronic_imformation->load(Yii::$app->request->post());
                        $present_condition->load(Yii::$app->request->post());
                        $bystander_details->load(Yii::$app->request->post());
                        $patient_assessment->load(Yii::$app->request->post());

                        if ($patient_general->validate() && $guardian_details->validate() && $chronic_imformation->validate() && $present_condition->validate() && $patient_assessment->validate()) {

                                if ($patient_general->save() && $guardian_details->save() && $chronic_imformation->save() && $present_condition->save() && $patient_assessment->save()) {

                                        $guardian_details->patient_id = $patient_general->id;
                                        $guardian_details->save();

                                        $chronic_imformation->patient_id = $patient_general->id;
                                        $chronic_imformation->save();

                                        $present_condition->patient_id = $patient_general->id;
                                        $present_condition->save();

                                        $bystander_details->patient_id = $patient_general->id;
                                        $bystander_details->save();

                                        $patient_assessment->patient_id = $patient_general->id;
                                        $patient_assessment->save();

                                        $this->AddPresentMedication($patient_general);
                                        $this->AddBystanderDetails(Yii::$app->request->post(), $bystander_details);
                                        $this->AddPatientAssessment($patient_assessment);

                                        $this->AddContactDirectory($patient_general);
                                        $guardian_datas = array('passport', 'guardian_profile_image');
                                        $this->Imageupload($guardian_details, $before_update_guardian_details, $guardian_datas, $patient_general->id);
                                        $patient_datas = array('patient_image');
                                        $this->Imageupload($patient_general, $before_update_patient_details, $patient_datas, $patient_general->id);

                                        return $this->redirect(['index']);
                                }
                        }
                }

                return $this->render('create', [
                            'model' => $guardian_details,
                            'patient_general' => $patient_general,
                            'chronic_imformation' => $chronic_imformation,
                            'pationt_medication_details' => $pationt_medication_details,
                            'present_condition' => $present_condition,
                            'bystander_details' => $bystander_details,
                            'patient_assessment' => $patient_assessment
                ]);
        }

        /*
         * to save patient and contact person details from enquiry table to patient information table
         */

        public function SavePatientDatas($patient_general, $enquiry_data, $data, $id) {
                $patient_general->patient_enquiry_id = $id;
                $patient_general->first_name = $enquiry_data->required_person_name;
                $patient_general->gender = $enquiry_data->patient_gender;
                $patient_general->age = $enquiry_data->patient_age;
                $patient_general->present_address = $enquiry_data->person_address;
                $patient_general->pin_code = $enquiry_data->person_postal_code;
                $patient_general->branch_id = $data->branch_id;
                return $patient_general;
        }

        public function SaveGuardianDetials($guardian_details, $enquiry_data, $patient_general, $guardian_contact_details) {
                $guardian_details->patient_id = $patient_general->id;
                $guardian_details->first_name = $enquiry_data->caller_name;
                $guardian_details->gender = $enquiry_data->caller_gender;
                $guardian_details->permanent_address = $guardian_contact_details->address;
                $guardian_details->pincode = $guardian_contact_details->zip_pc;
                $guardian_details->contact_number = $enquiry_data->mobile_number;
                $guardian_details->email = $guardian_contact_details->email;
                return $guardian_details;
        }

        public function AddBystanderDetails($load_data, $bystander_details) {
                if (!empty($load_data['PatientBystanderDetails']['service_need_for']))
                        $bystander_details->service_need_for = implode(',', $load_data['PatientBystanderDetails']['service_need_for']);
                else {
                        $bystander_details->service_need_for = $bystander_details->service_need_for;
                }
                if (!empty($load_data['PatientBystanderDetails']['can_provide']))
                        $bystander_details->can_provide = implode(',', $load_data['PatientBystanderDetails']['can_provide']);
                $bystander_details->save();
        }

        public function AddPatientAssessment($patient_assessment) {
                if (isset($_POST['patient_medical_procedures']) && $_POST['patient_medical_procedures'] != '') {
                        $patient_assessment->patient_medical_procedures = implode(',', $_POST['patient_medical_procedures']);
                }
                if (isset($_POST['suggested_professional']) && $_POST['suggested_professional'] != '') {
                        $patient_assessment->suggested_professional = implode(',', $_POST['suggested_professional']);
                }
                $patient_assessment->save(FALSE);
        }

        public function AddPresentMedication($patient_general) {

                /*
                 * to add present patient medication details
                 */

                if (isset($_POST['create']) && $_POST['create'] != '') {
                        $arr = [];
                        $i = 0;

                        foreach ($_POST['create']['medicine_name'] as $val) {

                                $arr[$i]['medicine_name'] = $val;
                                $i++;
                        }
                        $i = 0;
                        foreach ($_POST['create']['dosage'] as $val) {
                                $arr[$i]['dosage'] = $val;
                                $i++;
                        }
                        $i = 0;
                        foreach ($_POST['create']['mode'] as $val) {
                                $arr[$i]['mode'] = $val;
                                $i++;
                        }
                        $i = 0;
                        foreach ($_POST['create']['since'] as $val) {
                                $arr[$i]['since'] = $val;
                                $i++;
                        }
                        $i = 0;
                        foreach ($_POST['create']['tablet_injection'] as $val) {
                                $arr[$i]['tablet_injection'] = $val;
                                $i++;
                        }


                        foreach ($arr as $val) {
                                $add_medication = new PatientPresentMedication();
                                $add_medication->patient_id = $patient_general->id;
                                $add_medication->tablet_injection = $val['tablet_injection'];
                                $add_medication->medicine_name = $val['medicine_name'];
                                $add_medication->dosage = $val['dosage'];
                                $add_medication->mode = $val['mode'];
                                $add_medication->since = $val['since'];
                                if ((!empty($add_medication->tablet_injection)) || ($add_medication->tablet_injection != ''))
                                        $add_medication->save();
                        }
                }

                /*
                 * to update patient medication details
                 */

                if (isset($_POST['updatee']) && $_POST['updatee'] != '') {


                        $arr = [];
                        $i = 0;
                        foreach ($_POST['updatee'] as $key => $val) {

                                $arr[$key]['tablet_injection'] = $val['tablet_injection'][0];
                                $arr[$key]['medicine_name'] = $val['medicine_name'][0];
                                $arr[$key]['dosage'] = $val['dosage'][0];
                                $arr[$key]['mode'] = $val['mode'][0];
                                $arr[$key]['since'] = $val['since'][0];
                                $i++;
                        }
                        foreach ($arr as $key => $value) {
                                $add_medication = PatientPresentMedication::findOne($key);
                                $add_medication->tablet_injection = $value['tablet_injection'];
                                $add_medication->medicine_name = $value['medicine_name'];
                                $add_medication->dosage = $value['dosage'];
                                $add_medication->since = $value['since'];
                                $add_medication->mode = $value['mode'];
                                $add_medication->update();
                        }
                }

                /*
                 * to delete additional previous employer
                 */

                if (isset($_POST['delete_port_vals']) && $_POST['delete_port_vals'] != '') {


                        $vals = rtrim($_POST['delete_port_vals'], ',');

                        $vals = explode(',', $vals);
                        foreach ($vals as $val) {

                                $delete_entry = PatientPresentMedication::findOne($val);
                                if (!empty($delete_entry))
                                        $delete_entry->delete();
                        }
                }
        }

        /*
         * to add patient  details to contact directory for future use
         * $patient_info ->PatientGeneral table
         */

        public function AddContactDirectory($patient_info) {
                $model = new ContactDirectory();
                $model->category_type = 3; /* patient  */
                $model->name = $patient_info->first_name . ' ' . $patient_info->last_name;
                $model->email_1 = $patient_info->email;
                $model->phone_1 = $patient_info->contact_number;
                Yii::$app->SetValues->Attributes($model);
                if ($model->validate() && $model->save())
                        return TRUE;
                else
                        return FALSE;
        }

        /**
         * Updates an existing PatientInformation model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {

                $patient_general = PatientGeneral::find()->where(['id' => $id])->one();
                $before_update_guardian_details = PatientGuardianDetails::find()->where(['patient_id' => $patient_general->id])->one();

                $before_update_patient_details = PatientGeneral::find()->where(['id' => $id])->one();
                $guardian_details = PatientGuardianDetails::find()->where(['patient_id' => $patient_general->id])->one();
                $chronic_imformation = PatientChronic::find()->where(['patient_id' => $patient_general->id])->one();
                $pationt_medication_details = PatientPresentMedication::find()->where(['patient_id' => $id])->all();
                $present_condition = PatientPresentCondition::find()->where(['patient_id' => $id])->one();
                $bystander_details = PatientBystanderDetails::find()->where(['patient_id' => $id])->one();
                $patient_assessment = PatientAssessment::find()->where(['patient_id' => $id])->one();

                if (!empty($patient_general) && !empty($guardian_details) && !empty($chronic_imformation && $present_condition && !empty($bystander_details))) {

                        if ($patient_general->load(Yii::$app->request->post()) && $guardian_details->load(Yii::$app->request->post())) {
                                $patient_general->weight = Yii::$app->request->post()['PatientGeneral']['weight'];
                                $patient_general->dob = date('Y-m-d', strtotime(Yii::$app->request->post()['PatientGeneral']['dob']));
                                $guardian_details->contact_number = Yii::$app->request->post()['PatientGuardianDetails']['contact_number'];
                                $patient_general->contact_number = Yii::$app->request->post()['PatientGeneral']['contact_number'];
                                $chronic_imformation->load(Yii::$app->request->post());
                                $present_condition->load(Yii::$app->request->post());
                                $patient_assessment->load(Yii::$app->request->post());
                                $present_condition->last_change_date = date('Y-m-d', strtotime(Yii::$app->request->post()['PatientPresentCondition']['last_change_date']));
                                $present_condition->foleys_last_change_date = date('Y-m-d', strtotime(Yii::$app->request->post()['PatientPresentCondition']['foleys_last_change_date']));
                                $bystander_details->load(Yii::$app->request->post());
                                if ($patient_general->validate() && $guardian_details->validate() && $patient_general->save() && $guardian_details->save() && $chronic_imformation->validate() && $chronic_imformation->save() && $bystander_details->validate()) {
                                        $guardian_datas = array('passport', 'guardian_profile_image');
                                        $this->Imageupload($guardian_details, $before_update_guardian_details, $guardian_datas, $id);
                                        $patient_datas = array('patient_image');
                                        $this->Imageupload($patient_general, $before_update_patient_details, $patient_datas, $id);
                                        $present_condition->save();
                                        $bystander_details->save();
                                        $this->AddPresentMedication($patient_general);
                                        $this->AddPatientAssessment($patient_assessment);
                                        $this->AddBystanderDetails(Yii::$app->request->post(), $bystander_details);

                                        return $this->redirect(['index']);
                                }
                        }
                        return $this->render('create', [
                                    'model' => $guardian_details,
                                    'patient_general' => $patient_general,
                                    'chronic_imformation' => $chronic_imformation,
                                    'pationt_medication_details' => $pationt_medication_details,
                                    'present_condition' => $present_condition,
                                    'bystander_details' => $bystander_details,
                                    'patient_assessment' => $patient_assessment
                        ]);
                } else {
                        return $this->redirect([
                                    'enquiry/index']);
                }
        }

        /*
         * to upload image
         *  */

        public function Imageupload($model, $data = null, $images, $id) {

                foreach ($images as $value) {

                        $image = UploadedFile:: getInstance($model, $value);

                        $this->image($model, $data, $image, $value, $id);
                }
        }

        /* to save extension in database */

        public function image($model, $data = null, $image, $type, $id) {

                if (!empty($image)) {

                        $model->$type = $image->extension;
                        if (!empty($data)) {
                                $this->upload($model, $image, $type, $model->$type, $id, $data->$type);
                        } else {
                                $this->upload($model, $image, $type, $model->$type, $id);
                        }
                } else {
                        if (!empty($data))
                                $model->$type = $data->$type;
                }
                $model->update();
        }

        /*
         * to save the image in folder
         * if
         */

        public function Upload($model, $image, $type, $extension, $id, $exists_type = null) {
                $paths = ['patient', $id];
                $file = Yii::getAlias(Yii::$app->params ['uploadPath']) . '/patient/' . $id . '/' .
                        $type . '.' . $exists_type;
                if (file_exists($file))
                        unlink($file);
                $paths = Yii::$app->UploadFile->CheckPath($paths);
                $image->saveAs($paths . '/' . $type . '.' . $extension);
        }

        /**
         * Deletes an existing PatientInformation model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete1($id) {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
        }

        public function actionDelete($id) {
                $patient_general = PatientGeneral::findOne($id);
                $guardian_details = PatientGuardianDetails::find()->where(['patient_id' => $patient_general->id])->one();
                $chronic_imformation = PatientChronic::find()->where(['patient_id' => $patient_general->id])->one();
                $pationt_medication_details = PatientPresentMedication::find()->where(['patient_id' => $id])->all();
                $present_condition = PatientPresentCondition::find()->where(['patient_id' => $id])->one();
                $bystander_details = PatientBystanderDetails::find()->where(['patient_id' => $id])->one();
                $patient_assessment = PatientAssessment::find()->where(['patient_id' => $id])->one();

                // ...other DB operations...
                $service_patient = \common\models\Service::find()->where(['patient_id' => $id])->exists();
                if ($service_patient != 1) {
                        $transaction = PatientGeneral::getDb()->beginTransaction();
                        try {
                                if (!empty($guardian_details)) {
                                        $guardian_details->delete();
                                }
                                if (!empty($chronic_imformation)) {
                                        $chronic_imformation->delete();
                                }
                                if (!empty($present_condition)) {
                                        $present_condition->delete();
                                }
                                if (!empty($bystander_details)) {
                                        $bystander_details->delete();
                                }
                                if (!empty($patient_assessment)) {
                                        $patient_assessment->delete();
                                }
                                if (!empty($pationt_medication_details)) {
                                        foreach ($pationt_medication_details as $value) {

                                                $value->delete();
                                        }
                                }


                                if (!empty($patient_general)) {
                                        $patient_general->delete();
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
                } else {
                        Yii::$app->getSession()->setFlash('error', 'Oops! You cannot delete this patient');
                }

                return $this->redirect(['index']);
        }

        /**
         * Finds the PatientInformation model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return PatientInformation the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = PatientInformation::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

}
