<?php

use yii\helpers\Html;
use yii\grid\GridView;
?>

<ul class="nav nav-tabs nav-tabs-justified">

	<li class="<?= (Yii::$app->controller->id == 'enquiry') || ($_GET['id'] != '') ? 'active' : '' ?>">

		<?php if (empty($enquiry)) { ?>
			<?= Html::a('<span class="visible-xs"><i class="fa-envelope-o"></i></span>
			<span class="hidden-xs span-font-size">General Information</span>', ['enquiry/create'], ['class' => 'btn btn-warning']) ?>
		<?php } else { ?>
			<?= Html::a('<span class="visible-xs"><i class="fa-envelope-o"></i></span>
			<span class="hidden-xs span-font-size">General Information</span>', ['enquiry/update', 'id' => $_GET['id']], ['class' => 'btn btn-warning']) ?>
		<?php } ?>

	</li>

	<li class="<?= (!empty($model) || Yii::$app->controller->id == 'enquiry-hospital') ? 'active' : '' ?>">
		<?php if (empty($model->enquiry_id)) { ?>
			<?= Html::a('<span class="visible-xs"><i class="fa-hospital-o"></i></span>
			<span class="hidden-xs span-font-size">Hospital Information</span>', ['enquiry-hospital/create', 'id' => $_GET['id']], ['class' => 'btn btn-warning  ']) ?>
		<?php } else { ?>
			<?= Html::a('<span class="visible-xs"><i class="fa-hospital-o"></i></span>
			<span class="hidden-xs span-font-size">Hospital Information</span>', ['enquiry-hospital/update', 'id' => $_GET['id']], ['class' => 'btn btn-warning  ']) ?>
		<?php } ?>
	</li>
	<li class="<?= (!empty($other_info) || Yii::$app->controller->id == 'enquiry-other-info') ? 'active' : '' ?>">
		<?php if (empty($other_info)) { ?>
			<?= Html::a('<span class="visible-xs"><i class="fa-info-circle"></i></span>
			<span class="hidden-xs span-font-size">Other Information</span>', ['enquiry-other-info/create', 'id' => $_GET['id']], ['class' => 'btn btn-warning  ']) ?>
		<?php } else { ?>
			<?= Html::a('<span class="visible-xs"><i class="fa-info-circle"></i></span>
			<span class="hidden-xs span-font-size">Other Information</span>', ['enquiry-other-info/update', 'id' => $_GET['id']], ['class' => 'btn btn-warning  ']) ?>
		<?php } ?>
	</li>


</ul>



