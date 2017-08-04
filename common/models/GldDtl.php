<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gld_dtl".
 *
 * @property integer $id
 * @property integer $GLDMstID
 * @property integer $voucher_type
 * @property string $document_no
 * @property string $document_date
 * @property integer $pos
 * @property integer $account_number
 * @property string $account_name
 * @property string $description
 * @property string $bp_code
 * @property string $bp_name
 * @property string $debit_amount
 * @property string $credit_amount
 * @property string $bank_recon_date
 * @property integer $bank_recon_status
 * @property string $error_msg
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class GldDtl extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'gld_dtl';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['GLDMstID', 'voucher_type'], 'required'],
            [['GLDMstID', 'voucher_type', 'pos', 'bank_recon_status', 'status', 'CB', 'UB'], 'integer'],
            [['document_date', 'bank_recon_date', 'DOC', 'DOU', 'account_id', 'account_number', 'payment_mode'], 'safe'],
            [['description', 'error_msg'], 'string'],
            [['debit_amount', 'credit_amount'], 'number'],
            [['document_no', 'bp_code', 'bp_name'], 'string', 'max' => 15],
            [['account_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'GLDMstID' => 'Gldmst ID',
            'voucher_type' => 'Voucher Type',
            'document_no' => 'Document No',
            'document_date' => 'Document Date',
            'pos' => 'Pos',
            'account_id' => 'Account Head',
            'account_number' => 'Account Number',
            'account_name' => 'Account Name',
            'description' => 'Description',
            'bp_code' => 'Bp Code',
            'bp_name' => 'Bp Name',
            'debit_amount' => 'Debit Amount',
            'credit_amount' => 'Credit Amount',
            'payment_mode' => 'Payment Mode',
            'bank_recon_date' => 'Bank Recon Date',
            'bank_recon_status' => 'Bank Recon Status',
            'error_msg' => 'Error Msg',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
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
