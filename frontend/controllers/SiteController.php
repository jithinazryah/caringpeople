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
class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
//            'error' => [
//                'class' => 'yii\web\ErrorAction',
//            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {

        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     * Accept contact message from user and send mail to administrator
     *
     * @return mixed
     */
    public function actionContact() {
        if (isset($_POST['contact-send'])) {
            $model = new ContactUs();
            $model->first_name = $fname = $_POST['first-name'];
            $model->last_name = $lname = $_POST['last-name'];
            $model->email = $email = $_POST['email'];
            $model->phone = $phone = $_POST['phone'];
            $model->message = $message = $_POST['message'];
            $model->date = date('Y-m-d');
            if ($model->save()) {
                $this->sendContactMail($model);
                $this->sendResponseMail($model);
            }
        }
        return $this->render('contact');
    }

    /**
     * Accept messages from contact page in footer.
     * send mail to the administrator
     *
     * @return mixed
     */
    public function actionContactform() {
        if (isset($_POST['contact-sends'])) {

            $model = new ContactUs();
            $model->first_name = $fname = $_POST['first-name'];
            $model->email = $email = $_POST['email'];
            $model->message = $message = $_POST['message'];
            $model->date = date('Y-m-d');
            if ($model->save()) {
                $this->sendContactMail($model);
                $this->sendResponseMail($model);
            }
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

     public function actionContacts() {
        if (isset($_POST['contact-send'])) {
            
            $model = new ContactUs();
            $model->first_name = $fname = $_POST['first-name'];
            
            $model->email = $email = $_POST['email'];
            $model->phone = $email = $_POST['phone'];
            $model->message = $message = $_POST['message'];
            $model->location = $location = $_POST['Location'];
            $model->Service = $_POST['services'];
                
            
            if ($_POST['allow_contact'] == 'on') {
                $model->allow_contact = 1;
            } else {
                $model->allow_contact = 0;
            }
            $model->date = date('Y-m-d');
            if ($model->save()) {
                
                $this->sendContactMail($model);
                $this->sendResponseMail($model);
            }
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Response Mail function
     *
     * @return mixed
     */
    public function sendResponseMail($model) {
        $path = 'http://' . Yii::$app->request->serverName . '/images/caring_peopl.jpg';
        // echo $path;exit;
        $message = Yii::$app->mailer->compose('response-mail') // a view rendering result becomes the message body here
                ->setFrom('info@caringpeople.in')
                ->setTo($model->email)
                ->setSubject('Welcome to Caringpeople');
        $message->attach($path);
        $message->send();
        return TRUE;
    }

    /**
     * Mail function
     * Send  contact messages from user to the administrator
     *
     * @return mixed
     */
    public function sendContactMail($model) {
        if ($model->allow_contact == 1) {
            $allow_contact = 'Yes';
        } else {
            $allow_contact = 'No';
        }

        $to = 'info@caringpeople.in,shintomaradikunnel@gmail.com';
     //   $to = 'surumiabin@gmail.com,manuko27@gmail.com';
// subject
        $subject = 'Enquiry From Website';

// message
        $message = "
<html>
<head>

</head>
<body>
<p><b>Enquiry Received From Website</b></p>
<table>
<tr>
<th>Firstname</th>
<th>:-</th>

<td>" . $model->first_name . "</td>
    </tr>

    <tr>
<tr>
<th>Lastname</th>
<th>:-</th>

<td>" . $model->last_name . "</td>
    </tr>

<tr>
<th>Services</th>
<th>:-</th>

<td>" . $model->Service . "</td>
    </tr>

    <tr>

<th>Email</th>
<th>:-</th>
<td>" . $model->email . "</td>
         </tr>
    <tr>

<th>Phone Number</th>
<th>:-</th>
<td>" . $model->phone . "</td>
         </tr>
         <tr>

<th>Location</th>
<th>:-</th>
<td>" . $model->location . "</td>
         </tr>
                 <tr>

<th>Message</th>
<th>:-</th>
<td>" . $model->message . "</td>

</tr>
<tr>
<th>Allow Contact</th>
<th>:-</th>
<td>" . $allow_contact . "</td>

</tr>


</table>
</body>
</html>
";

// To send HTML mail, the Content-type header must be set
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n" .
                "From: 'no-reply@caringpeople.com";
        mail($to, $subject, $message, $headers);


        return true;
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout() {
        return $this->render('about');
    }

    /**
     * Displays testimonial page.
     *
     * @return mixed
     */
    public function actionTestimonial() {
        return $this->render('testimonial');
    }

    /**
     * Displays feedback page.
     *
     * @return mixed
     */
    public function actionFeedback() {
        return $this->render('feedback');
    }

    /**
     * Displays gallery page.
     *
     * @return mixed
     */
    public function actionGallery() {
        return $this->render('gallery');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup() {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
                    'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset() {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
                    'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }

    public function actionError() {

        return $this->render('error');
    }

}
