<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\BusinessPartner;

/**
 * BusinessPartnerSearch represents the model behind the search form about `common\models\BusinessPartner`.
 */
class BusinessPartnerSearch extends BusinessPartner {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'type', 'status', 'CB', 'UB'], 'integer'],
            [['name', 'email', 'DOC', 'DOU', 'city', 'phone', 'business_partner_code'], 'safe'],
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
        $query = BusinessPartner::find()->where(['>', 'id', 2]);

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
            'type' => $this->type,
            'phone' => $this->phone,
            'city' => $this->city,
            'status' => $this->status,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }

}
