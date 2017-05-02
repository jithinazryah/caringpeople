<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ContactDirectorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contact Directories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-directory-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
					<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

					<?= Html::a('<i class="fa-th-list"></i><span> Create Contact Directory</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
					<?=
					GridView::widget([
					    'dataProvider' => $dataProvider,
					    'filterModel' => $searchModel,
					    'columns' => [
						    ['class' => 'yii\grid\SerialColumn'],
						//'id',
						[
						    'attribute' => 'category_type',
						    'value' => 'categoryType.category_name'
						],
						'name',
						'email_1:email',
						//'email_2:email',
						'phone_1',
						// 'phone_2',
						// 'designation',
						// 'company_name',
						// 'references',
						// 'remarks:ntext',
						// 'field_1',
						// 'field_2',
						// 'CB',
						// 'UB',
						// 'DOC',
						// 'DOU',
						['class' => 'yii\grid\ActionColumn'],
					    ],
					]);
					?>
				</div>
                        </div>
                </div>
        </div>
</div>


