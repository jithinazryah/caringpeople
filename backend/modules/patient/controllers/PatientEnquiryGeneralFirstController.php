<?php

namespace backend\modules\patient\controllers;

use Yii;
use common\models\PatientEnquiryGeneralFirst;
use common\models\PatientEnquiryGeneralFirstSearch;
use common\models\PatientEnquiryGeneralSecond;
use common\models\PatientEnquiryHospitalFirst;
use common\models\PatientEnquiryHospitalSecond;
use common\models\Followups;
use common\models\FollowupsSearch;
use common\models\PatientEnquiryHospitalDetails;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\EnquiryHospital;
use common\models\EnquiryOtherInfo;
use common\models\Branch;
use common\models\ContactDirectory;

/**
 * PatientEnquiryGeneralFirstController implements the CRUD actions for PatientEnquiryGeneralFirst model.
 */
class PatientEnquiryGeneralFirstController extends Controller {

        public function init() {

                if (Yii::$app->user->isGuest)
                        $this->redirect(['/site/index']);

                if (Yii::$app->session['post']['enquiry'] != 1)
                        $this->redirect(['/site/home']);
        }

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
         * Lists all PatientEnquiryGeneralFirst models.
         * @return mixed
         */
        public function actionIndex() {
                $searchModel = new PatientEnquiryGeneralFirstSearch();
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
         * Displays a single PatientEnquiryGeneralFirst model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                $patient_info_second = PatientEnquiryGeneralSecond::find()->where(['enquiry_id' => $id])->one();
                $patient_hospital = PatientEnquiryHospitalFirst::find()->where(['enquiry_id' => $id])->one();
                $patient_hospital_second = PatientEnquiryHospitalSecond::find()->where(['enquiry_id' => $id])->one();
                return $this->render('view', [
                            'model' => $this->findModel($id), 'patient_info_second' => $patient_info_second, 'patient_hospital' => $patient_hospital, 'patient_hospital_second' => $patient_hospital_second
                ]);
        }

