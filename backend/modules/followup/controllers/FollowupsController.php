<?php

namespace backend\modules\followup\controllers;

use Yii;
use common\models\Followups;
use common\models\FollowupsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Expression;
use common\models\RepeatedFollowups;

/**
 * FollowupsController implements the CRUD actions for Followups model.
 */
class FollowupsController extends Controller {

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
         * Lists all Followups models.
         * @return mixed
         */
        public function actionIndex() {
                $searchModel = new FollowupsSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andWhere(['assigned_to' => Yii::$app->user->identity->id]);
                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        public function actionView($data = null) {

                $followups = Followups::find()->where(['assigned_to' => Yii::$app->user->identity->id])->andWhere(['<>', 'status', '1'])->all();
                $repeated = RepeatedFollowups::find()->where(['assigned_to' => Yii::$app->user->identity->id])->andWhere(['<>', 'status', '1'])->all();
                if (!empty($data)) {
                        $data = Yii::$app->EncryptDecrypt->Encrypt('decrypt', $data);
                        $followups = Followups::find()->where(['id' => $data])->one();
                }
                return $this->render('index', [
                            'followups' => $followups,
                ]);
        }

        /*
         * to view closed followups to assif=gned persons (my tasks-closed
         */

        public function actionAssignedclosed() {
                $followups = Followups::find()->where(['assigned_to' => Yii::$app->user->identity->id])->andWhere(['status' => '1'])->all();
                $followups = RepeatedFollowups::find()->where(['assigned_to' => Yii::$app->user->identity->id])->andWhere(['status' => '1'])->all();
                $followups = array_merge($followups, $repeated_followups);
                return $this->render('closed', [
                            'followups' => $followups,
                ]);
        }

        /*
         * to view followups that you are in related staffa
         */

        public function actionViewrelated() {

                $followups = Followups::find()->where(new Expression('FIND_IN_SET(:related_staffs, related_staffs)'))->addParams([':related_staffs' => Yii::$app->user->identity->id])->andWhere(['<>', 'status', '1'])->all();
                $repeated_followups = RepeatedFollowups::find()->where(new Expression('FIND_IN_SET(:related_staffs, related_staffs)'))->addParams([':related_staffs' => Yii::$app->user->identity->id])->andWhere(['<>', 'status', '1'])->all();
                $followups = array_merge($followups, $repeated_followups);
                return $this->render('view', [
                            'followups' => $followups,
                ]);
        }

        /*
         * to view closed followups of ecah patient/staff/closed
         */

        public function actionClosed($type_id = 'NULL', $type = 'NULL') {

                $followups = Followups::find()->where(['type_id' => $type_id, 'status' => '1'])->all();
                $repeated_followups = RepeatedFollowups::find()->where(['type_id' => $type_id, 'status' => '1'])->all();
                if ($type_id == 'NULL' && $type == 'NULL') {
                        $followups = Followups::find()->where(['assigned_to' => Yii::$app->user->identity->id, 'status' => '1'])->all();
                        $repeated_followups = RepeatedFollowups::find()->where(['assigned_to' => Yii::$app->user->identity->id, 'status' => '1'])->all();
                }
                $followups = array_merge($followups, $repeated_followups);

                return $this->render('closed', [
                            'followups' => $followups, 'type_id' => $type_id, 'type' => $type
                ]);
        }

        /*
         *
         */

        public function actionFollowups($type_id = 'NULL', $type = 'NULL', $id = 'NULL', $service = 'NULL', $repeated = 'NULL') {


                /*
                 * call function Addfollowups to add followups
                 */
                if (isset($_POST['create']) && $_POST['create'] != '') {

                        if (isset($_POST['create']['repeated_followups']) && $_POST['create']['repeated_followups'] == 'on')
                                $this->RepeatedFollowups();
                        else
                                $this->AddFollowups();
                }
                /*
                 * call function Updatefollowups to updtae followup
                 */
                if (isset($_POST['updatee']) && $_POST['updatee'] != '') {
                        $this->UpdateFollowups();
                        $id = '';
                }

                $followups = Followups::find()->where(['type' => $type, 'type_id' => $type_id])->andWhere(['<>', 'status', '1'])->all();
                $repeated_followups = RepeatedFollowups::find()->where(['type' => $type, 'type_id' => $type_id])->all();
                $followups = array_merge($followups, $repeated_followups);


                if ($id != '' && $repeated == '') {
                        $update_followup = Followups::findOne($id);
                } else if ($id != '' && $repeated != '') {
                        $update_followup = RepeatedFollowups::findOne($id);
                } else {
                        $update_followup = null;
                }

                return $this->render('_followp_form', [
                            'type_id' => $type_id, 'type' => $type, 'followups' => $followups, 'update_followup' => $update_followup, 'service' => $service, 'repeated' => $repeated
                ]);
        }

        /*
         * To add re;peated followups
         */

        public function RepeatedFollowups() {

                $arr = $this->AssignData();
                $k = 0;
                foreach ($_POST['create']['repeated_option'] as $val) {

                        $arr[$k]['repeated_option'] = $val;
                        $i++;
                }
                foreach ($_POST['create']['remind_days1'] as $val) {
                        $arr[$k]['remind_days1'] = implode(',', $val);
                        $i++;
                }
                if ($_POST['create']['specific-days'] != '') {
                        foreach ($_POST['create']['specific-days'] as $val) {

                                $arr[$k]['specific-days'] = implode(',', $val);
                                $i++;
                        }
                }
                if ($_POST['create']['specific-dates-month'] != '') {
                        foreach ($_POST['create']['specific-dates-month'] as $val) {

                                $arr[$k]['specific-dates-month'] = implode(',', $val);
                                $i++;
                        }
                }
                $this->AddRepeatedData($arr);
        }

        /*
         * To add multiple followups
         */

        public function AddFollowups() {

                $arr = $this->AssignData();
                foreach ($arr as $val) {
                        $add_followp = new Followups;
                        $added_followup = Yii::$app->Followups->StoreData($add_followp, $val);

                        if (!empty($add_followp->attachments))
                                $this->Imageupload($add_followp->id, $add_followp->attachments, $val['tmp_name'], '1');
                        Yii::$app->Followups->sendMail($add_followp, $add_followp->assigned_to_type);
                }
        }

        /*
         * store data in array
         */

        public function AssignData() {



                $arr = [];
                $i = 0;
                foreach ($_POST['create']['type_id'] as $val) {
                        $arr[$i]['type_id'] = $val;
                        $i++;
                }
                $i = 0;
                foreach ($_POST['create']['type'] as $val) {
                        $arr[$i]['type'] = $val;
                        $i++;
                }
                if (isset($_POST['create']['typed'])) {
                        $i = 0;
                        foreach ($_POST['create']['typed'] as $val) {
                                $arr[$i]['typed'] = $val;
                                $i++;
                        }
                }
                $i = 0;
                if (isset($_POST['create']['sub_type'])) {
                        foreach ($_POST['create']['sub_type'] as $val) {
                                $arr[$i]['sub_type'] = $val;
                                $i++;
                        }
                } else {
                        $arr[$i]['sub_type'] = '';
                        $i++;
                }
                $i = 0;
                foreach ($_POST['create']['followup_date'] as $val) {
                        $arr[$i]['followup_date'] = $val;
                        $i++;
                }
                $i = 0;
                foreach ($_POST['create']['assigned_to'] as $val) {
                        $arr[$i]['assigned_to'] = $val;
                        $i++;
                }
                $i = 0;
                foreach ($_POST['create']['assigned_to_type'] as $val) {
                        $arr[$i]['assigned_to_type'] = $val;
                        $i++;
                }
                $i = 0;
                foreach ($_POST['create']['followup_notes'] as $val) {
                        $arr[$i]['followup_notes'] = $val;
                        $i++;
                }
                $i = 0;
                foreach ($_POST['create']['assigned_from'] as $val) {
                        $arr[$i]['assigned_from'] = $val;
                        $i++;
                }

                if (isset($_POST['create']['related-patient'])) {
                        $i = 0;
                        foreach ($_POST['create']['related-patient'] as $val) {
                                $arr[$i]['related-patient'] = $val;
                                $i++;
                        }
                }
                $i = 0;
                foreach ($_FILES['create'] ['name'] as $row => $innerArray) {
                        $i = 0;
                        foreach ($innerArray as $innerRow => $value) {
                                $arr[$i]['name'] = $value;
                                $i++;
                        }
                }
                $i = 0;
                foreach ($_FILES['create'] ['tmp_name'] as $row => $innerArray) {
                        $i = 0;
                        foreach ($innerArray as $innerRow => $value) {
                                $arr[$i]['tmp_name'] = $value;
                                $i++;
                        }
                }
                $i = 0;
                if ($_POST['create']['related_staffs'] != '') {
                        foreach ($_POST['create']['related_staffs'] as $value) {
                                $arr[$i]['related_staffs'] = implode(',', $value);
                                $i++;
                        }
                }

                return $arr;
        }

        /*
         * add repated followups to table
         */

        public function AddRepeatedData($arr) {
                foreach ($arr as $val) {

                        if ($val['repeated_option'] != '1') {
                                $repeated_followup = new \common\models\RepeatedFollowups;
                                Yii::$app->Followups->StoreData($repeated_followup, $val);
                                $repeated_followup->repeated_type = $val['repeated_option'];
                                if ($repeated_followup->repeated_type == '2') {
                                        $repeated_date = $val['specific-days'];
                                } else if ($repeated_followup->repeated_type == '3') {
                                        $repeated_date = $val['specific-dates-month'];
                                }
                                $repeated_followup->repeated_days = $repeated_date;
                                $repeated_followup->save(false);
                                if (!empty($repeated_followup->attachments))
                                        $this->Imageupload($repeated_followup->id, $repeated_followup->attachments, $val['tmp_name'], '2');
                        } else {
                                $repeated_dates = explode(',', $val['remind_days1']);
                                foreach ($repeated_dates as $date) {
                                        $repeated_followup = new Followups();
                                        Yii::$app->Followups->StoreData($repeated_followup, $val);
                                        $repeated_followup->followup_date = date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $date)));
                                        $repeated_followup->save(false);
                                        if (!empty($repeated_followup->attachments))
                                                $this->Imageupload($repeated_followup->id, $repeated_followup->attachments, $val['tmp_name'], '1');
                                }
                        }
                }
        }

