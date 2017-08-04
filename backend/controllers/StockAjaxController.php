<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\BusinessPartner;
use yii\helpers\Json;

class StockAjaxController extends \yii\web\Controller {

    public function actionIndex() {
        return $this->render('index');
    }

    /*
     * This function select Countries based on the continent_id
     * return result to the view
     */

    public function actionGetAccounts() {
        if (Yii::$app->request->isAjax) {
            $partner_id = $_POST['partner_id'];
            $next_row_id = $_POST['next_row_id'];
            $account_type = $_POST['account_type'];
            $next = $next_row_id + 1;
            if ($account_type == 1) {
                $account_datas = \common\models\ChartofAccounts::find()->Where(['parent_account' => 3, 'level' => 0])->all();
            } else {
                $account_datas = \common\models\ChartofAccounts::find()->where(['status' => 1, 'level' => 0])->all();
            }
            if ($partner_id == '') {
                echo '0';
                exit;
            } else {
                $next_row = $this->renderPartial('next_row', [
                    'next' => $next,
                    'account_datas' => $account_datas,
                ]);
                $arr_variable = array('next_row_html' => $next_row, 'next' => $next);
                $data['result'] = $arr_variable;
                echo json_encode($data);
            }
        }
    }

    public function actionGetChartofAccount() {
        if (Yii::$app->request->isAjax) {
            $partner_id = $_POST['partner_id'];
            $next_row_id = $_POST['next_row_id'];
            $next = $next_row_id + 1;
            $account_datas = \common\models\ChartofAccounts::find()->where(['status' => 1, 'level' => 0])->all();
            if ($partner_id == '') {
                echo '0';
                exit;
            } else {
                $next_row = $this->renderPartial('new_row', [
                    'next' => $next,
                    'account_datas' => $account_datas,
                ]);
                $arr_variable = array('next_row_html' => $next_row, 'next' => $next);
                $data['result'] = $arr_variable;
                echo json_encode($data);
            }
        }
    }

    public function actionAddAnotherRow() {
        if (Yii::$app->request->isAjax) {
            $next_row_id = $_POST['next_row_id'];
            $next = $next_row_id + 1;
            $account_datas = \common\models\ChartofAccounts::find()->where(['status' => 1])->all();
            $next_row = $this->renderPartial('next_row', [
                'next' => $next,
                'account_datas' => $account_datas,
            ]);
            $new_row = array('next_row_html' => $next_row);
            $data['result'] = $new_row;
            echo json_encode($data);
        }
    }

    public function actionAddAnotherRows() {
        if (Yii::$app->request->isAjax) {
            $next_row_id = $_POST['next_row_id'];
            $next = $next_row_id + 1;
            $account_datas = \common\models\ChartofAccounts::find()->where(['parent_account' => 3, 'level' => 0])->all();
            $next_row = $this->renderPartial('next_row', [
                'next' => $next,
                'account_datas' => $account_datas,
            ]);
            $new_row = array('next_row_html' => $next_row);
            $data['result'] = $new_row;
            echo json_encode($data);
        }
    }

    public function actionGenerateDocumentNo() {
        if (Yii::$app->request->isAjax) {
            $voucher_type = $_POST['voucher_type'];
            $year = date("Y", strtotime(str_replace('/', '-', $_POST['stock_date'])));
            $series = \common\models\VoucherSeries::find()->where(['voucher_type' => $voucher_type, 'financial_year' => $year])->one();
            if (empty($series)) {
                echo '';
                exit;
            } else {
                $digit = '%0' . $series->digits . 'd';
                $document_no = $series->prefix . (sprintf($digit, $series->sequence_no));
            }
            $document_data = array('document-no' => $document_no, 'financial-year-id' => $series->financial_year_id, 'financial-year' => $series->financial_year);
            $data['result'] = $document_data;
            echo json_encode($data);
        }
    }

    public function actionAddPartner() {
        if (Yii::$app->request->isAjax) {
            $row_id = $_POST['row_id'];
            $data = $this->renderPartial('_form_add_partners', [
                'row_id' => $row_id,
            ]);
            echo $data;
        }
    }

    public function generatePartner($prefix, $sequence_no) {
        $business_partner_code = $prefix . '-' . $sequence_no;
        $file_exist = \common\models\BusinessPartner::find()->where(['business_partner_code' => $business_partner_code])->one();
        if (!empty($file_exist)) {
            return $this->generatePartner($prefix, $sequence_no + 1);
        } else {
            return $business_partner_code;
        }
    }

    public function actionUpdatePartner() {
        if (Yii::$app->request->isAjax) {
            $model = new \common\models\BusinessPartner();
            $model->type = $_POST['partner_type'];
            $model->business_partner_code = $_POST['bussiness_partner_code'];
            $model->name = $_POST['bussiness_partner_name'];
            $model->phone = $_POST['bussiness_partner_phone'];
            $model->email = $_POST['bussiness_partner_email'];
            Yii::$app->SetValues->Attributes($model);
            if ($model->save()) {
                $partner_code = explode("-", $model->business_partner_code);
                $serial_no = \common\models\SerialNumber::find()->orderBy(['id' => SORT_DESC])->where(['transaction' => 5])->one();
                $serial_no->sequence_no = $partner_code[1];
                $serial_no->save();
                $arrr_variable = array('partner-id' => $model->id, 'partner-name' => $model->name);
                $data['result'] = $arrr_variable;
                echo json_encode($data);
            }
        }
    }

    public function actionSelectPayments() {
        if (Yii::$app->request->isAjax) {
            $partner = $_POST['id'];
            $type = $_POST['type'];
            if ($type == 0) {
                $payment_details = \common\models\SalesInvoiceMaster::find()->where(['busines_partner_code' => $partner])->andWhere(['>', 'due_amount', 0])->all();
            } elseif ($type == 1) {
                $payment_details = \common\models\PurchaseInvoiceMaster::find()->where(['busines_partner_code' => $partner])->andWhere(['>', 'due_amount', 0])->all();
            }
            if (!empty($payment_details)) {
                $data = $this->renderPartial('_form_receipt', [
                    'payment_details' => $payment_details,
                ]);
            } else {
                $data = '<p style="font-size: 17px;color:red;">Due amount is not available for this account</p>';
            }
            echo $data;
        }
    }

}