        /**
         * Creates a new PatientEnquiryGeneralFirst model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {

                $patient_info = new PatientEnquiryGeneralFirst();
                $patient_info_second = new PatientEnquiryGeneralSecond();
                $patient_hospital = new PatientEnquiryHospitalFirst();
                $patient_hospital_second = new PatientEnquiryHospitalSecond();
                $patient_info->scenario = 'create';
                $hospital_details = '';


                if ($patient_info->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($patient_info) && $patient_hospital->load(Yii::$app->request->post()) && $patient_info_second->load(Yii::$app->request->post()) && $patient_hospital_second->load(Yii::$app->request->post())) {

                        $patient_info->contacted_date = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post()['PatientEnquiryGeneralFirst']['contacted_date']));
                        $patient_info->outgoing_call_date = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post()['PatientEnquiryGeneralFirst']['outgoing_call_date']));

                        if (Yii::$app->user->identity->branch_id != '0') {
                                Yii::$app->SetValues->currentBranch($patient_info);
                        }
                        $patient_hospital->patient_age = date('Y-m-d', strtotime(Yii::$app->request->post()['PatientEnquiryHospitalFirst']['patient_age']));
                        $patient_info_second->expected_date_of_service = date('Y-m-d', strtotime(Yii::$app->request->post()['PatientEnquiryGeneralSecond']['expected_date_of_service']));
                        if (!empty(Yii::$app->request->post()['PatientEnquiryGeneralSecond']['required_service']))
                                $patient_info_second->required_service = implode(",", Yii::$app->request->post()['PatientEnquiryGeneralSecond']['required_service']);

                        if ($patient_info->validate() && $patient_info_second->validate() && $patient_hospital->validate() && $patient_hospital_second->validate()) {

                                if ($patient_info->save() && $patient_info_second->save() && $patient_hospital->save() && $patient_hospital_second->save()) {
                                        $branch = Branch::findOne($patient_info->branch_id);
                                        $code = $branch->branch_code . 'UE';
                                        $patient_info->enquiry_number = $code . '-' . date('d') . date('m') . date('y') . '-' . $patient_info->id;
                                        $patient_info->update();
                                        $this->AddGeneralInfo($patient_info, Yii::$app->request->post(), $patient_info_second);
                                        $this->AddHospitalInfo($patient_info, Yii::$app->request->post(), $patient_hospital, $patient_hospital_second);
                                        $this->AddHospitalDetails($patient_info, Yii::$app->request->post());
                                        $this->AddContactDirectory($patient_info, $patient_info_second);
                                        Yii::$app->History->UpdateHistory('patient-enquiry', $patient_info->id, 'create');
                                        $this->sendMail($patient_info, $patient_info_second);
                                        Yii::$app->getSession()->setFlash('success', 'General Information Added Successfully');
                                        return $this->redirect(array('index'));
                                }
                        }
                }

                return $this->render('_enquiry_form', [
                            'patient_info' => $patient_info,
                            'patient_info_second' => $patient_info_second,
                            'patient_hospital' => $patient_hospital,
                            'patient_hospital_second' => $patient_hospital_second,
                            'hospital_details' => $hospital_details,
                ]);
        }

        /**
         * Updates an existing PatientEnquiryGeneralFirst model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {

                $patient_info = $this->findModel($id);
                $patient_info_second = PatientEnquiryGeneralSecond::find()->where(['enquiry_id' => $patient_info->id])->one();
                $patient_hospital = PatientEnquiryHospitalFirst::find()->where(['enquiry_id' => $patient_info->id])->one();
                $patient_hospital_second = PatientEnquiryHospitalSecond::find()->where(['enquiry_id' => $patient_info->id])->one();
                $hospital_details = PatientEnquiryHospitalDetails::findAll(['enquiry_id' => $patient_info->id]);



                if (!empty($patient_info) && !empty($patient_info_second) && !empty($patient_hospital) && !empty($patient_hospital_second)) {
                        if ($patient_info->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($patient_info) && $patient_hospital->load(Yii::$app->request->post()) && $patient_info_second->load(Yii::$app->request->post()) && $patient_hospital_second->load(Yii::$app->request->post())) {

                                $patient_info->contacted_date = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post()['PatientEnquiryGeneralFirst']['contacted_date']));
                                $patient_info->outgoing_call_date = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post()['PatientEnquiryGeneralFirst']['outgoing_call_date']));
                                $patient_hospital->patient_age = date('Y-m-d', strtotime(Yii::$app->request->post()['PatientEnquiryHospitalFirst']['patient_age']));

                                $patient_info_second->expected_date_of_service = date('Y-m-d', strtotime(Yii::$app->request->post()['PatientEnquiryGeneralSecond']['expected_date_of_service']));
                                if (!empty(Yii::$app->request->post()['PatientEnquiryGeneralSecond']['required_service']))
                                        $patient_info_second->required_service = implode(",", Yii::$app->request->post()['PatientEnquiryGeneralSecond']['required_service']);

                                if ($patient_info->validate() && $patient_info_second->validate() && $patient_hospital->validate() && $patient_hospital_second->validate()) {

                                        if ($patient_info->save() && $patient_info_second->save() && $patient_hospital->save() && $patient_hospital_second->save()) {
                                                $this->AddGeneralInfo($patient_info, Yii::$app->request->post(), $patient_info_second);
                                                $this->AddHospitalInfo($patient_info, Yii::$app->request->post(), $patient_hospital, $patient_hospital_second);
                                                $this->AddHospitalDetails($patient_info, Yii::$app->request->post());

                                                Yii::$app->History->UpdateHistory('patient-enquiry', $patient_info->id, 'update');
                                                Yii::$app->getSession()->setFlash('success', 'Enquiry Updated Successfully');
                                                if (isset($_POST['patinet_info'])) {

                                                        return $this->AddPatientInformation($id);
                                                }
                                                return $this->redirect(array('index'));
                                        }
                                }
                        }
                        return $this->render('_enquiry_form', [
                                    'patient_info' => $patient_info,
                                    'patient_info_second' => $patient_info_second,
                                    'patient_hospital' => $patient_hospital,
                                    'patient_hospital_second' => $patient_hospital_second,
                                    'hospital_details' => $hospital_details,
                        ]);
                } else {
                        throw new \yii\base\UserException("Error Code : 2000");
                }
        }

        /*
         * to add general second informations
         *  */

        public function AddGeneralInfo($patient_info, $data, $patient_info_second) {
                $patient_info->id;
                $patient_info_second->enquiry_id = $patient_info->id;
                $patient_info_second->load($data);
                $patient_info_second->expected_date_of_service = date('Y-m-d', strtotime($data['PatientEnquiryGeneralSecond']['expected_date_of_service']));
                if (!empty($data['PatientEnquiryGeneralSecond']['required_service']))
                        $patient_info_second->required_service = implode(",", $data['PatientEnquiryGeneralSecond']['required_service']);
                if ($patient_info_second->save(false)) {
                        return true;
                } else {
                        return FALSE;
                }
        }

        /*
         * to add hospital informations
         *  */

        public function AddHospitalInfo($patient_info, $data, $patient_hospital, $patient_hospital_second) {

                $patient_hospital->enquiry_id = $patient_info->id;
                $patient_hospital_second->enquiry_id = $patient_info->id;
                $patient_hospital->load($data);
                $patient_hospital_second->load($data);

                if ($patient_hospital->save() && $patient_hospital_second->save()) {
                        return true;
                } else {
                        return FALSE;
                }
        }

        /*
         * to add hospital details
         *  */

