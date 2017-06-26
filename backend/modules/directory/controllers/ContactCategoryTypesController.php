<?php

namespace backend\modules\directory\controllers;

use Yii;
use common\models\ContactCategoryTypes;
use common\models\ContactCategoryTypesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContactCategoryTypesController implements the CRUD actions for ContactCategoryTypes model.
 */
class ContactCategoryTypesController extends Controller {

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
	 * Lists all ContactCategoryTypes models.
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel = new ContactCategoryTypesSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $model = new ContactCategoryTypes();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['index']);
		} 

		return $this->render('index', [
			    'searchModel' => $searchModel,
			    'dataProvider' => $dataProvider,
                            'model' => $model,
		]);
	}

	/**
	 * Displays a single ContactCategoryTypes model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id) {
		return $this->render('view', [
			    'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new ContactCategoryTypes model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new ContactCategoryTypes();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['index']);
		} else {
			return $this->render('create', [
				    'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing ContactCategoryTypes model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id) {
		$model = $this->findModel($id);
                $searchModel = new ContactCategoryTypesSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['index']);
		} else {
			return $this->render('index', [
			    'searchModel' => $searchModel,
			    'dataProvider' => $dataProvider,
                            'model' => $model,
		]);
		}
	}

	/**
	 * Deletes an existing ContactCategoryTypes model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id) {
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	/**
	 * Finds the ContactCategoryTypes model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return ContactCategoryTypes the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = ContactCategoryTypes::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

}
