<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use yii\db\Expression;

/**
 * ExpensesController implements the CRUD actions for Expenses model.
 */
class ReportController extends Controller {

        public function actionIndex() {
                $server = Yii::$app->request->serverName;
                $message = "";
                $users = \common\models\History::find()->select('CB')->where(['date' => date('Y-m-d')])->groupBy('CB')->all();
                $message .= "
                             <html>
                               <body>
                                   <div class='mail-body' style='margin: auto;width: 50%;border: 1px solid #9e9e9e;'>
                                   <div style='margin-left: 40px;'>
                                     <img src='$server/admin/images/logos/logo-1.png'  style='width:200px'>
                                   <p><b>REPORT</b></p>
                                  <table>";

                foreach ($users as $value) {
                        $staff = \common\models\StaffInfo::findOne($value->CB);
                        $message .= "<tr><td colspan='2'><p><b>$staff->staff_name</b></p></td></tr>";
                        $works = \common\models\History::find()->where(['CB' => $value->CB, 'date' => date('Y-m-d')])->all();
                        $k = 0;
                        foreach ($works as $works) {
                                $k++;
                                $message .= "<tr><td>$k.</td><td><p>$works->content</p></td></tr>";
                        }
                }


                $message .= "</div>
                </div><table></body></html>";

                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n" .
                        "From: info@caringpeople.in";
                mail('sabitha393@gmail.com', 'Report', $message, $headers);
        }

}
