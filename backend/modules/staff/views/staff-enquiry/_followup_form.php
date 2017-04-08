<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;
use kartik\datetime\DateTimePicker;
use common\models\AdminUsers;
use yii\helpers\ArrayHelper;
use common\models\Followups;

/* @var $this yii\web\View */
/* @var $followup_info common\models\Followups */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="followups-form form-inline">

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>

                <div class="form-group field-followups-followup_date">
                        <label class="control-label" for="followups-followup_date">Followup Date</label>

                        <?php
                        if (!$model->isNewRecord && isset($followup_id)) {
                                $followup_info->followup_date = date('d-M-Y h:i', strtotime($followup_info->followup_date));
                        } else {
                                $followup_info->followup_date = date('d-M-Y h:i');
                        }
                        echo DateTimePicker::widget([
                            'name' => 'Followups[followup_date]',
                            'type' => DateTimePicker::TYPE_INPUT,
                            'value' => $followup_info->followup_date,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-M-yyyy hh:ii'
                            ]
                        ]);
                        ?>

                </div>

        </div>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                <?php
                $all_users = AdminUsers::find()->where(['post_id' => '5'])->andWhere(['<>', 'id', Yii::$app->user->identity->id])->all();
                ?>
                <?= $form->field($followup_info, 'assigned_to')->dropDownList(ArrayHelper::map($all_users, 'id', 'name'), ['prompt' => '--Select--', 'class' => 'form-control']) ?>

        </div>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>

                <?php
                if (!$followup_info->isNewRecord)
                        $userid = $followup_info->assigned_from;
                else
                        $userid = Yii::$app->user->identity->id;

                $user = AdminUsers::findOne($userid);
                $followup_info->assigned_from = $user->name;
                ?>

                <?= $form->field($followup_info, 'assigned_from')->textInput(['readonly' => true]) ?>

        </div>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>

                <?php echo $form->field($followup_info, 'followup_notes')->textarea(['rows' => 6]) ?>
        </div>

        <?php if (!$followup_info->isNewRecord) {
                ?>
                <div class = 'col-md-4 col-sm-6 col-xs-12 left_padd'> <?= $form->field($followup_info, 'status')->dropDownList(['0' => 'Open', '1' => 'Closed', '2' => 'Void']) ?></div>
                <?php if ($followup_info->status == '3') { ?><div class = 'col-md-4 col-sm-6 col-xs-12 left_padd'><labe style="color: #d5080f;"> * This followup is currently in Pending stage</labe> </div><?php } ?>
        <?php } ?>



</div>


<div style="clear: both"></div>



<?php
$count = Followups::find()->where(['type_id' => $staff_enquiry->id, 'type' => '3'])->count();
if ($count > 0) {
        ?>

        <label style="color: #148eaf;font-size: 20px;">Followups</label>
        <hr class="enquiry-hr">
        <div class="row">
                <?=
                ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_followups',
                    'viewParams' => ['staff_enquiry_id' => $staff_enquiry->id],
                ]);
                ?>

        </div>
<?php } ?>


<style>
        .blockquote.blockquote-red:before{
                background-color: #fff;
        }
        .summary{
                display: none;
        }
</style>

