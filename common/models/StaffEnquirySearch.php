<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\StaffEnquiry;

/**
 * StaffEnquirySearch represents the model behind the search form about `common\models\StaffEnquiry`.
 */
class StaffEnquirySearch extends StaffEnquiry {

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['id', 'branch_id', 'status', 'CB', 'UB'], 'integer'],
                        [['name', 'phone_number', 'email', 'address', 'follow_up_date', 'notes', 'DOC', 'DOU', 'enquiry_id'], 'safe'],
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

                $query = StaffEnquiry::find();

                // add conditions that should always apply here

                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                    'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
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
                    'branch_id' => $this->branch_id,
                    'follow_up_date' => $this->follow_up_date,
                    'status' => $this->status,
                    'CB' => $this->CB,
                    'UB' => $this->UB,
                    'DOC' => $this->DOC,
                    'DOU' => $this->DOU,
                ]);

                $query->andFilterWhere(['like', 'name', $this->name])
                        ->andFilterWhere(['like', 'phone_number', $this->phone_number])
                        ->andFilterWhere(['like', 'enquiry_id', $this->enquiry_id])
                        ->andFilterWhere(['like', 'email', $this->email])
                        ->andFilterWhere(['like', 'address', $this->address])
                        ->andFilterWhere(['like', 'notes', $this->notes]);


                return $dataProvider;
        }

}
