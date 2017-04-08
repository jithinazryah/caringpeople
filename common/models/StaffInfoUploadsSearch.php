<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\StaffInfoUploads;

/**
 * StaffInfoUploadsSearch represents the model behind the search form about `common\models\StaffInfoUploads`.
 */
class StaffInfoUploadsSearch extends StaffInfoUploads
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'staff_id'], 'integer'],
            [['profile_image_type', 'biodata', 'sslc', 'hse', 'KNC', 'INC', 'marklist', 'experience', 'id_proof', 'PCC', 'authorised_letter'], 'safe'],
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
        $query = StaffInfoUploads::find();

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
        ]);

        $query->andFilterWhere(['like', 'profile_image_type', $this->profile_image_type])
            ->andFilterWhere(['like', 'biodata', $this->biodata])
            ->andFilterWhere(['like', 'sslc', $this->sslc])
            ->andFilterWhere(['like', 'hse', $this->hse])
            ->andFilterWhere(['like', 'KNC', $this->KNC])
            ->andFilterWhere(['like', 'INC', $this->INC])
            ->andFilterWhere(['like', 'marklist', $this->marklist])
            ->andFilterWhere(['like', 'experience', $this->experience])
            ->andFilterWhere(['like', 'id_proof', $this->id_proof])
            ->andFilterWhere(['like', 'PCC', $this->PCC])
            ->andFilterWhere(['like', 'authorised_letter', $this->authorised_letter]);

        return $dataProvider;
    }
}
