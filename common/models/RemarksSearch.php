<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Remarks;

/**
 * RemarksSearch represents the model behind the search form about `common\models\Remarks`.
 */
class RemarksSearch extends Remarks {

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['id', 'category', 'status', 'CB', 'UB'], 'integer'],
                        [['sub_category', 'notes', 'DOC', 'DOU', 'remark_type', 'point', 'status'], 'safe'],
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
                $query = Remarks::find();

                // add conditions that should always apply here

                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                    'sort' => ['defaultOrder' => ['id' => SORT_DESC,
                        ]]
                ]);

                $this->load($params);

                if (!$this->validate()) {
                        // uncomment the following line if you do not want to return any records when validation fails
                        // $query->where('0=1');
                        return $dataProvider;
                }
                if (!empty(Yii::$app->request->queryParams['RemarksSearch']['status'])) {
                        $dataProvider->query->andWhere(['status' => Yii::$app->request->queryParams['RemarksSearch']['status']]);
                } else {
                        $dataProvider->query->andWhere(['<>', 'status', 0]);
                }

                // grid filtering conditions
                $query->andFilterWhere([
                    'id' => $this->id,
                    'category' => $this->category,
                    'status' => $this->status,
                    'CB' => $this->CB,
                    'UB' => $this->UB,
                    'DOC' => $this->DOC,
                    'DOU' => $this->DOU,
                ]);

                $query->andFilterWhere(['like', 'sub_category', $this->sub_category])
                        ->andFilterWhere(['like', 'remark_type', $this->remark_type])
                        ->andFilterWhere(['like', 'point', $this->point])
                        ->andFilterWhere(['like', 'status', $this->status])
                        ->andFilterWhere(['like', 'notes', $this->notes]);

                return $dataProvider;
        }

}