        public function AddHospitalDetails($patient_info, $data) {
                /*
                 * to create hospital details
                 */

                if (isset($_POST['create']) && $_POST['create'] != '') {

                        $arr = [];
                        $i = 0;

                        foreach ($_POST['create']['hospital_name'] as $val) {
                                $arr[$i]['hospital_name'] = $val;
                                $i++;
                        }
                        $i = 0;
                        foreach ($_POST['create']['consultant_doctor'] as $val) {
                                $arr[$i]['consultant_doctor'] = $val;
                                $i++;
                        }
                        $i = 0;
                        foreach ($_POST['create']['department'] as $val) {
                                $arr[$i]['department'] = $val;
                                $i++;
                        }
                        $i = 0;
                        foreach ($_POST['create']['hospital_room_no'] as $val) {
                                $arr[$i]['hospital_room_no'] = $val;
                                $i++;
                        }


                        foreach ($arr as $val) {
                                $add_previous = new PatientEnquiryHospitalDetails;
                                $add_previous->enquiry_id = $patient_info->id;
                                $add_previous->hospital_name = $val['hospital_name'];
                                $add_previous->consultant_doctor = $val['consultant_doctor'];
                                $add_previous->department = $val['department'];
                                $add_previous->hospital_room_no = $val['hospital_room_no'];

                                if (!empty($add_previous->hospital_name))
                                        $add_previous->save();
                        }
                }
                /*
                 * to update hospital details
                 */

                if (isset($_POST['updatee']) && $_POST['updatee'] != '') {

                        $arr = [];
                        $i = 0;
                        foreach ($_POST['updatee'] as $key => $val) {


                                $arr[$key]['hospital_name'] = $val['hospital_name'][0];
                                $arr[$key]['consultant_doctor'] = $val['consultant_doctor'][0];
                                $arr[$key]['department'] = $val['department'][0];
                                $arr[$key]['hospital_room_no'] = $val['hospital_room_no'][0];

                                $i++;
                        }

                        foreach ($arr as $key => $value) {
                                $add_previous = PatientEnquiryHospitalDetails::findOne($key);
                                $add_previous->hospital_name = $value['hospital_name'];
                                $add_previous->consultant_doctor = $value['consultant_doctor'];
                                $add_previous->department = $value['department'];
                                $add_previous->hospital_room_no = $value['hospital_room_no'];
                                $add_previous->update();
                        }
                }

                /*
                 * to delete hospital details
                 */

                if (isset($_POST['delete_port_vals']) && $_POST['delete_port_vals'] != '') {

                        $vals = rtrim($_POST['delete_port_vals'], ',');
                        $vals = explode(',', $vals);
                        foreach ($vals as $val) {

                                PatientEnquiryHospitalDetails::findOne($val)->delete();
                        }
                }
        }

        /*
         * to send email
         */

        public function sendMail($patient_info, $model) {

                $to = $model->email;
                $subject = 'Enquiry Received';
                $message = $this->renderPartial('send_mail', ['model' => $model, 'patient_info' => $patient_info]);

                // To send HTML mail, the Content-type header must be set
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n" .
                        "From: info@caringpeople.in";
                //mail($to, $subject, $message, $headers);
        }

        /*
         * To add Pateint Information $id is Enquiry data id
         *  */

        public function AddPatientInformation($id) {

                $model = PatientEnquiryGeneralFirst::find()->where(['id' => $id])->one();
                if (!empty($model)) {
                        return $this->redirect(['patient-information/create', 'id' => $model->id]);
                } else {
                        return $this->redirect(['site/error']);
                }
        }

        /*
         * to add patient genquiry details to contact directory for future use
         * $info_first ->patient_enquiry_general_first table
         * $info_first ->atient_enquiry_general_second table
         */

        public function AddContactDirectory($info_first, $info_second) {
                $model = new ContactDirectory();
                $model->category_type = 1; /* patient enquiry */
                $model->name = $info_first->caller_name;
                $model->email_1 = $info_second->email;
                $model->email_2 = $info_second->email1;
                $model->phone_1 = $info_first->mobile_number;
                $model->phone_2 = $info_first->mobile_number_2;
                if ($info_first->referral_source != 5)
                        $model->references = $info_first->referral_source;
                else
                        $model->references = $info_first->referral_source_others;
                Yii::$app->SetValues->Attributes($model);
                if ($model->validate() && $model->save())
                        return TRUE;
                else
                        return FALSE;
        }

        /**
         * Deletes an existing PatientEnquiryGeneralFirst model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {

                $patient_info = $this->findModel($id);
                $patient_info_second = PatientEnquiryGeneralSecond::find()->where(['enquiry_id' => $id])->one();
                $patient_hospital = PatientEnquiryHospitalFirst::find()->where(['enquiry_id' => $id])->one();
                $patient_hospital_second = PatientEnquiryHospitalSecond::find()->where(['enquiry_id' => $id])->one();


                $transaction = PatientEnquiryGeneralFirst::getDb()->beginTransaction();
                try {
                        if (!empty($patient_hospital_second)) {
                                $patient_hospital_second->delete();
                        }
                        if (!empty($patient_hospital)) {
                                $patient_hospital->delete();
                        }
                        if (!empty($patient_info_second)) {
                                $patient_info_second->delete();
                        }
                        if (!empty($patient_info)) {
                                $patient_info->delete();
                        }

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

        /**
         * Finds the PatientEnquiryGeneralFirst model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return PatientEnquiryGeneralFirst the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = PatientEnquiryGeneralFirst::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

}
