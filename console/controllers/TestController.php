<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use yii\db\Expression;

/**
 * ExpensesController implements the CRUD actions for Expenses model.
 */
class TestController extends Controller {

        public function actionIndex() {
                $today_date_time = date('Y-m-d H:i:s');
                $today = date("Y-m-d");
                $today_day = date("l");
                $today_date = date("j");

                /*
                 * Ever Day
                 */

                $today_followup = \common\models\RepeatedFollowups::find()->where(['repeated_type' => 4, 'status' => 0])->all();
                foreach ($today_followup as $value) {
                        $followup = new \common\models\Followups();
                        Yii::$app->Followups->Addcronfollowup($followup, $value);
                }

                /*
                 * Specific days in a week
                 */
                $followup_days = \common\models\RepeatedFollowups::find()->where(new Expression('FIND_IN_SET(:repeated_days, repeated_days)'))->addParams([':repeated_days' => $today_day])->andWhere(['status' => 0])->all();
                foreach ($followup_days as $value) {
                        $followup = new \common\models\Followups();
                        Yii::$app->Followups->Addcronfollowup($followup, $value);
                }

                /*
                 * specific dates in amonth
                 */

                $followup_dates = \common\models\RepeatedFollowups::find()->where(new Expression('FIND_IN_SET(:repeated_days, repeated_days)'))->addParams([':repeated_days' => $today_date])->andWhere(['status' => 0])->all();

                foreach ($followup_dates as $value) {
                        $followup = new \common\models\Followups();
                        $dd = Yii::$app->Followups->Addcronfollowup($followup, $value);
                }
        }

}
