<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Branch;
use yii\helpers\ArrayHelper;
use common\models\StaffInfoUploads;
use kartik\export\ExportMenu;

//AppsAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel common\models\StaffInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Search Staffs';
$this->params['breadcrumbs'][] = $this->title;
$path = Yii::getAlias(Yii::$app->params['uploadPath']);
$branch = Branch::branch();
$designations = \common\models\MasterDesignations::designationlist();
?>
<div class="staff-info-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">


                                        <?=
                                        GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'filterModel' => $searchModel,
                                            'columns' => [
                                                'staff_id',
                                                'staff_name',
                                                'contact_no',
                                                    [
                                                    'attribute' => 'designation',
                                                    'value' => function($model, $key, $index, $column) {
                                                            return $model->designation($model->designation);
                                                    },
                                                    'filter' => ArrayHelper::map(\common\models\MasterDesignations::designationlist(), 'id', 'title'),
                                                ],
                                                    [
                                                    'attribute' => 'years_of_experience',
                                                    'header' => 'Experience',
                                                ],
                                                    [
                                                    'attribute' => 'staff_experience',
                                                    'value' => function($model, $key, $index, $column) {
                                                            return $model->skills($model->staff_experience);
                                                    },
                                                    'filter' => Html::activeDropDownList($searchModel, 'staff_experience', ArrayHelper::map(\common\models\StaffExperienceList::find()->where(['status' => '1', 'category' => 2])->asArray()->all(), 'id', 'title'), ['class' => 'form-control', 'multiple' => true]),
                                                    'filterOptions' => array('id' => "staff_skills_search"),
                                                ],
                                                'average_point',
                                                    [
                                                    'header' => 'Work Status',
                                                    'attribute' => 'working_status',
                                                    'value' => function($model, $key, $index, $column) {
                                                            if ($model->working_status == '0') {
                                                                    return 'Bench';
                                                            } else if ($model->working_status == '1') {
                                                                    return 'On Duty';
                                                            }
                                                    },
                                                    'filter' => [0 => 'Bench', 1 => 'On Duty'],
                                                ],
                                                    ['class' => 'yii\grid\ActionColumn',
                                                    'template' => '{staff_choose}',
                                                    'buttons' => [
                                                        'staff_choose' => function ($url, $model) {

                                                                return Html::radio('staff_choose', false, ['class' => 'cbr cbr-primary', 'id' => $model->id, 'value' => $model->id]);
                                                        },
                                                    ],
                                                ],
                                            ],
                                        ]);
                                        ?>


                                        <form id="searchChooseStaff">
                                                <input type="hidden" name="service_id" id="service_id" value="<?= $service; ?>"/>
                                                <input type="hidden" name="schedule_id" id="schedule_id" value="<?= $schedule; ?>"/>
                                                <input type="hidden" name="type" id="type" value="<?= $type; ?>"/>
                                                <input type="hidden" name="choosed_staff" id="choosed_staff"/>
                                                <div class="modal-footer result-buttons" >
                                                        <button type="submit" class="btn btn-success waves-effect" >Continue</button>

                                                </div>
                                        </form>

                                </div>
                        </div>
                </div>
        </div>
</div>





<script>
        $(document).ready(function () {
                $('#staff_skills_search select').attr('id', 'skills_search');
                $("#skills_search").select2({
                        placeholder: '',
                        allowClear: true
                }).on('select2-open', function ()
                {
                        // Adding Custom Scrollbar
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });

        });
</script>