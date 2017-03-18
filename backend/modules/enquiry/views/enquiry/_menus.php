<?php

use yii\helpers\Html;
?>

<ul class="nav nav-tabs nav-tabs-justified">
	<li class = "<?= ((Yii::$app->controller->id == 'enquiry') && (Yii::$app->controller->action->id == 'new-enquiry')) || ($_GET['id'] != '') ? 'active' : '' ?>">
		<?php if (empty($_GET['id'])) { ?>
			<?= Html::a('<span class="visible-xs"><i class="fa-envelope-o"></i></span>
			<span class="hidden-xs span-font-size">General Information</span>', ['#home-3'], ['class' => '', 'data-toggle' => 'tab']) ?>
		<?php } else { ?>
			<?= Html::a('<span class="visible-xs"><i class="fa-envelope-o"></i></span>
			<span class="hidden-xs span-font-size">General Information</span>', ['#home-3',], ['class' => '', 'data-toggle' => 'tab']) ?>
		<?php } ?>
	</li>

	<li class="<?= !empty($hospital_info) ? 'active' : '' ?>">
		<?php if (empty($hospital_info)) { ?>
			<?= Html::a('<span class="visible-xs"><i class="fa-hospital-o"></i></span>
			<span class="hidden-xs span-font-size">Hospital Information</span>', ['#profile-3'], ['class' => 'btn btn-warning  ', 'data-toggle' => 'tab']) ?>
		<?php } else { ?>
			<?= Html::a('<span class="visible-xs"><i class="fa-hospital-o"></i></span>
			<span class="hidden-xs span-font-size">Hospital Information</span>', ['#profile-3'], ['class' => 'btn btn-warning  ', 'data-toggle' => 'tab']) ?>
		<?php } ?>
	</li>

	<li class="<?= !empty($other_info) ? 'active' : '' ?>">
		<?php if (empty($other_info)) { ?>
			<?= Html::a('<span class="visible-xs"><i class="fa-info-circle"></i></span>
			<span class="hidden-xs span-font-size">Other Information</span>', ['#messages-3'], ['class' => 'btn btn-warning  ', 'data-toggle' => 'tab']) ?>
		<?php } else { ?>
			<?= Html::a('<span class="visible-xs"><i class="fa-info-circle"></i></span>
			<span class="hidden-xs span-font-size">Other Information</span>', ['#messages-3'], ['class' => 'btn btn-warning  ', 'data-toggle' => 'tab']) ?>
		<?php } ?>
	</li>


</ul>

