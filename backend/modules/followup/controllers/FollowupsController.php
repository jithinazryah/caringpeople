<?php

namespace backend\modules\followup\controllers;

use Yii;
use common\models\Followups;
use common\models\FollowupsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Expression;

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

        /**
         * Displays a single Followups model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id = null) {

                $followups = Followups::find()->where(['assigned_to' => Yii::$app->user->identity->id])->andWhere(['<>', 'status', '1'])->all();
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
                return $this->render('closed', [
                            'followups' => $followups,
                ]);
        }

        /*
         * to view followups that you are in related staffa
         */

        public function actionViewrelated() {
                $followups = Followups::find()->where(new Expression('FIND_IN_SET(:related_staffs, related_staffs)'))->addParams([':related_staffs' => Yii::$app->user->identity->id])->andWhere(['<>', 'status', '1'])->all();
                return $this->render('view', [
                            'followups' => $followups,
                ]);
        }

        public function actionFollowups($type_id = 'NULL', $type = 'NULL', $id = 'NULL', $service = 'NULL') {

                /*
                 * call function Addfollowups to add followups
                 */
                if (isset($_POST['create']) && $_POST['create'] != '') {

                        $this->AddFollowups();
                }
                /*
                 * call function Addfollowups to updtae followup
                 */
                if (isset($_POST['updatee']) && $_POST['updatee'] != '') {
                        $this->UpdateFollowups();
                        $id = '';
                }
                /*
                 *  take already added followups to view
                 */
                $followups = Followups::find()->where(['type' => $type, 'type_id' => $type_id])->andWhere(['<>', 'status', '1'])->all();

                /*
                 * To update a followup
                 */

                if ($id != '')
                        $update_followup = Followups::findOne($id);
                else
                        $update_followup = '';

                return $this->render('_followp_form', [
                            'type_id' => $type_id, 'type' => $type, 'followups' => $followups, 'update_followup' => $update_followup, 'service' => $service
                ]);
        }

        /*
         * To add multiple followups
         */

        public function AddFollowups() {


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
                foreach ($_POST['create']['followup_notes'] as $val) {
                        $arr[$i]['followup_notes'] = $val;
                        $i++;
                }
                $i = 0;
                foreach ($_POST['create']['assigned_from'] as $val) {
                        $arr[$i]['assigned_from'] = $val;
                        $i++;
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



                foreach ($arr as $val) {

                        $add_followp = new Followups;
                        if ($val['type'] != 'NULL') {
                                $add_followp->type = $val['type'];
                        } else {
                                $add_followp->type = $val['typed'];
                        }
                        $add_followp->type_id = $val['type_id'];
                        $add_followp->sub_type = $val['sub_type'];
                        $add_followp->followup_date = date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $val['followup_date'])));
                        $assg_to = explode('_', $val['assigned_to']);
                        if (isset($assg_to))
                                $assgnd_to = $assg_to[0];
                        else
                                $assgnd_to = $val['assigned_to'];

                        $add_followp->assigned_to = $assgnd_to;
                        $add_followp->followup_notes = $val['followup_notes'];
                        $add_followp->assigned_from = Yii::$app->user->identity->id;
                        $add_followp->related_staffs = $val['related_staffs'];
                        $add_followp->attachments = $val['name'];
                        $add_followp->DOC = date('Y-m-d');
                        $add_followp->CB = Yii::$app->user->identity->id;

                        if (!empty($add_followp->assigned_to))
                                $add_followp->save(false);
                        $this->Imageupload($add_followp->id, $val['name'], $val['tmp_name']);
                        $this->sendMail($add_followp, $val['assigned_to']);
                }
        }

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
                        $arr[$key]['status'] = $val['status'][0];
                        if (isset($val['related_staffs']) && $val['related_staffs'] != '')
                                $val['related_staffs'][0] = implode(",", $val['related_staffs']);
                        else
                                $val['related_staffs'][0] = '';
                        $arr[$key]['related_staffs'] = $val['related_staffs'][0];
                        if (isset($_FILES['updatee'])) {
                                foreach ($_FILES['updatee'] ['name'] as $row => $innerArray) {
                                        $i = 0;
                                        foreach ($innerArray as $innerRow => $value) {
                                                $arr[$key]['name'] = $value;
                                                $i++;
                                        }
                                }

                                $i = 0;
                                foreach ($_FILES['updatee'] ['tmp_name'] as $row => $innerArray) {
                                        $i = 0;
                                        foreach ($innerArray as $innerRow => $value) {
                                                $arr[$key]['tmp_name'] = $value;
                                                $i++;
                                        }
                                }
                        }


                        $i++;
                }

                foreach ($arr as $key => $value) {

                        $update_followup = Followups::findOne($key);
                        $previous_image = $update_followup->attachments;
                        $update_followup->sub_type = $value['sub_type'];
                        $update_followup->followup_date = $value['followup_date'];
                        $update_followup->assigned_to = $value['assigned_to'];
                        $update_followup->followup_notes = $value['followup_notes'];
                        $update_followup->related_staffs = $value['related_staffs'];
                        $update_followup->assigned_from = Yii::$app->user->identity->id;
                        $update_followup->status = $value['status'];
                        $update_followup->UB = Yii::$app->user->identity->id;
                        $update_followup->DOU = date('Y-m-d H:i');
                        if (!empty($value['name']))
                                $update_followup->attachments = $value['name'];
                        $update_followup->UB = Yii::$app->user->identity->id;
                        $update_followup->update(false);
                        if (!empty($value['name'])) {
                                unlink(Yii::getAlias(Yii::$app->params['uploadPath']) . '/followups/' . $update_followup->id . "/" . $previous_image);
                                $this->Imageupload($update_followup->id, $value['name'], $value['tmp_name']);
                        }
                }
        }

        /*
         * upload attav=chements to each folllowup
         */

        public function Imageupload($id, $filename, $Tmpfilename) {
                $paths = ['followups', $id];
                $paths = Yii::$app->UploadFile->CheckPath($paths);
                $target_dir = Yii::getAlias(Yii::$app->params['uploadPath']) . '/followups/' . $id . "/";
                $target_file = $target_dir . $filename;

                move_uploaded_file($Tmpfilename, $target_file);
        }

        /*
         * to send email
         */

        public function sendMail($add_followp, $assigned) {

                $assg_to = explode('_', $assigned);
                if (isset($assg_to[1]) && $assg_to[1] == 'p') {
                        $email_to = \common\models\PatientGeneral::findOne($assg_to[0]);
                } else {
                        $email_to = \common\models\StaffInfo::findOne($assg_to[0]);
                }
                if (isset($email_to->email) && $email_to->email != '') {
                        $to = $email_to->email;
                        $subject = 'Followup Assigned';
                        $message = $this->renderPartial('send-mail', ['assigned_to' => $assg_to[0]]);

                        // To send HTML mail, the Content-type header must be set
                        $headers = 'MIME-Version: 1.0' . "\r\n";
                        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n" .
                                "From: info@caringpeople.in";
                        mail($to, $subject, $message, $headers);
                }
        }

        /*
         * to view closed followups of ecah patient/staff/closed
         */

        public function actionClosed($type_id = 'NULL', $type = 'NULL') {

                $followups = Followups::find()->where(['type_id' => $type_id, 'status' => '1'])->all();

                if ($type_id == 'NULL' && $type == 'NULL')
                        $followups = Followups::find()->where(['assigned_to' => Yii::$app->user->identity->id, 'status' => '1'])->all();

                return $this->render('closed', [
                            'followups' => $followups, 'type_id' => $type_id, 'type' => $type
                ]);
        }

        public function actionDelete($id) {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
        }

        /**
         * Finds the Followups model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return Followups the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = Followups::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

}
