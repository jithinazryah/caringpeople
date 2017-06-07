<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\ContactCategoryTypes;
use common\models\ContactSubcategory;
use yii\helpers\ArrayHelper;
use common\models\StaffInfo;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ContactDirectorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Followups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-directory-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
                                        <div class="col-md-3" style="float:right">
                                                <ul class="nav navbar-nav views">
                                                        <li class="dropdown">
                                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding: 4px 19px 23px 20px;height: 10px;">View <b class="caret"></b></a>
                                                                <ul class="dropdown-menu menu-views">
                                                                        <li>
                                                                                <a href="<?= Yii::$app->homeUrl; ?>patient/patient-information/view?id=<?= $id; ?>">View Profile</a>
                                                                        </li>
                                                                        <li>
                                                                                <a href="<?= Yii::$app->homeUrl; ?>patient/patient-information/followups?id=<?= $id; ?>">View All Followups</a>
                                                                        </li>

                                                                        <li>
                                                                                <a href="<?= Yii::$app->homeUrl; ?>patient/patient-information/remarks?id=<?= $id; ?>">View All Remarks</a>
                                                                        </li>

                                                                </ul>
                                                        </li>
                                                </ul>
                                        </div>

                                </div>
                                <div class="panel-body">
                                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                                        <?=
                                        GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'filterModel' => $searchModel,
                                            'columns' => [
                                                    ['class' => 'yii\grid\SerialColumn'],
                                                'followup_date',
                                                    [
                                                    'attribute' => 'assigned_to',
                                                    'value' => function($model, $key, $index, $column) {
                                                            if (isset($model->assigned_to)) {
                                                                    $staff_Assigned_to = StaffInfo::findOne($model->assigned_to);
                                                                    return $staff_Assigned_to->staff_name;
                                                            }
                                                    },
                                                ],
                                                    [
                                                    'attribute' => 'assigned_from',
                                                    'value' => function($model, $key, $index, $column) {
                                                            if (isset($model->assigned_from)) {
                                                                    $staff_Assigned_to = StaffInfo::findOne($model->assigned_from);
                                                                    return $staff_Assigned_to->staff_name;
                                                            }
                                                    },
                                                ],
                                                    [
                                                    'attribute' => 'related_staffs',
                                                    'value' => function($model, $key, $index, $column) {
                                                            return $model->relatedstaffs($model->related_staffs);
                                                    },
                                                    'filter' => ArrayHelper::map(common\models\StaffInfo::find()->where(['status' => '1'])->orderBy(['staff_name' => SORT_ASC])->asArray()->all(), 'id', 'staff_name'),
                                                    'filterOptions' => array('id' => "related_staff_search"),
                                                ],
                                                'followup_notes',
                                            ],
                                        ]);
                                        ?>
                                </div>
                        </div>
                </div>
        </div>
</div>


<script>
        $(document).ready(function () {

                $('#related_staff_search select').attr('id', 'related_staff_name');
                $("#related_staff_name").select2({
                        placeholder: '',
                        allowClear: true
                }).on('select2-open', function ()
                {
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });
        });
</script>


