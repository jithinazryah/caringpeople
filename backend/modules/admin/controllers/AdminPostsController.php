<?php

namespace backend\modules\admin\controllers;

use Yii;
use common\models\AdminPosts;
use common\models\AdminPostsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\components\SetValues;

/**
 * AdminPostsController implements the CRUD actions for AdminPosts model.
 */
class AdminPostsController extends Controller {

	/**
	 * @inheritdoc
	 */
	        public function beforeAction($action) {
                if (!parent::beforeAction($action)) {
                        return false;
                }
                if (Yii::$app->user->isGuest) {
                        $this->redirect(['/site/index']);
                        return false;
                }
                return true;
        }
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
	 * Lists all AdminPosts models.
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel = new AdminPostsSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			    'searchModel' => $searchModel,
			    'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single AdminPosts model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id) {
		return $this->render('view', [
			    'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new AdminPosts model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new AdminPosts();

		if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
			$model->leave_application = Yii::$app->request->post()['AdminPosts']['leave_application'];
			$model->leave_approval = Yii::$app->request->post()['AdminPosts']['leave_approval'];
			if ($model->validate() && $model->save())
				return $this->redirect(['view', 'id' => $model->id]);
		}
		return $this->render('create', [
			    'model' => $model,
		]);
	}

	/**
	 * Updates an existing AdminPosts model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id) {
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->validate() && $model->save()) {

			$model->leave_application = Yii::$app->request->post()['AdminPosts']['leave_application'];
			$model->leave_approval = Yii::$app->request->post()['AdminPosts']['leave_approval'];
			$model->update();
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('update', [
				    'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing AdminPosts model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id) {
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	/**
	 * Finds the AdminPosts model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return AdminPosts the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = AdminPosts::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

}
