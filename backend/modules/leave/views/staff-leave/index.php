<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\StaffLeaveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Staff Leave';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
	.ta5 {
		border: 2px solid rgba(64, 187, 234, 0.28);
		border-radius: 10px;
		height: 60px;
		width: 230px;
		margin-left: 154px;
	}
	textarea::placeholder {
		padding: 5px 0px 0px 5px;
	}
	textarea{
		padding: 5px 0px 0px 5px;
	}
</style>
<div class="staff-leave-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
					<?php
					if (!empty($pending_leave)) {
						foreach ($pending_leave as $value) {
							?>

							<div class = "col-sm-6 col-md-6 <?= $value->id ?>">
								<blockquote class="blockquote blockquote-info">
									<p>
										<span style="float: right;color: #7c38bc;font-size: 12px;">
											Leave Applied By: <?= $value->employee->username; ?>
										</span>
										<br>
										<span style="float: right;color: #7c38bc;font-size: 12px;">
											Applied On: <?= date("j", strtotime($value->commencing_date)) . ' ' . date("F", strtotime($value->commencing_date)) . ' ' . date("Y", strtotime($value->commencing_date)); ?>
										</span>
										<br>
										<span style="float: right">
											<?php if ($value->status == 1) { ?>
												<input type="checkbox" value="<?= $value->id ?>" class="iswitch iswitch-secondary leave_approved " title="Mrak it if this task is closed" style="float:right;"> <?php } ?>
										</span>




									</p>
									<br>


									<p style="font-size: 12px;margin-top: 3px;">
										<span style="float: left">Leave Type: <?= $value->leaveType->type; ?></span>

										<?php if ($value->admin_comment != "") { ?>
											<textarea style="float: right" class="ta5 commnt" placeholder="Comment.........." id="<?= $value->id ?>"><?= $value->admin_comment ?></textarea>
										<?php } else { ?>
											<textarea style="float: right" class="ta5 commnt" placeholder="Comment.........." id="<?= $value->id ?>"></textarea>
										<?php } ?>
									</p>
									<br>
									<p style="text-align:left;font-size: 12px;margin-top: 3px;">
										<span>No Of Days: <?= $value->no_of_days; ?></span>
									</p>
									<p style="text-align:left;font-size: 12px;margin-top: 3px;">
										<span>Commencing Date: <?= $value->commencing_date; ?></span>
									</p>
									<p style="text-align:left;font-size: 12px;margin-top: 3px;">
										<span>End Date: <?= $value->ending_date; ?></span>
									</p>
									<p style="text-align:left;font-size: 12px;margin-top: 3px;">
										<span>Leave Purpose: <?= $value->purpose; ?></span>
									</p>



								</blockquote>
							</div>
							<?php
						}
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function () {
		/*
		 * to approve leave
		 */

		$('.leave_approved').change(function () {
			var leave_id = $(this).val();
			$.ajax({
				type: 'POST',
				cache: false,
				data: {leave_id: leave_id},
				url: homeUrl + 'leave/staff-leave/leave-status',
				success: function (data) {
					$('.' + leave_id).hide(1000);

				}
			});

		});
		$(".commnt").focusout(function () {
			var id = $(this).attr('id');
			var comment = $(this).val();
			$.ajax({
				type: 'POST',
				cache: false,
				data: {leave_id: id, comment: comment},
				url: homeUrl + 'leave/staff-leave/admin-comment',
				success: function (data) {


				}
			});
		});
	});
</script>


