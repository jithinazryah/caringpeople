<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EnquirySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Staffs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enquiry-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                                </div>

				<?= Html::a('<i class="fa-th-list"></i><span> Manage Staff</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone', 'style' => 'margin-top:10px;']) ?>
				<?php if (!$model->isNewRecord) { ?>
					<a href="javascript:;" id="4_<?= $model->id; ?>"  class="btn btn-primary btn-single btn-sm Addfollowup" style="height: 36px;padding: 8px;">Add Followups</a>
				<?php } ?>
				<?=
				$this->render('_menus', [
				    'model' => $model,
				])
				?>
                                <div class="panel-body panel_body_background" >
					<?php $form = ActiveForm::begin(); ?>
                                        <div class="tab-content tab_data_margin" >

                                                <div class="tab-pane active" id="home-3">
							<?php if (Yii::$app->session->hasFlash('error')): ?>
								<div class="alert alert-danger" role="alert">
									<?= Yii::$app->session->getFlash('error') ?>
								</div>
							<?php endif; ?>
							<?php if (Yii::$app->session->hasFlash('success')): ?>
								<div class="alert alert-success" role="alert">
									<?= Yii::$app->session->getFlash('success') ?>
								</div>
							<?php endif; ?>
							<?=
							$this->render('_form', [
							    'model' => $model,
							    'staff_edu' => $staff_edu,
							    'staff_uploads' => $staff_uploads,
							    'form' => $form,
							])
							?>

                                                </div>
                                                <div class="tab-pane" id="profile-3">

							<?=
							$this->render('_other_info_form', [
							    'model' => $other_info,
							    'staff_previous_employer' => $staff_previous_employer,
							    'form' => $form,
							])
							?>
                                                </div>





                                        </div>
                                        <div class='col-md-12 col-sm-6 col-xs-12' >
                                                <div class="form-group" >
							<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;', 'id' => 'form_button']) ?>

                                                </div>
                                        </div>



					<?php ActiveForm::end(); ?>




                                </div>
                        </div>
                </div>
        </div>
</div>

<script>
	$('#form_button').click(function (e) { // using click function
		// on contact form submit button
		e.preventDefault();  // stop form from submitting right away

		var error = false;

		$(this).find('.required').each(function () {
			if ($(this).val().length < 1) {
				error = true;
			}
		});
		if (error == false) {

			var Id = $('.tab-pane.active').attr('id');
			$('#'.Id).removeClass('active');
			$('#home-3').addClass('active');  // you submit form
			$("#w0").submit();
		}
		if (!error) {
			return true;
		}

	});


</script>


