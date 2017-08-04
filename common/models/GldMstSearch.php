<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\GldMst;

/**
 * GldMstSearch represents the model behind the search form about `common\models\GldMst`.
 */
class GldMstSearch extends GldMst {

    /**
     * @var string
     */
    public $createdFrom;

    /**
     * @var string
     */
    public $createdTo;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'journal_type', 'voucher_type', 'financial_year_id', 'status', 'CB', 'UB'], 'integer'],
            [['document_no', 'document_date', 'financial_year', 'reference', 'DOC', 'DOU'], 'safe'],
            [['credit_amount', 'debit_amount', 'balance_amount'], 'number'],
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
        if (!isset($params["GldMstSearch"]["createdFrom"])) {
            $params["GldMstSearch"]["createdFrom"] = '';
        } else {
            $params["GldMstSearch"]["createdFrom"] = $params["GldMstSearch"]["createdFrom"] . ' 00:00:00';
        }
        if (!isset($params["GldMstSearch"]["createdTo"])) {
            $params["GldMstSearch"]["createdTo"] = '';
        } else {
            $params["GldMstSearch"]["createdTo"] = $params["GldMstSearch"]["createdTo"] . ' 60:60:60';
        }
        $query = GldMst::find()->orderBy(['id' => SORT_DESC]);

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
            'journal_type' => $this->journal_type,
            'voucher_type' => $this->voucher_type,
            'document_date' => $this->document_date,
            'financial_year' => $this->financial_year,
            'financial_year_id' => $this->financial_year_id,
            'credit_amount' => $this->credit_amount,
            'debit_amount' => $this->debit_amount,
            'balance_amount' => $this->balance_amount,
            'status' => $this->status,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
        ]);

        $query->andFilterWhere(['like', 'document_no', $this->document_no])
                ->andFilterWhere(['like', 'reference', $this->reference])
                ->andFilterWhere(['>=', 'document_date', $params["GldMstSearch"]["createdFrom"]])
                ->andFilterWhere(['<=', 'document_date', $params["GldMstSearch"]["createdTo"]]);

        return $dataProvider;
    }

}