//--------------------------------------------------------------Update Followup Functions-------------------------------------------------------------//

        /*
         * To update Followups
         */

        public function UpdateFollowups() {
                $arr = [];
                $i = 0;

                foreach ($_POST['updatee'] as $key => $val) {
                        $arr[$key]['sub_type'] = $val['sub_type'][0];
                        $arr[$key]['followup_date'] = date('Y-m-d H:i:s', strtotime($val['followup_date'][0]));
                        $arr[$key]['assigned_to'] = $val['assigned_to'][0];
                        $arr[$key]['followup_notes'] = $val['followup_notes'][0];
                        $arr[$key]['assigned_from'] = Yii::$app->user->identity->id;
                        $arr[$key]['related-patient'] = $val['related-patient'][0];
                        $arr[$key]['status'] = $val['status'][0];
                        if (isset($val['related_staffs']) && $val['related_staffs'] != '')
                                $val['related_staffs'][0] = implode(",", $val['related_staffs']);
                        else
                                $val['related_staffs'][0] = '';
                        $arr[$key]['related_staffs'] = $val['related_staffs'][0];
                        if (isset($_FILES['updatee'])) {
                                foreach ($_FILES['updatee'] ['name'] as $row => $innerArray) {
                                        foreach ($innerArray as $innerRow => $value) {
                                                $arr[$key]['name'] = $value;
                                        }
                                }
                                foreach ($_FILES['updatee'] ['tmp_name'] as $row => $innerArray) {
                                        foreach ($innerArray as $innerRow => $value) {
                                                $arr[$key]['tmp_name'] = $value;
                                        }
                                }
                        }
                        if (isset($val['repeated_followups'][0]) && $val['repeated_followups'][0] == 'on') {
                                $arr[$key]['repeated'] = 1;
                                $arr[$key]['repeated_option'] = $val['repeated_option'][0];
                                if (isset($val['specific-days']) && $val['specific-days'] != '')
                                        $arr[$key]['specific-days'] = implode(",", $val['specific-days']);
                                else
                                        $arr[$key]['specific-days'] = '';

                                if (isset($val['specific-dates-month']) && $val['specific-dates-month'] != '')
                                        $arr[$key]['specific-dates-month'] = implode(",", $val['specific-dates-month']);
                                else
                                        $arr[$key]['specific-dates-month'] = '';
                        }
                        $i++;
                }
                $this->Update($arr);
        }

        public function Update($arr) {

                foreach ($arr as $key => $value) {
                        if (!isset($value['repeated'])) {
                                $update_followup = Followups::findOne($key);
                                $this->UpdaateData($update_followup, $value);
                        } else {
                                $update_followup = RepeatedFollowups::findOne($key);
                                $this->UpdaateData($update_followup, $value);
                                $update_followup->repeated_type = $value['repeated_option'];
                                if ($update_followup->repeated_type == '2') {
                                        $repeated_date = $value['specific-days'];
                                } else if ($update_followup->repeated_type == '3') {
                                        $repeated_date = $value['specific-dates-month'];
                                }
                                $update_followup->repeated_days = $repeated_date;
                        }
                        $previous_image = $update_followup->attachments;
                        $update_followup->update(false);
                        if (!empty($value['name'])) {
                                unlink(Yii::getAlias(Yii::$app->params['uploadPath']) . '/followups/' . $update_followup->id . "/" . $previous_image);
                                $this->Imageupload($update_followup->id, $value['name'], $value['tmp_name'], '1');
                        }
                }
        }

        public function UpdaateData($update_followup, $value) {

                $update_followup->sub_type = $value['sub_type'];
                $update_followup->followup_date = $value['followup_date'];
                $update_followup->assigned_to = $value['assigned_to'];
                $update_followup->followup_notes = $value['followup_notes'];
                $update_followup->related_staffs = $value['related_staffs'];
                $update_followup->assigned_from = Yii::$app->user->identity->id;
                $update_followup->status = $value['status'];
                $update_followup->UB = Yii::$app->user->identity->id;
                $update_followup->DOU = date('Y-m-d H:i');
                if ($value['related-patient'] == '1') {
                        $service_patient = \common\models\Service::findOne($update_followup->type_id);
                        $patient_id = $service_patient->patient_id;
                } else {
                        $patient_id = '';
                }
                $update_followup->releated_notification_patient = $patient_id;
                if (!empty($value['name']))
                        $update_followup->attachments = $value['name'];
                $update_followup->UB = Yii::$app->user->identity->id;
        }

        //--------------------------------------------------------------Update Followup Functions ends-------------------------------------------------------------//




        /*
         * upload attachements to each folllowup
         */

        public function Imageupload($id, $filename, $Tmpfilename, $type) {
                if ($type == '1')
                        $paths = ['followups', $id];
                else
                        $paths = ['followups', 'repeated', $id];
                $paths = Yii::$app->UploadFile->CheckPath($paths);
                $target_dir = $paths . "/";
                $target_file = $target_dir . $filename;
                move_uploaded_file($Tmpfilename, $target_file);
        }

        protected function findModel($id) {
                if (($model = Followups::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

        public function actionFollowupscron() {

                $today_date_time = date('Y-m-d H:i:s');
                $today = date("Y-m-d");
                $today_day = date("l");
                $today_date = date("j");

                /*
                 * Ever Day
                 */
                $today_followup = RepeatedFollowups::find()->where(['like', 'followup_date', $today])->all();
                foreach ($today_followup as $value) {
                        $followup = new Followups();
                        Yii::$app->Followups->Addcronfollowup($followup, $value);
                }

                /*
                 * Specific days in a week
                 */
                $followup_days = RepeatedFollowups::find()->where(new Expression('FIND_IN_SET(:repeated_days, repeated_days)'))->addParams([':repeated_days' => $today_day])->all();
                foreach ($today_followup as $value) {
                        $followup = new Followups();
                        Yii::$app->Followups->Addcronfollowup($followup, $value);
                }

                /*
                 * specific dates in amonth
                 */
                $followup_dates = RepeatedFollowups::find()->where(new Expression('FIND_IN_SET(:repeated_days, repeated_days)'))->addParams([':repeated_days' => $today_date])->all();
                foreach ($today_followup as $value) {
                        $followup = new Followups();
                        Yii::$app->Followups->Addcronfollowup($followup, $value);
                }
        }

}
