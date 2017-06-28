<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\RemarksCategory;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

if ($type == 3) {
        $remark_type = 2;
} else if ($type == 2) {
        $remark_type = 1;
} else if ($type == 4) {
        $remark_type = 2;
} else {
        $remark_type = $type;
}

$model_category = ArrayHelper::map(RemarksCategory::find()->where(['type' => $remark_type, 'status' => 1])->all(), 'id', 'category');
?>

<?php $form_remark = ActiveForm::begin(['id' => 'add-remarks']); ?>

<div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form_remark->field($remark, 'category')->dropDownList($model_category, ['prompt' => '--Select--', 'class' => 'form-control']) ?>

</div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form_remark->field($remark, 'sub_category')->textInput(['maxlength' => true]) ?>

</div><div class='col-md-1 col-sm-6 col-xs-12 left_padd' style="display: none">  <?php echo $form_remark->field($remark, 'type')->hiddenInput(['value' => $type])->label(false); ?>

</div><div class='col-md-1 col-sm-6 col-xs-12 left_padd' style="display: none">  <?php echo $form_remark->field($remark, 'type_id')->hiddenInput(['value' => $type_id])->label(false); ?>

</div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
        <fieldset class="rating">
                <legend class="control-label">Rating:</legend>
                <input type="radio" id="star9" name="rating" value="9" onclick="postToController();"/><label for="star9" title="Excellent">9 stars</label>
                <input type="radio" id="star8" name="rating" value="8" onclick="postToController();"/><label for="star8" title="Very Good">8 stars</label>
                <input type="radio" id="star7" name="rating" value="7" onclick="postToController();"/><label for="star7" title="Very Good">7 stars</label>
                <input type="radio" id="star6" name="rating" value="6" onclick="postToController();"/><label for="star6" title="Good">6 stars</label>
                <input type="radio" id="star5" name="rating" value="5" onclick="postToController();"/><label for="star5" title="Average">5 stars</label>
                <input type="radio" id="star4" name="rating" value="4" onclick="postToController();"/><label for="star4" title="Bad">4 stars</label>
                <input type="radio" id="star3" name="rating" value="3" onclick="postToController();"/><label for="star3" title="Meh">3 stars</label>
                <input type="radio" id="star2" name="rating" value="2" onclick="postToController();"/><label for="star2" title="Kinda bad">2 stars</label>
                <input type="radio" id="star1" name="rating" value="1" onclick="postToController();"/><label for="star1" title="Sucks big time">1 star</label>
        </fieldset>

        <?php echo $form_remark->field($remark, 'point')->hiddenInput(['value' => $type, 'id' => 'rating'])->label(false); ?>

</div><div class='col-md-12 col-sm-6 col-xs-12 left_padd'>    <?= $form_remark->field($remark, 'notes')->textarea(['rows' => 1]) ?>

</div>


<div class='col-md-12 col-sm-6 col-xs-12' >
        <div class="form-group" >
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Create', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>

        </div>
</div>
<?php ActiveForm::end(); ?>
<div class="row remarks-table">

        <?php
        Pjax::begin([
            'enablePushState' => false
        ]);
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'rowOptions' => function ($model, $key, $index, $grid) {
                    return ['id' => $model['id']];
            },
            'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                    'attribute' => 'category',
                    'value' => 'category0.category',
                    'filter' => ArrayHelper::map(RemarksCategory::find()->where(['status' => '1'])->asArray()->all(), 'id', 'category'),
                ],
                'sub_category',
                'point',
                'notes:ntext',
                    [
                    'attribute' => 'status',
                    'value' => function($model, $key, $index, $column) {
                            if ($model->status == '2') {
                                    return 'Closed';
                            } elseif ($model->status == '1') {
                                    return 'Active';
                            }
                    },
                    'filter' => [2 => 'Closed', 1 => 'Active'],
                ],
                    [
                    'class' => 'yii\grid\CheckboxColumn', 'checkboxOptions' => function($model) {
                            if ($model->status != '0')
                                    return ['id' => $model->id, 'class' => 'iswitch iswitch-secondary remarks-status'];
                    },
                    'header' => 'Change Status',
                ],
            ],
        ]);
        Pjax::end();
        ?>

</div>


<style>
        .summary{
                display: none;
        }
        legend{
                border: none;
                font-size: 15px;
                margin-left: 7px;
                color: #777777;
                font-weight: bold;
        }
</style>



