<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\GldDtl;

/**
 * GldDtlSearch represents the model behind the search form about `common\models\GldDtl`.
 */
class GldDtlSearch extends GldDtl {

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

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'GLDMstID', 'voucher_type', 'pos', 'bank_recon_status', 'status', 'CB', 'UB'], 'integer'],
            [['document_no', 'document_date', 'account_name', 'description', 'bp_code', 'bp_name', 'bank_recon_date', 'error_msg', 'DOC', 'DOU', 'account_number', 'payment_mode'], 'safe'],
            [['debit_amount', 'credit_amount'], 'number'],
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
        if (!isset($params["GldDtlSearch"]["createdFrom"])) {
            $params["GldDtlSearch"]["createdFrom"] = '';
        } else {
            $params["GldDtlSearch"]["createdFrom"] = $params["GldDtlSearch"]["createdFrom"] . ' 00:00:00';
        }
        if (!isset($params["GldDtlSearch"]["createdTo"])) {
            $params["GldDtlSearch"]["createdTo"] = '';
        } else {
            $params["GldDtlSearch"]["createdTo"] = $params["GldDtlSearch"]["createdTo"] . ' 60:60:60';
        }
        $query = GldDtl::find()->orderBy(['id' => SORT_DESC]);

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
            'GLDMstID' => $this->GLDMstID,
            'voucher_type' => $this->voucher_type,
            'document_date' => $this->document_date,
            'pos' => $this->pos,
            'account_number' => $this->account_number,
            'debit_amount' => $this->debit_amount,
            'credit_amount' => $this->credit_amount,
            'payment_mode' => $this->payment_mode,
            'bank_recon_date' => $this->bank_recon_date,
            'bank_recon_status' => $this->bank_recon_status,
            'status' => $this->status,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
        ]);

        $query->andFilterWhere(['like', 'document_no', $this->document_no])
                ->andFilterWhere(['like', 'account_name', $this->account_name])
                ->andFilterWhere(['like', 'description', $this->description])
                ->andFilterWhere(['like', 'bp_code', $this->bp_code])
                ->andFilterWhere(['like', 'bp_name', $this->bp_name])
                ->andFilterWhere(['like', 'error_msg', $this->error_msg])
                ->andFilterWhere(['>=', 'document_date', $params["GldDtlSearch"]["createdFrom"]])
                ->andFilterWhere(['<=', 'document_date', $params["GldDtlSearch"]["createdTo"]]);

        return $dataProvider;
    }

}
