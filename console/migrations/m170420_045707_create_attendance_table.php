<?php

use yii\db\Migration;

/**
 * Handles the creation of table `attendance`.
 */
class m170420_045707_create_attendance_table extends Migration {

        /**
         * @inheritdoc
         */
        public function up() {

                $this->createTable('master_attendance_type', [
                    'id' => $this->primaryKey(),
                    'type' => $this->string(),
                    'status' => $this->integer(),
                    'CB' => $this->integer(),
                    'UB' => $this->integer(),
                    'DOC' => $this->dateTime(),
                    'DOU' => $this->timestamp(),
                ]);
                $this->insert('master_attendance_type', ['id' => '1', 'type' => 'PRESENT', 'status' => '1', 'CB' => '1', 'UB' => '1', 'DOC' => '2017-04-20', 'DOU' => '2017-04-20 16:11:28']);
                $this->insert('master_attendance_type', ['id' => '2', 'type' => 'HALF DAY', 'status' => '1', 'CB' => '1', 'UB' => '1', 'DOC' => '2017-04-20', 'DOU' => '2017-04-20 16:11:28']);
                $this->insert('master_attendance_type', ['id' => '3', 'type' => 'ABSENT', 'status' => '1', 'CB' => '1', 'UB' => '1', 'DOC' => '2017-04-20', 'DOU' => '2017-04-20 16:11:28']);
                $this->insert('master_attendance_type', ['id' => '4', 'type' => 'OMPENSATORY OFF', 'status' => '1', 'CB' => '1', 'UB' => '1', 'DOC' => '2017-04-20', 'DOU' => '2017-04-20 16:11:28']);
                $this->insert('master_attendance_type', ['id' => '5', 'type' => 'COMPENSATORY WORK', 'status' => '1', 'CB' => '1', 'UB' => '1', 'DOC' => '2017-04-20', 'DOU' => '2017-04-20 16:11:28']);
                $this->insert('master_attendance_type', ['id' => '6', 'type' => 'DAY OFF', 'status' => '1', 'CB' => '1', 'UB' => '1', 'DOC' => '2017-04-20', 'DOU' => '2017-04-20 16:11:28']);

                $this->createTable('attendance', [
                    'id' => $this->primaryKey(),
                    'date' => $this->date(),
                    'branch_id' => $this->integer(),
                    'CB' => $this->integer(),
                    'UB' => $this->integer(),
                    'DOC' => $this->dateTime(),
                    'DOU' => $this->timestamp(),
                ]);
                $this->addForeignKey("barnchid", "attendance", "branch_id", "branch", "id", "RESTRICT", "RESTRICT");

                $this->createTable('attendance_entry', [
                    'id' => $this->primaryKey(),
                    'attendance_id' => $this->integer(),
                    'staff_id' => $this->integer(),
                    'total_hours' => $this->integer(),
                    'over_time' => $this->integer(),
                    'attendance' => $this->integer(),
                    'CB' => $this->integer(),
                    'UB' => $this->integer(),
                    'DOC' => $this->dateTime(),
                    'DOU' => $this->timestamp(),
                ]);
                $this->addForeignKey("attendanceid", "attendance_entry", "attendance_id", "attendance", "id", "RESTRICT", "RESTRICT");
                $this->addForeignKey("staffid_1", "attendance_entry", "staff_id", "staff_info", "id", "RESTRICT", "RESTRICT");
                $this->addForeignKey("attendance_type", "attendance_entry", "attendance", "master_attendance_type", "id", "RESTRICT", "RESTRICT");
        }

        /**
         * @inheritdoc
         */
        public function down() {
                $this->dropTable('attendance');
        }

}
