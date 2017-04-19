<?php

namespace backend\modules\enquiry\controllers;

use yii\web\Controller;

/**
 * Default controller for the `enquiry` module
 */
class DefaultController extends Controller {

	/**
	 * Renders the index view for the module
	 * @return string
	 */
	public function actionIndex() {
		return $this->redirect(['enquiry/index']);
	}

}
