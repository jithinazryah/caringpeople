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
use yii\web\UploadedFile;

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
                $searchModel = new PatientInformationSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

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

                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
        }

        /**
         * Creates a new PatientInformation model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         * $id  is enquiry table id
         */
        public function actionCreate($id = false) {


                $guardian_details = new PatientGuardianDetails();
                $patient_general = new PatientGeneral();
                $chronic_imformation = new PatientChronic();
                $present_medication = new PatientPresentMedication();
                $present_condition = new PatientPresentCondition();
                $bystander_details = new PatientBystanderDetails();
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
                } else {
                        return $this->redirect(['patient-enquiry-general-first/index']);
                }

                if ($patient_general->load(Yii::$app->request->post()) && $guardian_details->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($patient_general)) {

                        if (Yii::$app->user->identity->branch_id != '0') {
                                Yii::$app->SetValues->currentBranch($patient_general);
                        }
                        $chronic_imformation->load(Yii::$app->request->post());
                        $present_condition->load(Yii::$app->request->post());
                        $bystander_details->load(Yii::$app->request->post());
                        if ($patient_general->validate() && $guardian_details->validate() && $chronic_imformation->validate() && $present_condition->validate()) {

                                if ($patient_general->save() && $guardian_details->save() && $chronic_imformation->save() && $present_condition->save()) {

                                        $guardian_details->patient_id = $patient_general->id;
                                        $guardian_details->save();

                                        $chronic_imformation->patient_id = $patient_general->id;
                                        $chronic_imformation->save();

                                        $present_condition->patient_id = $patient_general->id;
                                        $present_condition->save();

                                        $bystander_details->patient_id = $patient_general->id;
                                        $bystander_details->save();

                                        $this->AddPresentMedication($patient_general);
                                        $this->AddBystanderDetails(Yii::$app->request->post(), $bystander_details);
                                        return $this->redirect(['index']);
                                }
                        }
                }

                return $this->render('create', [
                            'model' => $guardian_details,
                            'patient_general' => $patient_general,
                            'chronic_imformation' => $chronic_imformation,
                            'present_medication' => $present_medication,
                            'present_condition' => $present_condition,
                            'bystander_details' => $bystander_details,
                ]);
        }

        /*
         * to save patient and contact person details from enquiry table to patient information table
         */

        public function SavePatientDatas($patient_general, $enquiry_data, $id) {
                $patient_general->patient_enquiry_id = $id;
                $patient_general->first_name = $enquiry_data->required_person_name;
                $patient_general->gender = $enquiry_data->patient_gender;
                $patient_general->age = $enquiry_data->patient_age;
                $patient_general->present_address = $enquiry_data->person_address;
                $patient_general->pin_code = $enquiry_data->person_postal_code;

                return $patient_general;
        }

        public function SaveGuardianDetials($guardian_details, $enquiry_data, $patient_general, $guardian_contact_details) {
                $guardian_details->patient_id = $patient_general->id;
                $guardian_details->first_name = $enquiry_data->caller_name;
                $guardian_details->gender = $enquiry_data->caller_gender;
                $guardian_details->permanent_address = $guardian_contact_details->address;
                $guardian_details->pincode = $guardian_contact_details->zip_pc;
                $guardian_details->contact_number = $enquiry_data->mobile_number;
                $guardian_details->email = $enquiry_patient_details->email;
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
                                if (!empty($add_medication->tablet_injection))
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

        /**
         * Updates an existing PatientInformation model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {

                $patient_general = PatientGeneral::find()->where(['id' => $id])->one();
                $before_update_guardian_details = PatientGuardianDetails::find()->where(['patient_id' => $patient_general->patient_id])->one();
                $before_update_patient_details = PatientGeneral::find()->where(['id' => $id])->one();
                $guardian_details = PatientGuardianDetails::find()->where(['patient_id' => $patient_general->id])->one();
                $chronic_imformation = PatientChronic::find()->where(['patient_id' => $patient_general->id])->one();
                $pationt_medication_details = PatientPresentMedication::find()->where(['patient_id' => $id])->all();
                $present_condition = PatientPresentCondition::find()->where(['patient_id' => $id])->one();
                $bystander_details = PatientBystanderDetails::find()->where(['patient_id' => $id])->one();
                if (!empty($patient_general) && !empty($guardian_details) && !empty($chronic_imformation && $present_condition && !empty($bystander_details))) {

                        if ($patient_general->load(Yii::$app->request->post()) && $guardian_details->load(Yii::$app->request->post())) {
                                $chronic_imformation->load(Yii::$app->request->post());
                                $present_condition->load(Yii::$app->request->post());
                                $bystander_details->load(Yii::$app->request->post());
                                if ($patient_general->validate() && $guardian_details->validate() && $patient_general->save() && $guardian_details->save() && $chronic_imformation->validate() && $chronic_imformation->save() && $bystander_details->validate()) {
                                        $guardian_datas = array('passport', 'driving_license', 'pan_card', 'voters_id', 'guardian_profile_image');
                                        $this->Imageupload($guardian_details, $before_update_guardian_details, $guardian_datas);
                                        $patient_datas = array('patient_image');
                                        $this->Imageupload($patient_general, $before_update_patient_details, $patient_datas);
                                        $present_condition->save();
                                        $bystander_details->save();
                                        $this->AddPresentMedication($patient_general);
                                        $this->AddBystanderDetails(Yii::$app->request->post(), $bystander_details);
                                        return $this->redirect(['view', 'id' => $patient_general->id]);
                                }
                        }
                        return $this->render('create', [
                                    'model' => $guardian_details,
                                    'patient_general' => $patient_general,
                                    'chronic_imformation' => $chronic_imformation,
                                    'pationt_medication_details' => $pationt_medication_details,
                                    'present_condition' => $present_condition,
                                    'bystander_details' => $bystander_details,
                        ]);
                } else {
                        return $this->redirect([
                                    'enquiry/index']);
                }
        }

        /*
         * to upload image
         *  */

        public function Imageupload($model, $data, $images) {

                foreach ($images as $value) {
                        $image = UploadedFile:: getInstance($model, $value);
                        $this->image($model, $data, $image, $value);
                }
        }

        /* to save extension in database */

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
                $paths = ['patient', $model->id];
                $file = Yii::getAlias(Yii::$app->params ['uploadPath']) . '/patient/' . $model->id . '/' .
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
        public function actionDelete($id) {
                $this->findModel($id)->delete();

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