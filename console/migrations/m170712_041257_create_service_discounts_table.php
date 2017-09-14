<?php

use yii\db\Migration;

/**
 * Handles the creation of table `service_discounts`.
 */
class m170712_041257_create_service_discounts_table extends Migration {

        /**
         * @inheritdoc
         */
        public function up() {
                $this->createTable('service_discounts', [
                    'id' => $this->primaryKey(),
                    'service_id' => $this->integer(),
                    'rate' => $this->string(200)->comment('estimated price'),
                    'discount_type' => $this->integer()->comment('1=percentage,2=fixed'),
                    'discount_value' => $this->string(200),
                    'total_amount' => $this->string(200),
                    'date' => $this->date(),
                ]);
                $this->addForeignKey("fk_discount_service_id", "service_discounts", "service_id", "service", "id", "RESTRICT", "RESTRICT");
        }

        /**
         * @inheritdoc
         */
        public function down() {
                $this->dropTable('service_discounts');
        }

}
