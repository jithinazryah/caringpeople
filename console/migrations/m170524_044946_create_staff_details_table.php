<?php

use yii\db\Migration;

/**
 * Handles the creation of table `staff_details`.
 */
class m170524_044946_create_staff_details_table extends Migration {

        /**
         * @inheritdoc
         */
        public function up() {

//                $this->createTable('staff_enquiry_interview_first', [
//                    'id' => $this->primaryKey(),
//                    'staff_id' => $this->integer(),
//                    'age' => $this->integer(),
//                    'height' => $this->integer(),
//                    'weight' => $this->integer(),
//                    'smoke_or_drink' => $this->integer(),
//                    'police_station_name' => $this->string(200),
//                    'panchayat' => $this->string(200),
//                    'muncipality_corporation' => $this->string(),
//                    'mentioned_per_day_salary' => $this->integer(),
//                    'family_name' => $this->string(200),
//                    'relation' => $this->integer(),
//                    'job' => $this->string(200),
//                    'mobile_no' => $this->string(200),
//                    'terms_conditions' => $this->integer(),
//                    'language_1' => $this->string(200),
//                    'language_2' => $this->string(200),
//                    'language_3' => $this->string(200),
//                    'language_4' => $this->string(200),
//                ]);
//                $this->addForeignKey("staff_ids", "staff_enquiry_interview_first", "staff_id", "staff_info", "id", "RESTRICT", "RESTRICT");
//
//                $this->createTable('staff_enquiry_interview_second', [
//                    'id' => $this->primaryKey(),
//                    'staff_id' => $this->integer(),
//                    'contact_verified_by' => $this->string(200),
//                    'contact_verified_date' => $this->date(),
//                    'contact_verified_note' => $this->text(),
//                    'alt_contact_verified_by' => $this->string(200),
//                    'alt_contact_verified_date' => $this->date(),
//                    'alt_contact_verified_note' => $this->text(),
//                    'verified_name_1' => $this->string(200),
//                    'verified_designation_1' => $this->string(200),
//                    'verified_date_1' => $this->date(),
//                    'verified_mobile_no_1' => $this->string(200),
//                    'verified_name_2' => $this->string(200),
//                    'verified_designation_2' => $this->string(200),
//                    'verified_date_2' => $this->date(),
//                    'verified_mobile_no_2' => $this->string(200),
//                    'verified_name_3' => $this->string(200),
//                    'verified_designation_3' => $this->string(200),
//                    'verified_date_3' => $this->date(),
//                    'verified_mobile_no_3' => $this->string(200),
//                ]);
//                $this->addForeignKey("staff_id_second", "staff_enquiry_interview_second", "staff_id", "staff_info", "id", "RESTRICT", "RESTRICT");
//
//                $this->createTable('staff_enquiry_interview_third', [
//                    'id' => $this->primaryKey(),
//                    'staff_id' => $this->integer(),
//                    'bank_ac_no' => $this->string(200),
//                    'bank_ac_hodername' => $this->string(200),
//                    'bank_name' => $this->string(200),
//                    'bank_branch' => $this->string(200),
//                    'bank_ifsc' => $this->string(200),
//                    'staff_experience' => $this->string(200),
//                    'document_required' => $this->string(200),
//                    'document_received' => $this->string(200),
//                    'form_filled' => $this->integer(),
//                    'interest_level' => $this->integer(),
//                    'expected_date_of_joining' => $this->date(),
//                    'interview_notes' => $this->text(),
//                    'interviewed_by' => $this->string(200),
//                    'interviewed_date' => $this->date(),
//                ]);
//                $this->addForeignKey("staff_id_third", "staff_enquiry_interview_third", "staff_id", "staff_info", "id", "RESTRICT", "RESTRICT");
//                $this->createTable('staff_experience_list', [
//                    'id' => $this->primaryKey(),
//                    'title' => $this->string(200),
//                    'status' => $this->integer(),
//                    'CB' => $this->integer(),
//                    'UB' => $this->integer(),
//                    'DOC' => $this->date(),
//                    'DOU' => $this->timestamp(),
//                ]);
//                $this->createTable('terms_and_conditions', [
//                    'id' => $this->primaryKey(),
//                    'type' => $this->integer()->comment('1=Patient Enq,2=Patient,3=Staff Enq,4=Staff'),
//                    'note' => $this->text(),
//                    'status' => $this->integer(),
//                    'CB' => $this->integer(),
//                    'UB' => $this->integer(),
//                    'DOC' => $this->date(),
//                    'DOU' => $this->timestamp(),
//                ]);
//                $this->addColumn('staff_pervious_employer', 'salary', 'string(200)');
//                $this->addColumn('staff_info', 'proceed', 'integer');
//                $this->addColumn('staff_info', 'staff_enquiry_number', 'string(200)');
//                $this->addColumn('staff_info', 'age', 'integer after dob');
                $this->addColumn('patient_enquiry_hospital_first', 'patient_dob', 'date after patient_age');
                //all tables enquiry_id
        }

        /**
         * @inheritdoc
         */
        public function down() {
                $this->dropTable('staff_details');
        }

}
