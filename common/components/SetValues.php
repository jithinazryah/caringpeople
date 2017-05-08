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
use common\models\MasterHistoryType;
use common\models\History;
use common\models\Service;
use common\models\NotificationViewStatus;

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

	public function ServiceHistory($service, $master_history_type) {
		$master_history_type_model = MasterHistoryType::findOne($master_history_type);
		$service_data = Service::find()->where(['id' => $service])->one();
		$model = new History();
		$model->reference_id = $service->id;
		$model->history_type = $master_history_type;
		$model->content = $master_history_type_model->content . ' for patient ' . $service_data->patient->first_name . ' on ' . date('Y-m-d', strtotime($service_data->DOC));
		if ($model->save())
			return $model->id;
		else
			return FALSE;
	}

	public function Notifications($history_id, $service_id, $datas) {

		$history_model = History::find()->where(['id' => $history_id])->one();
		$service_model = Service::find()->where(['id' => $service_id])->one();
		if (!empty($datas)) {
			foreach ($datas as $data) {

				$model = new NotificationViewStatus();
				$model->reference_id = $service_id;
				$model->history_id = $history_id;
				$model->notifiaction_type_id = $data[2];
				$model->staff_type = $data[3];
				$model->staff_id_ = $data[4];
				$model->content = $history_model->content;
				$model->date = date('Y-m-d', strtotime($service_model->DOU));
				$model->view_status = 0;
				$model->save();
			}
			return TRUE;
		} else {
			return FALSE;
		}
	}

}
