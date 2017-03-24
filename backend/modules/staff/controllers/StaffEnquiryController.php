<?php

namespace backend\modules\staff\controllers;

use Yii;
use common\models\StaffEnquiry;
use common\models\StaffEnquirySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StaffEnquiryController implements the CRUD actions for StaffEnquiry model.
 */
class StaffEnquiryController extends Controller {

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
         * Lists all StaffEnquiry models.
         * @return mixed
         */
        public function actionIndex() {
                $searchModel = new StaffEnquirySearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        /**
         * Displays a single StaffEnquiry model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
        }

        /**
         * Creates a new StaffEnquiry model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {
                $model = new StaffEnquiry();

                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && Yii::$app->SetValues->currentBranch($model)) {
                        $model->follow_up_date = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post()['StaffEnquiry']['follow_up_date']));
                        if ($model->save()) {
                                return $this->redirect(['index']);
                        }
                }
                return $this->render('create', [
                            'model' => $model,
                ]);
        }

        /**
         * Updates an existing StaffEnquiry model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {
                $model = $this->findModel($id);

                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && Yii::$app->SetValues->currentBranch($model)) {
                        $model->follow_up_date = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post()['StaffEnquiry']['follow_up_date']));
                        if ($model->save())
                                if (isset($_POST['proceed']))
                                        return $this->redirect(['staff-info/create']);
                                else
                                        return $this->redirect(['index']);
                }
                return $this->render('update', [
                            'model' => $model,
                ]);
        }

        /**
         * Deletes an existing StaffEnquiry model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
        }

        /**
         * Finds the StaffEnquiry model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return StaffEnquiry the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = StaffEnquiry::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

}
