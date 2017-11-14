<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Employee;
use common\models\Doctor;
use common\models\PlacePro;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use common\models\DailyReport;
use yii\db\Expression;

$this->title = 'Daily Report';
?>

<section id="login-box">
        <div class="container">
                <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6 shadow">
                                <h3 style="text-align:center;text-decoration: underline;color:#e26c04">Daily Report</h3>
                                <div>
                                        <?php if (Yii::$app->session->hasFlash('daily-errors')): ?>
                                                <div class="alert alert-danger alert-new" role="alert">
                                                        <?= Yii::$app->session->getFlash('daily-errors') ?>
                                                </div>
                                        <?php endif; ?>
                                </div>
                                <div>
                                        <?php if (Yii::$app->session->hasFlash('daily-warning')): ?>
                                                <div class="alert alert-danger alert-new" role="alert">
                                                        <?= Yii::$app->session->getFlash('daily-warning') ?>
                                                </div>
                                                <?php
                                        endif;
                                        ?>
                                </div>


                        </div>
                        <div class="col-md-3"></div>
                </div>
        </div>
</section>
<style>

        .fa-globe:before {
                content: "\f0ac";
                font-size: 20px;
        }


</style>





<script>
        $(document).ready(function () {
                var configParamsObj = {
                        placeholder: '- Select -',
                        minimumResultsForSearch: 3,
                        matcher: function (params, data) {
                                if ($.trim(params.term) === '') {
                                        return data;
                                }
                                if (data.text.toLowerCase().startsWith(params.term.toLowerCase())) {
                                        var modifiedData = $.extend({}, data, true);
                                        modifiedData.text += ' ';
                                        return modifiedData;
                                }
                                return null;
                        }
                };
                $("#dailyreport-doctor_id").select2(configParamsObj);
        });
</script>
