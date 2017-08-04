<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gld_mst".
 *
 * @property integer $id
 * @property integer $journal_type
 * @property integer $voucher_type
 * @property string $document_no
 * @property string $document_date
 * @property string $financial_year
 * @property integer $financial_year_id
 * @property string $reference
 * @property string $credit_amount
 * @property string $debit_amount
 * @property string $balance_amount
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property VoucherType $voucherType
 * @property FinancialYears $financialYear
 */
class GldMst extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'gld_mst';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['journal_type', 'financial_year_id', 'status', 'CB', 'UB'], 'integer'],
            [['document_date', 'financial_year', 'DOC', 'DOU', 'voucher_type'], 'safe'],
            [['document_no'], 'required'],
            [['credit_amount', 'debit_amount', 'balance_amount'], 'number'],
            [['document_no'], 'string', 'max' => 15],
            [['reference'], 'string', 'max' => 50],
            [['voucher_type'], 'exist', 'skipOnError' => true, 'targetClass' => VoucherType::className(), 'targetAttribute' => ['voucher_type' => 'id']],
            [['financial_year_id'], 'exist', 'skipOnError' => true, 'targetClass' => FinancialYears::className(), 'targetAttribute' => ['financial_year_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'journal_type' => 'Journal Type',
            'voucher_type' => 'Voucher Type',
            'document_no' => 'Document No',
            'document_date' => 'Document Date',
            'financial_year' => 'Financial Year',
            'financial_year_id' => 'Financial Year ID',
            'reference' => 'Reference',
            'credit_amount' => 'Credit Amount',
            'debit_amount' => 'Debit Amount',
            'balance_amount' => 'Balance Amount',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVoucherType() {
        return $this->hasOne(VoucherType::className(), ['id' => 'voucher_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFinancialYear() {
        return $this->hasOne(FinancialYears::className(), ['id' => 'financial_year_id']);
    }

    public static function getTotal($from_date, $to, $field_name) {
        if ($from_date != '' && $to != '') {
            $from_date = $from_date . ' 00:00:00';
            $to = $to . ' 60:60:60';
            return GldMst::find()->where(['>=', 'document_date', $from_date])->andWhere(['<=', 'document_date', $to])->sum($field_name);
        } elseif ($from_date != '' || $to != '') {
            return 0;
        } else {
            return GldMst::find()->sum($field_name);
        }
    }

}
