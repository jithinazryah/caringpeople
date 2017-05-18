<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Service;

/**
 * ServiceSearch represents the model behind the search form about `common\models\Service`.
 */
class ServiceSearch extends Service {

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['id', 'patient_id', 'service', 'staff_type', 'staff_id', 'staff_manager', 'status', 'branch_id', 'CB', 'UB', 'day_staff'], 'integer'],
			[['from_date', 'to_date', 'estimated_price_per_day', 'estimated_price', 'service_id', 'DOC', 'DOU', 'day_staff', 'duty_type'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function scenarios() {
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}

	/**
	 * Creates data provider instance with search query applied
	 *
	 * @param array $params
	 *
	 * @return ActiveDataProvider
	 */
	public function search($params) {
		$query = Service::find();

		// add conditions that should always apply here

		$dataProvider = new ActiveDataProvider([
		    'query' => $query,
		]);

		$this->load($params);

		if (!$this->validate()) {
			// uncomment the following line if you do not want to return any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}

		// grid filtering conditions
		$query->andFilterWhere([
		    'id' => $this->id,
		    'patient_id' => $this->patient_id,
		    'service' => $this->service,
		    'staff_type' => $this->staff_type,
		    'staff_id' => $this->staff_id,
		    //'day_staff' => $this->day_staff,
		    'duty_type' => $this->duty_type,
		    'staff_manager' => $this->staff_manager,
		    'from_date' => $this->from_date,
		    'to_date' => $this->to_date,
		    'branch_id' => $this->branch_id,
		    'status' => $this->status,
		    'CB' => $this->CB,
		    'UB' => $this->UB,
		    'DOC' => $this->DOC,
		    'DOU' => $this->DOU,
		]);

		$query->andFilterWhere(['like', 'estimated_price_per_day', $this->estimated_price_per_day])
			->andFilterWhere(['like', 'estimated_price', $this->estimated_price])
			->andFilterWhere(['like', 'day_staff', $this->day_staff])
			->andFilterWhere(['like', 'night_staff', $this->night_staff])
			->andFilterWhere(['like', 'service_id', $this->service_id]);
		// ->andFilterWhere(['like', 'advance_payment', $this->advance_payment]);

		return $dataProvider;
	}

}