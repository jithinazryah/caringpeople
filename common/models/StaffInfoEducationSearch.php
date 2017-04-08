<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\StaffInfoEducation;

/**
 * StaffInfoEducationSearch represents the model behind the search form about `common\models\StaffInfoEducation`.
 */
class StaffInfoEducationSearch extends StaffInfoEducation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sslc_year_of_passing', 'hse_year_of_passing', 'nursing_year_of_passing', 'timing', 'uniform', 'company_id', 'emergency_conatct_verification', 'panchayath_cleraance_verification'], 'integer'],
            [['staff_id', 'sslc_institution', 'sslc_place', 'hse_institution', 'hse_place', 'nursing_institution', 'nursing_place'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
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
    public function search($params)
    {
        $query = StaffInfoEducation::find();

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
            'sslc_year_of_passing' => $this->sslc_year_of_passing,
            'hse_year_of_passing' => $this->hse_year_of_passing,
            'nursing_year_of_passing' => $this->nursing_year_of_passing,
            'timing' => $this->timing,
            'uniform' => $this->uniform,
            'company_id' => $this->company_id,
            'emergency_conatct_verification' => $this->emergency_conatct_verification,
            'panchayath_cleraance_verification' => $this->panchayath_cleraance_verification,
        ]);

        $query->andFilterWhere(['like', 'staff_id', $this->staff_id])
            ->andFilterWhere(['like', 'sslc_institution', $this->sslc_institution])
            ->andFilterWhere(['like', 'sslc_place', $this->sslc_place])
            ->andFilterWhere(['like', 'hse_institution', $this->hse_institution])
            ->andFilterWhere(['like', 'hse_place', $this->hse_place])
            ->andFilterWhere(['like', 'nursing_institution', $this->nursing_institution])
            ->andFilterWhere(['like', 'nursing_place', $this->nursing_place]);

        return $dataProvider;
    }
}
