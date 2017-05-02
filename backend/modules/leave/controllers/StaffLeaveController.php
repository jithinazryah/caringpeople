<?php

namespace backend\modules\leave\controllers;

use Yii;
use common\models\StaffLeave;
use common\models\StaffLeaveSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\StaffInfo;
use common\models\Attendance;
use common\models\AttendanceEntry;
use common\models\AdminUsers;

/**
 * StaffLeaveController implements the CRUD actions for StaffLeave model.
 */
class StaffLeaveController extends Controller {

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
	 * Lists all pending leave on admin side for approve or decline
	 * 	 */
	public function actionIndex() {

		if (Yii::$app->session['post']['admin'] != 1) {
			return $this->redirect(['../site/home']);
		}

		$pending_leave = StaffLeave::find()->where(['status' => 1])->all();
		return $this->render('index', [
			    'pending_leave' => $pending_leave
		]);
	}

	/**
	 * Displays a single StaffLeave model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id) {

		return $this->render('view', [
			    'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new StaffLeave model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new StaffLeave();


		if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {

			$model->employee_id = Yii::$app->user->identity->id;
			//$model->info_table_id = Yii::$app->user->identity->staff_info_id;
			$model->commencing_date = date('Y-m-d', strtotime(Yii::$app->request->post()['StaffLeave']['commencing_date']));
			$model->ending_date = date('Y-m-d', strtotime(Yii::$app->request->post()['StaffLeave']['ending_date']));
			$model->status = 1;
			$check = StaffLeave::findOne(['employee_id' => Yii::$app->user->identity->id, 'commencing_date' => $model->commencing_date]);
			if (empty($check)) {
				if ($model->validate() && $model->save()) {
					if ($model->no_of_days > 1)
						$this->MultipleDays($model);
					return $this->redirect(['view', 'id' => $model->id]);
				}
			}else {
				Yii::$app->getSession()->setFlash('error', "<strong>Error! </strong>data already entered");
			}
		}
		return $this->render('create', [
			    'model' => $model,
		]);
	}

	public function MultipleDays($model) {

		$days = $model->no_of_days - 1;
		$transaction = Yii::$app->db->beginTransaction();
		try {

			for ($i = 1; $i <= $days; $i++) {
				$model_new = new StaffLeave();
				$model_new->employee_id = $model->employee_id;
				//$model_new->info_table_id = $model->info_table_id;
				$model_new->no_of_days = $model->no_of_days;
				$model_new->leave_type = $model->leave_type;
				$model_new->commencing_date = date("Y-m-d", strtotime("+" . $i . " day", strtotime($model->commencing_date)));
				$model_new->ending_date = $model->ending_date;
				$model_new->purpose = $model->purpose;
				$model_new->status = $model->status;
				$model_new->save(FALSE);
			}
			$transaction->commit();

			Yii::$app->getSession()->setFlash('success', 'Leave Application is successfully applied');
			return true;
			// $this->refresh();
		} catch (Exception $e) {
			$transaction->rollBack();
			Yii::$app->getSession()->setFlash('error', "<strong>Technical error! </strong>{$e->getMessage()}");
			return FALSE;
// $this->refresh();
		}
	}

	/**
	 * Updates an existing StaffLeave model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id) {
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post())) {

			$model->commencing_date = date('Y-m-d', strtotime(Yii::$app->request->post()['StaffLeave']['commencing_date']));
			$model->ending_date = date('Y-m-d', strtotime(Yii::$app->request->post()['StaffLeave']['ending_date']));
			$model->status = 1;
			$check = StaffLeave::findOne(['employee_id' => Yii::$app->user->identity->id, 'commencing_date' => $model->commencing_date]);
			if (empty($check)) {
				if ($model->validate() && $model->save()) {
					if ($model->no_of_days > 1)
						$this->MultipleDays($model);
					Yii::$app->getSession()->setFlash('success', 'Leave Application is successfully updated');
					return $this->redirect(['view', 'id' => $model->id]);
				}
			}else {
				Yii::$app->getSession()->setFlash('error', "<strong>Error! </strong>data already entered");
			}
		}
		return $this->render('update', [
			    'model' => $model,
		]);
	}

	/*
	 * to approve status leave by admin
	 */

	public function actionLeaveStatus() {
		if (Yii::$app->request->isAjax) {
			$leave_id = $_POST['leave_id'];
			$leave_model = StaffLeave::find()->where(['id' => $leave_id])->one();
			$leave_model->status = 2;
			$leave_model->update();
		}
	}

	/**
	 * Deletes an existing StaffLeave model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id) {
		$this->findModel($id)->delete();

		return $this->redirect(['create']);
	}

	/*
	 * to show history of applied leave by current user
	 */

	public function actionLeaveHistory() {
		$searchModel = new StaffLeaveSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->query->andWhere(['employee_id' => Yii::$app->user->identity->id]);
		return $this->render('history', [
			    'searchModel' => $searchModel,
			    'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Finds the StaffLeave model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return StaffLeave the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = StaffLeave::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

}
