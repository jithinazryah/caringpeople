<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\StaffPerviousEmployer;

/**
 * StaffPerviousEmployerSearch represents the model behind the search form about `common\models\StaffPerviousEmployer`.
 */
class StaffPerviousEmployerSearch extends StaffPerviousEmployer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'staff_id'], 'integer'],
            [['hospital_address', 'designation', 'length_of_service', 'service_from', 'service_to'], 'safe'],
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
        $query = StaffPerviousEmployer::find();

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
            'staff_id' => $this->staff_id,
            'service_from' => $this->service_from,
            'service_to' => $this->service_to,
        ]);

        $query->andFilterWhere(['like', 'hospital_address', $this->hospital_address])
            ->andFilterWhere(['like', 'designation', $this->designation])
            ->andFilterWhere(['like', 'length_of_service', $this->length_of_service]);

        return $dataProvider;
    }
}
