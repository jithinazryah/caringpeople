<?php

use yii\helpers\Html;
?>

<html>
        <head>
                <title>Forgot Password</title>
                <link href="<?= Yii::$app->homeUrl; ?>css/email.css" rel="stylesheet">
        </head>
        <body>
                <div class="mail-body">
                        <div class="content">
                                <?php echo Html::img('http://' . Yii::$app->request->serverName . '/admin/images/logos/logo-1.png', $options = ['width' => '200px']) ?>
                                <h2>Change Password</h2>

                                <p>Hi <?= $model->staff_name ?>,</p>
                                <p>You are requested to reset your password for your Caring People Admin Panel Login. Click the below button to reset it</p>
                                <p><a href="http://caringpeople.in/admin/site/new-password?token=<?= $val ?>" class="btn btn-success btn-icon">Reset Password</a></p>
                        </div>
                </div>



        </body>
</html>