<?php

namespace backend\modules\enquiry\controllers;

use Yii;
use common\models\Enquiry;
use common\models\EnquirySearch;
use common\models\Followups;
use common\models\FollowupsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\EnquiryHospital;
use common\models\EnquiryOtherInfo;

/**
 * EnquiryController implements the CRUD actions for Enquiry model.
 */
class EnquiryController extends Controller {

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

        public function actionIndex() {

                $searchModel = new EnquirySearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                if (isset($_GET['email'])) {
                        $dataProvider->query->where(['email' => $_GET['email']]);
                }
                if (Yii::$app->user->identity->branch_id != '0') {
                        $dataProvider->query->where(['branch_id' => Yii::$app->user->identity->branch_id]);
                }

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        public function actionView($id) {
                $hospital_info = EnquiryHospital::findOne(['enquiry_id' => $id]);
                $other_info = EnquiryOtherInfo::findOne(['enquiry_id' => $id]);
                return $this->render('view', [
                            'model' => $this->findModel($id), 'hospital_info' => $hospital_info, 'other_info' => $other_info,
                ]);
        }

        public function actionNewEnquiry() {
                $model = new Enquiry();
                $hospital_info = new EnquiryHospital();
                $other_info = new EnquiryOtherInfo();
                $followup_info = new Followups();
                $model->scenario = 'create';
                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) /* && Yii::$app->SetValues->currentBranch($model) /* && $model->save() */) {
                        $model->contacted_date = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post()['Enquiry']['contacted_date']));
                        $model->outgoing_call_date = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post()['Enquiry']['outgoing_call_date']));
                        $followup_info->load(Yii::$app->request->post());
                        $followup_info->status = '0';
                        if (Yii::$app->user->identity->branch_id != '0') {
                                Yii::$app->SetValues->currentBranch($model);
                        }
                        if ($model->validate() && $model->save()) {
                                if ($model->branch_id == '1') {
                                        $code = 'CPCUE';
                                } else if ($model->branch_id == '2') {
                                        $code = 'CPBUE';
                                }
                                $model->enquiry_id = $code . '-' . date('d') . date('m') . date('y') . '-' . $model->id;
                                $model->update();
                                $this->AddHospitalInfo($model, Yii::$app->request->post(), $hospital_info);
                                $this->AddOtherInfo($model, Yii::$app->request->post(), $other_info);
                                Yii::$app->Followups->addfollowups('0', $model->id, $followup_info);
                                Yii::$app->History->UpdateHistory('enquiry', $model->id, 'create');
                                $this->sendMail($model);
                                Yii::$app->getSession()->setFlash('success', 'General Information Added Successfully');
                                return $this->redirect('enquiry/enquiry/index');
                        }
                }

                return $this->render('_enquiry_form', [
                            'model' => $model,
                            'hospital_info' => $hospital_info,
                            'other_info' => $other_info,
                            'followup_info' => $followup_info,
                ]);
        }

        public function actionUpdate($id) {
                $model = $this->findModel($id);
                $hospital_info = EnquiryHospital::find()->where(['enquiry_id' => $model->id])->one();
                $other_info = EnquiryOtherInfo::find()->where(['enquiry_id' => $model->id])->one();
                if (isset($_GET['followup']))
                        $followup_info = Followups::findOne($_GET['followup']);
                else
                        $followup_info = new Followups();

                $searchModel = new FollowupsSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andWhere(['type' => '0', 'type_id' => $id]);

                if (!isset($hospital_info))
                        $hospital_info = new EnquiryHospital;
                if (!isset($other_info))
                        $other_info = new EnquiryOtherInfo;
                if (!empty($model) && !empty($hospital_info) && !empty($other_info)) {
                        if ($model->load(Yii::$app->request->post())) {

                                $model->contacted_date = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post()['Enquiry']['contacted_date']));
                                $model->outgoing_call_date = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post()['Enquiry']['outgoing_call_date']));
                                $followup_info->load(Yii::$app->request->post());
                                if ($model->validate() && $model->save()) {
                                        $this->AddHospitalInfo($model, Yii::$app->request->post(), $hospital_info);
                                        $this->AddOtherInfo($model, Yii::$app->request->post(), $other_info);
                                        if (isset($_GET['followup'])) {
                                                Yii::$app->Followups->Updatefollowups($_GET['followup'], $followup_info);
                                        } else {
                                                $followup_info->status = '0';
                                                Yii::$app->Followups->addfollowups('3', $model->id, $followup_info);
                                        }
                                        Yii::$app->History->UpdateHistory('enquiry', $model->id, 'update');
                                        Yii::$app->getSession()->setFlash('success', 'Enquiry Updated Successfully');
                                        return $this->redirect(array('index'));
                                }
                        }
                        return $this->render('_enquiry_form', [
                                    'model' => $model,
                                    'hospital_info' => $hospital_info,
                                    'other_info' => $other_info,
                                    'followup_info' => $followup_info,
                                    'dataProvider' => $dataProvider,
                                    'followup_id' => $_GET['followup'],
                        ]);
                } else {
                        return $this->redirect(['create']);
                }
        }

        /*
         * to add hospital informations
         *  */

        public function AddHospitalInfo($model, $data, $hospital_info) {

                $hospital_info->enquiry_id = $model->id;
                $hospital_info->load($data);
                if (!empty($data['EnquiryHospital']['required_service']))
                        $hospital_info->required_service = implode(",", $data['EnquiryHospital']['required_service']);
                $hospital_info->visit_date = date('Y-m-d H:i:s', strtotime($data['EnquiryHospital']['visit_date']));

                if ($hospital_info->validate() && $hospital_info->save()) {
                        return true;
                } else {
                        return FALSE;
                }
        }

        /*
         * to add other informations
         *  */

        public function AddOtherInfo($model, $data, $other_info) {
                $other_info->enquiry_id = $model->id;
                $other_info->load($data);
                $other_info->nursing_assessment = date('Y-m-d', strtotime($data['EnquiryOtherInfo']['nursing_assessment']));
                $other_info->doctor_assessment = date('Y-m-d', strtotime($data['EnquiryOtherInfo']['doctor_assessment']));
                $other_info->followup_date = date('Y-m-d H:i:s', strtotime($data['EnquiryOtherInfo']['followup_date']));
                $other_info->date_of_discharge = date('Y-m-d', strtotime($data['EnquiryOtherInfo']['date_of_discharge']));
                $other_info->expected_date_of_service = date('Y-m-d', strtotime($data['EnquiryOtherInfo']['expected_date_of_service']));

                if ($other_info->validate() && $other_info->save()) {
                        return true;
                } else {
                        return FALSE;
                }
        }

        public function sendMail($model) {

                $to = $model->email;
                $subject = 'Enquiry Received';
                $message = $this->renderPartial('send_mail', ['model' => $model]);

                // To send HTML mail, the Content-type header must be set
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n" .
                        "From: info@caringpeople.in";
                //mail($to, $subject, $message, $headers);
        }

        public function actionDelete($id) {
                $enquiry = $this->findModel($id);
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
                        if (!empty($enquiry)) {
                                $enquiry->delete();
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

        /**
         * Finds the Enquiry model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return Enquiry the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = Enquiry::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

}
