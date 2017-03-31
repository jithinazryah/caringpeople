<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\EnquirySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<html>
        <head>
                <title>Enquiry</title>
        </head>

        <body>
                <div  style="width: 50%;text-align: center;margin:auto;">

                        <div  style="margin-left:26px;">
                                <img src="<?= Yii::$app->homeUrl ?>/images/logos/logo-1.png" style="width:200px">
                                <h2>Enquiry </h2>

                                <p>Hi <?= $model->caller_name; ?>,</p>
                                <p>Thankyou for your enquiry. We will contact you soon.</p>

                        </div>
                </div>
        </body>
</html>