<?php

namespace backend\modules\enquiry\controllers;

use Yii;
use common\models\EnquiryHospital;
use common\models\EnquiryHospitalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\EnquiryOtherInfo;

/**
 * EnquiryHospitalController implements the CRUD actions for EnquiryHospital model.
 */
class EnquiryHospitalController extends Controller {

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
	 * Lists all EnquiryHospital models.
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel = new EnquiryHospitalSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			    'searchModel' => $searchModel,
			    'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single EnquiryHospital model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id) {
		return $this->render('view', [
			    'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new EnquiryHospital model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate($id = Null) {


		if (!empty($id)) {
			$enquiry = \common\models\Enquiry::find()->where(['id' => $id])->one();
			$other_info = EnquiryOtherInfo::find()->where(['enquiry_id' => $id])->one();
			$model = new EnquiryHospital();
			if ($model->load(Yii::$app->request->post())) {

				$model->visit_date = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post()['EnquiryHospital']['visit_date']));
				$model->enquiry_id = $id;
				if ($model->validate() && $model->save()) {
					Yii::$app->getSession()->setFlash('success', 'General Information Added Successfully');
					return $this->redirect(['update', 'id' => $id]);
				}
			}
			return $this->render('create', [
				    'model' => $model,
				    'enquiry' => $enquiry,
				    'other_info' => $other_info,
			]);
		} else {
			return $this->redirect(['enquiry/create']);
		}
	}

	/**
	 * Updates an existing EnquiryHospital model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id) {

		$enquiry = \common\models\Enquiry::find()->where(['id' => $id])->one();
		$other_info = EnquiryOtherInfo::find()->where(['enquiry_id' => $id])->one();
		$model = EnquiryHospital::find()->where(['enquiry_id' => $id])->one();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			Yii::$app->getSession()->setFlash('success', 'Hospital Information Updated Successfully');
			return $this->redirect(Yii::$app->request->referrer);
		} else {
			return $this->render('update', [
				    'model' => $model,
				    'enquiry' => $enquiry,
				    'other_info' => $other_info,
			]);
		}
	}

	/**
	 * Deletes an existing EnquiryHospital model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id) {
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	/**
	 * Finds the EnquiryHospital model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return EnquiryHospital the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = EnquiryHospital::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

}
