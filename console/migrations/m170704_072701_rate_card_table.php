<?php

use yii\db\Migration;

class m170704_072701_rate_card_table extends Migration {

        public function safeUp() {

        }

        public function up() {
                /*   $this->createTable('rate_card', [
                  'id' => $this->primaryKey(),
                  'service_id' => $this->integer(),
                  'rate_card_name' => $this->string(200),
                  'rate_per_hour' => $this->string(200),
                  'rate_per_visit' => $this->string(200),
                  'rate_per_day' => $this->string(200),
                  'rate_per_night' => $this->string(200),
                  'rate_per_day_night' => $this->string(200),
                  'period_from' => $this->date(),
                  'period_to' => $this->date(),
                  'status' => $this->integer(),
                  'CB' => $this->integer(),
                  'UB' => $this->integer(),
                  'DOC' => $this->dateTime(),
                  'DOU' => $this->timestamp(),
                  ]);

                  $this->addForeignKey("fk_service_id", "rate_card", "service_id", "master_service_types", "id", "RESTRICT", "RESTRICT");
                  $this->addColumn('rate_card', 'branch_id', 'integer after period_to'); */
                $this->addColumn('service', 'frequency', 'string(200) after duty_type');
                $this->addColumn('service', 'hours', 'string(200) after frequency');
                $this->addColumn('service', 'days', 'string(200) after hours');
        }

        public function down() {
                echo "m170704_072701_rate_card_table cannot be reverted.\n";

                return false;
        }

}
