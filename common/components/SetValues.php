<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SetValues
 *
 * @author user
 */

namespace common\components;

use Yii;
use yii\base\Component;
use yii\helpers\ArrayHelper;
use common\models\MasterHistoryType;
use common\models\History;
use common\models\Service;
use common\models\NotificationViewStatus;
use common\models\StaffInfo;
use common\models\PatientGeneral;
use common\models\Remarks;
use common\models\ServiceSchedule;
use common\models\Followups;
use common\models\PatientEnquiryGeneralFirst;
use common\models\StaffEnquiry;

class SetValues extends Component {

	public function Attributes($model) {

		if (isset($model) && !Yii::$app->user->isGuest) {
			if ($model->isNewRecord) {
				$model->CB = Yii::$app->user->identity->id;
				$model->DOC = date('Y-m-d');
			} else {
				$model->UB = Yii::$app->user->identity->id;
			}



			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function currentBranch($model) {
		if ($model->isNewRecord) {
			$model->branch_id = Yii::$app->user->identity->branch_id;
		}
		return true;
	}

	public function Selected($value) {
		$options = array();
		if (is_array($value)) {
			$array = $value;
		} else {
			$array = explode(',', $value);
		}

		foreach ($array as $valuee):
			$options[$valuee] = ['selected' => true];
		endforeach;
		return $options;
	}

	public function ChangeFormate($date) {
		if ($date == Null || $date == '0000-00-00 00:00:00') {
			return '(Not Set)';
		} else {
			return date("d-M-Y h:i:s", strtotime($date));
		}
	}

	public function DateFormate($date) {
		$old = strtotime('1999-01-01 00:00:00');
		if ($date == Null || $date == '0000-00-00 00:00:00') {
			return;
		} else {
			$f = 'd-M-Y' . (date('H:i:s', strtotime($date)) != '00:00:00' ? ' H:i' : '');
			return str_replace(' 00:00:00', '', date($f, strtotime($date)));
		}
	}

	public function NumberFormat($grandtotal) {
		$s = explode('.', $grandtotal);
		$amount = $s[0];
		$decimal = $s[1];
		if ($amount != '') {
			$total = $english_format_number = number_format($amount);
			if ($decimal != 0) {
				$grandtotal = $total . '.' . $decimal;
			} else {
				$grandtotal = $total . '.00';
			}
			return $grandtotal;
		} else {
			return;
		}
	}

	public function ServiceHistory($service, $master_history_type, $schedule_days = null, $schedule_id = null, $old_staff = null) {

		$master_history_type_model = MasterHistoryType::findOne($master_history_type);
		if ($master_history_type == 5 || $master_history_type == 6 || $master_history_type == 7 || $master_history_type == 8) {
			$followup_data = Followups::find()->where(['id' => $service->id])->one();
			if ($master_history_type == 6) {
				$service_data = PatientGeneral::find()->where(['id' => $followup_data->type_id])->one();
			} elseif ($master_history_type == 7) {
				$service_data = PatientEnquiryGeneralFirst::find()->where(['id' => $followup_data->type_id])->one();
			} elseif ($master_history_type == 8) {
				$service_data = StaffEnquiry::find()->where(['id' => $followup_data->type_id])->one();
			} elseif ($master_history_type == 9) {
				$service_data = StaffInfo::find()->where(['id' => $followup_data->type_id])->one();
			} else {
				$service_data = Service::find()->where(['id' => $followup_data->type_id])->one();
			}
		} else {
			$service_data = Service::find()->where(['id' => $service])->one();
		}
		$model = new History();
		$model->reference_id = $service->id;
		$model->history_type = $master_history_type;
		if ($master_history_type == 1)
			$model->content = $master_history_type_model->content . ' for patient ' . $service_data->patient->first_name;
		elseif (!empty($schedule_days)) {
			$model->content = $schedule_days . ' more ' . $master_history_type_model->content . ' ' . $service_data->service_id;
		} elseif (!empty($schedule_id)) {
			$content = $this->StaffChangeContent($master_history_type_model, $schedule_id, $old_staff);
			$model->content = $content . ' for ' . $service_data->service_id;
		} elseif ($master_history_type == 6) {
			$model->content = $master_history_type_model->content . ' ' . $service_data->patient_id;
		} elseif ($master_history_type == 7) {
			$model->content = $master_history_type_model->content . ' ' . $service_data->enquiry_number;
		} elseif ($master_history_type == 8) {
			$model->content = $master_history_type_model->content . ' ' . $service_data->enquiry_id;
		} elseif ($master_history_type == 9) {
			$model->content = $master_history_type_model->content . ' ' . $service_data->staff_id;
		} else {
			$model->content = $master_history_type_model->content . ' ' . $service_data->service_id;
		}
		$model->date = $service->DOU;

		if ($model->save())
			return $model->id;
		else
			return FALSE;
	}

	public function Notifications($history_id, $service_id, $datas, $notification_type_id, $staff = null, $old_staff = null) {

		$history_model = History::find()->where(['id' => $history_id])->one();
		if ($notification_type_id == 1) {
			$service_model = Service::find()->where(['id' => $service_id])->one();
		} else {
			$followup_model = Followups::find()->where(['id' => $service_id])->one();
			if ($history_model->history_type == 6) {
				$service_model = PatientGeneral::find()->where(['id' => $followup_model->type_id])->one();
			} elseif ($history_model->history_type == 7) {
				$service_model = PatientEnquiryGeneralFirst::find()->where(['id' => $followup_model->type_id])->one();
			} elseif ($history_model->history_type == 8) {
				$service_model = StaffEnquiry::find()->where(['id' => $followup_model->type_id])->one();
			} elseif ($history_model->history_type == 9) {
				$service_model = StaffInfo::find()->where(['id' => $followup_model->type_id])->one();
			} else {
				$service_model = Service::find()->where(['id' => $followup_model->type_id])->one();
			}
		}


		$superadmins = StaffInfo::find()->where(['branch_id' => $service_model->branch_id, 'status' => 1, 'post_id' => 1])->orWhere(['branch_id' => 0])->all();


		if (!empty($superadmins)) {
			foreach ($superadmins as $superadmin) {
				$model = new NotificationViewStatus();
				$model->reference_id = $service_id;
				$model->history_id = $history_id;
				$model->notifiaction_type_id = $notification_type_id;
				$model->staff_type = 1;
				$model->staff_id_ = $superadmin->id;
				$model->content = $history_model->content;
				$model->date = date('Y-m-d');
				$model->view_status = 0;
				$model->save();
				//$this->AddDataToNotification($service_id, $history_id, $notification_type_id, 4, $superadmin->id, $history_model, $service_model); /* 4=>superadmin */
			}
		}
		if ($notification_type_id == 1) {
			$exist_notification = NotificationViewStatus::find()->where(['staff_id_' => $datas->staff_manager, 'history_id' => $history_id])->one();
			if (!empty($datas->staff_manager) && empty($exist_notification)) {
				$this->AddDataToNotification($service_id, $history_id, $notification_type_id, 6, $datas->staff_manager, $history_model, $service_model); /* 6=>staff_manager */
			}
		} elseif (($notification_type_id == 2) && ($history_model->history_type == 5)) {
			$exist_notification = NotificationViewStatus::find()->where(['staff_id_' => $service_model->staff_manager, 'history_id' => $history_id])->one();
			if (!empty($service_model->staff_manager) && empty($exist_notification)) {
				$this->AddDataToNotification($service_id, $history_id, $notification_type_id, 6, $service_model->staff_manager, $history_model, $service_model); /* 6=>staff_manager */
			}
		}
		if (!empty($staff)) {
			$exist_notification = NotificationViewStatus::find()->where(['staff_id_' => $staff, 'history_id' => $history_id])->one();
			if (empty($exist_notification))
				$this->AddDataToNotification($service_id, $history_id, $notification_type_id, 5, $staff, $history_model, $service_model); /* 5=>staff */
			if (!empty($old_staff)) {

				$this->AddDataToNotification($service_id, $history_id, $notification_type_id, 5, $old_staff, $history_model, $service_model); /* 5=>staff */
			}
		}



//		if (!empty($result)) {
//
//		$result->save();
//
//		return TRUE;
//		} else {
//			return FALSE;
//		}
	}

	public function AddDataToNotification($service_id, $history_id, $notification_type_id, $staff_type, $staff_id, $history_model, $service_model) {
		$model = new NotificationViewStatus();
		$model->reference_id = $service_id;
		$model->history_id = $history_id;
		$model->notifiaction_type_id = $notification_type_id;
		$model->staff_type = $staff_type;
		$model->staff_id_ = $staff_id;
		$model->content = $history_model->content;
		$model->date = date('Y-m-d', strtotime($service_model->DOU));
		$model->view_status = 0;
		$model->save();
	}

	public function StaffChangeContent($master_history_type_model, $schedule_id, $oldstaff) {
		$schedule_data = ServiceSchedule::find()->where(['id' => $schedule_id])->one();
		$new_staff_info = StaffInfo::find()->where(['id' => $schedule_data->staff])->one();
		$old_staff_info = StaffInfo::find()->where(['id' => $oldstaff])->one();
		$content = $master_history_type_model->content . ' from ' . $old_staff_info->staff_id . ' to' . $new_staff_info->staff_id;
		return $content;
	}

	/*
	 * Rating calculation based on remarks
	 */

	public function Rating($id, $type) {

		$schedule_remarks = 0;
		$schedule_remarks_count = 0;

		if ($type == '2') {

			$person = \common\models\PatientGeneral::findOne($id);
		} else {

			$person = \common\models\StaffInfo::findOne($id);
			$schedule_remarks = ServiceSchedule::find()->where(['staff' => $id])->sum('rating');
			$schedule_remarks_count = ServiceSchedule::find()->where(['staff' => $id])->andWhere(['not', ['rating' => null]])->count();
		}

		$remarks_point = Remarks::find()->where(['type_id' => $id])->sum('point');
		$remarks_count = Remarks::find()->where(['type_id' => $id])->count();
		$total_remarks_point = $schedule_remarks + $remarks_point;
		$total_remarks = $schedule_remarks_count + $remarks_count;
		$rating = $total_remarks_point / $total_remarks * 100;

		$person->average_point = $rating;
		$person->update(FALSE);
	}

	public function Rating1($id, $type) {

		$remarks = \common\models\Remarks::find()->where(['type_id' => $id])->andWhere(['not', ['remark_type' => null]])->all();
		$count = count($remarks);
		$good_count = 0;
		$bad_count = 0;
		foreach ($remarks as $value) {

			if ($value->remark_type == '1') {
				$good_count = $good_count + 1;
			} else if ($value->remark_type == '0') {
				$bad_count = $bad_count + 1;
			}
		}
		$remark_notes = 'Remarks :' . count($remarks) . ' Good Remarks: ' . $good_count . ' Bad Remarks: ' . $bad_count;
		$rating = $good_count * 100 / $count;
		$ratings = round($rating);
		if ($type == '1') {
			$patient = PatientGeneral::findOne($id);
			$patient->count_of_remarks = $remark_notes;
			$patient->average_point = $ratings;
			$patient->update(false);
		} else if ($type == '2') {
			$staff = StaffInfo::findOne($id);
			$staff->count_of_remarks = $remark_notes;
			$staff->average_point = $ratings;
			$staff->update(false);
		}
	}

	/*
	 * staff availabiltity
	 */

	public function StaffAvailabilty($model, $before_updtate = null) {

		if ($model->day_staff != '' && $model->status == 1) { /* when add daystaff and the service status is opened */
			$staff = StaffInfo::findOne($model->day_staff);
			$staff->status = 3;
			$staff->update();
		}
		if ($model->night_staff != '' && $model->status == 1) { /* when add nightstaff and the service status is opened */
			$staff = StaffInfo::findOne($model->night_staff);
			$staff->status = 3;
			$staff->update();
		}

		/*
		 * for update case
		 */
		if (isset($before_updtate)) {
			if ($model->status == 2) { /** when that service is closed * */
				$day_staff = StaffInfo::findOne($before_updtate->day_staff);
				$day_staff->status = 1;
				$day_staff->update();

				$night_staff = StaffInfo::findOne($model->night_staff);
				$night_staff->status = 1;
				$night_staff->update();
			}
			if ($model->day_staff != $before_updtate->day_staff) { /** when changing the day staff * */
				$day_staff = StaffInfo::findOne($before_updtate->day_staff);
				$day_staff->status = 1;
				$day_staff->update();
			}

			if ($model->night_staff != $before_updtate->night_staff) { /** when changing the night staff * */
				$night_staff = StaffInfo::findOne($before_updtate->night_staff);
				$night_staff->status = 1;
				$night_staff->update();
			}
		}
	}

	/*
	 * Service form duty type options
	 */

	public function Dutytype($model) {

		$option1 = [];
		$option2 = [];
		$option3 = [];
		$option4 = [];
		$option5 = [];
		if (isset($model->rate_per_hour) && $model->rate_per_hour != '') {
			$option1 = ['1' => 'Hourly'];
		} if (isset($model->rate_per_visit) && $model->rate_per_visit != '') {
			$option2 = ['2' => 'Visit'];
		}if (isset($model->rate_per_day) && $model->rate_per_day != '') {
			$option3 = ['3' => 'Day'];
		} if (isset($model->rate_per_night) && $model->rate_per_night != '') {
			$option4 = ['4' => 'Night'];
		} if (isset($model->rate_per_day_night) && $model->rate_per_day_night != '') {
			$option5 = ['5' => 'Day & Night'];
		}

		return $option1 + $option2 + $option3 + $option4 + $option5;
	}

	public function Experience() {
		$exp = [];
		$exp['5'] = '0-5 yrs';
		$exp['10'] = '5-10 yrs';
		$exp['15'] = '10-15 yrs';


		return $exp;
	}

	public function CalculateAvg($item_id) {

		$in_stocks = \common\models\StockRegister::find()->where(['item_id' => $item_id])->all();
		$qty_tot = 0;
		$price_tot = 0;
		foreach ($in_stocks as $stock) {
			$qty_tot += $stock->balance_qty;
			$amount = $stock->balance_qty * $stock->item_cost;
			$price_tot += $amount;
		}
		$avg_price = $price_tot / $qty_tot;
		$item_data = \common\models\ItemMaster::findOne(['id' => $item_id]);
		$item_data->item_cost = $avg_price;
		$item_data->save();
		return $avg_price;
	}

	public function StockDeduction($item_id, $qty) {
		$stocks = \common\models\StockRegister::find()->where(['item_id' => $item_id])->andWhere(['>', 'balance_qty', 0])->all();
		$k = $qty;
		foreach ($stocks as $stock) {
			$existing_stock = \common\models\StockRegister::findOne(['id' => $stock->id]);
			if ($k <= $existing_stock->balance_qty) {
				$existing_stock->balance_qty = $existing_stock->balance_qty - $k;
				$existing_stock->save();
				break;
			} else {
				$existing_stock->balance_qty = 0;
				$existing_stock->save();
				$k = $k - $existing_stock->balance_qty;
				continue;
			}
		}
		return;
	}

}
