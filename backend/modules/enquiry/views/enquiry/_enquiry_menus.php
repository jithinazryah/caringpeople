<?php

use yii\helpers\Html;
use yii\grid\GridView;
?>

<ul class="nav nav-tabs nav-tabs-justified">

	<li class = "<?= ((Yii::$app->controller->id == 'enquiry') && (Yii::$app->controller->action->id == 'create')) || ($_GET['id'] != '') ? 'active' : '' ?>">
		<?php if (empty($_GET['id'])) { ?>
			<?= Html::a('<span class="visible-xs"><i class="fa-envelope-o"></i></span>
			<span class="hidden-xs span-font-size">General Information</span>', ['enquiry/create'], ['class' => 'btn btn-warning']) ?>
		<?php } else { ?>
			<?= Html::a('<span class="visible-xs"><i class="fa-envelope-o"></i></span>
			<span class="hidden-xs span-font-size">General Information</span>', ['enquiry/update', 'id' => $_GET['id']], ['class' => 'btn btn-warning']) ?>
		<?php } ?>
	</li>

	<li class="<?= !empty($hospital_info) ? 'active' : '' ?>">
		<?php if (empty($hospital_info)) { ?>
			<?= Html::a('<span class="visible-xs"><i class="fa-hospital-o"></i></span>
			<span class="hidden-xs span-font-size">Hospital Information</span>', ['enquiry-hospital/create', 'id' => $_GET['id']], ['class' => 'btn btn-warning  ']) ?>
		<?php } else { ?>
			<?= Html::a('<span class="visible-xs"><i class="fa-hospital-o"></i></span>
			<span class="hidden-xs span-font-size">Hospital Information</span>', ['enquiry-hospital/update', 'id' => $_GET['id']], ['class' => 'btn btn-warning  ']) ?>
		<?php } ?>
	</li>
	<li class="<?= !empty($other_info) ? 'active' : '' ?>">
		<?php if (empty($other_info)) { ?>
			<?= Html::a('<span class="visible-xs"><i class="fa-info-circle"></i></span>
			<span class="hidden-xs span-font-size">Other Information</span>', ['enquiry-other-info/create', 'id' => $_GET['id']], ['class' => 'btn btn-warning  ']) ?>
		<?php } else { ?>
			<?= Html::a('<span class="visible-xs"><i class="fa-info-circle"></i></span>
			<span class="hidden-xs span-font-size">Other Information</span>', ['enquiry-other-info/update', 'id' => $_GET['id']], ['class' => 'btn btn-warning  ']) ?>
		<?php } ?>
	</li>


</ul>



