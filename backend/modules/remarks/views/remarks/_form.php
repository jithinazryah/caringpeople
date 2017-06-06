<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\RemarksWidget;
use yii\grid\GridView;
use common\models\RemarksCategory;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Remarks */
/* @var $form yii\widgets\ActiveForm */
?>
<?php if ($model->isNewRecord) { ?> <a class="btn btn-blue btn-icon btn-icon-standalone add_remarks" style="margin-bottom:25px;"><i class="fa-plus"></i><span> Add Remarks</span></a><?php } ?>

<div class="remarks-form form-inline remarks" >
        <!------------------------------------------------------------------------------------Add Remarks---------------------------------------------------------------------->

        <?php $form = ActiveForm::begin(); ?>
        <?= RemarksWidget::widget(['type_id' => $type_id, 'type' => $type, 'model' => $model, 'form' => $form]); ?>

        <div class='col-md-4 col-sm-6 col-xs-12' >
                <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                </div>
        </div>

        <?php ActiveForm::end(); ?>

</div>
<!------------------------------------------------------------------------------------Add Remarks---------------------------------------------------------------------->


<div style="clear: both"></div>
<!------------------------------------------------------------------------------------Remarks View---------------------------------------------------------------------->
<div class="row">
        <?php if ($model->isNewRecord && $dataProvider != '' && $dataProvider->getTotalCount() > 0) { ?>
                <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                            'attribute' => 'category',
                            'value' => 'category0.category',
                            'filter' => ArrayHelper::map(RemarksCategory::find()->where(['status' => '1'])->asArray()->all(), 'id', 'category'),
                        ],
                        'sub_category',
                        'notes:ntext',
                            ['class' => 'yii\grid\ActionColumn',
                            'template' => '{update}'],
                    ],
                ]);
                ?>
        <?php } ?>
</div>
<!------------------------------------------------------------------------------------Remarks View---------------------------------------------------------------------->


<?php
if ($dataProvider != '' && $dataProvider->getTotalCount() > 0) {
        ?>
        <script>
                $(document).ready(function () {
                        $('.remarks').hide();

                });
        </script>
<?php } ?>

<script>
        $(document).ready(function () {

                $('.add_remarks').click(function () {
                        $('.remarks').slideToggle();
                });
        });
</script>