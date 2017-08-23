<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use common\models\ContactUs;

/**
 * Site controller
 */
class AjaxController extends \yii\web\Controller {

        public function actionIndex() {

                return $this->render('index');
        }

        public function actionSignup() {
                if (Yii::$app->request->isAjax) {
                        die('hii');
                }
        }

}
