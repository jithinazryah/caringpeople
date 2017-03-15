<?php

namespace backend\modules\enquiry\controllers;

use Yii;
use common\models\EnquiryOtherInfo;
use common\models\EnquiryOtherInfoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\EnquiryHospital;
use common\models\Enquiry;

/**
 * EnquiryOtherInfoController implements the CRUD actions for EnquiryOtherInfo model.
 */
class EnquiryOtherInfoController extends Controller {

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
	 * Lists all EnquiryOtherInfo models.
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel = new EnquiryOtherInfoSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			    'searchModel' => $searchModel,
			    'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single EnquiryOtherInfo model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id) {
		return $this->render('view', [
			    'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new EnquiryOtherInfo model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate($id = null) {
		/* $id is enquiry table auto increment id */


		if (!empty($id)) {
			$hospital_info = EnquiryHospital::find()->where(['enquiry_id' => $id])->one();
			$enquiry = Enquiry::find()->where(['id' => $id])->one();
			if (!empty($enquiry)) {

				$model = new EnquiryOtherInfo();
				if ($model->load(Yii::$app->request->post())) {
					$model->followup_date = date('Y-m-d', strtotime(Yii::$app->request->post()['EnquiryOtherInfo']['followup_date']));
					$model->enquiry_id = $id;
					if ($model->validate() && $model->save()) {
						Yii::$app->getSession()->setFlash('success', 'Other Information Added Successfully');
						return $this->redirect(['update', 'id' => $id]);
					}
				} else {
					return $this->render('create', [
						    'model' => $model,
						    'enquiry' => $enquiry,
						    'hospital_info' => $hospital_info,
					]);
				}
			} else {
				return $this->redirect(['enquiry/create']);
			}
		} else {
			return $this->redirect(['enquiry-hospital/create', 'id' => $id]);
		}
	}

	/**
	 * Updates an existing EnquiryOtherInfo model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id) {
		$enquiry = \common\models\Enquiry::find()->where(['id' => $id])->one();
		$hospital_info = EnquiryHospital::find()->where(['enquiry_id' => $id])->one();
		$model = EnquiryOtherInfo::find()->where(['enquiry_id' => $id])->one();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			Yii::$app->getSession()->setFlash('success', 'Other Information Updated Successfully');
			return $this->redirect(['enquiry/index']);
		}
		return $this->render('update', [
			    'model' => $model,
			    'enquiry' => $enquiry,
			    'hospital_info' => $hospital_info,
		]);
	}

	/**
	 * Deletes an existing EnquiryOtherInfo model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id) {
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	/**
	 * Finds the EnquiryOtherInfo model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return EnquiryOtherInfo the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = EnquiryOtherInfo::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

}
