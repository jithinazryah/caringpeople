<?php

use yii\db\Migration;

/**
 * Handles the creation of table `staffinfo`.
 */
class m170322_074707_create_staffinfo_table extends Migration {

        /**
         * @inheritdoc
         */
        public function up() {
                $this->createTable('staff_info', [
                    'id' => $this->primaryKey(),
                    'staff_enquiry_id' => $this->integer(),
                    'staff_id' => $this->string(200),
                    'staff_name' => $this->string(200),
                    'password' => $this->string(200),
                    'username' => $this->string(200),
                    'post_id' => $this->integer(),
                    'gender' => $this->integer()->comment('0=Male,1=Female'),
                    'dob' => $this->date(),
                    'blood_group' => $this->string(200),
                    'religion' => $this->integer(),
                    'caste' => $this->integer(),
                    'nationality' => $this->integer(),
                    'pan_or_adhar_no' => $this->string(200),
                    'permanent_address' => $this->string(200),
                    'pincode' => $this->string(200),
                    'contact_no' => $this->string(200),
                    'email' => $this->string(200),
                    'present_address' => $this->string(200),
                    'present_pincode' => $this->string(200),
                    'present_contact_no' => $this->string(200),
                    'present_email' => $this->string(200),
                    'years_of_experience' => $this->integer(),
                    'driving_licence' => $this->integer()->comment('0 = No, 1 = motor Cycle & LMV, 2 = Motor Cycle, 3 = LMV'),
                    'designation' => $this->string(200),
                    'staff_experience' => $this->string(200),
                    'licence_no' => $this->string(200),
                    'place' => $this->string(200),
                    'staff_manager' => $this->string(200),
                    'terms_conditions' => $this->integer(),
                    'average_point' => $this->integer(),
                    'working_status' => $this->integer(),
                    'branch_id' => $this->integer()->notNull(),
                    'status' => $this->smallInteger()->notNull(),
                    'CB' => $this->integer()->notNull(),
                    'UB' => $this->integer()->notNull(),
                    'DOC' => $this->date(),
                    'DOU' => $this->timestamp(),
                ]);

                $this->addForeignKey("religion", "staff_info", "religion", "religion", "id", "RESTRICT", "RESTRICT");
                $this->addForeignKey("caste", "staff_info", "caste", "caste", "id", "RESTRICT", "RESTRICT");
                $this->addForeignKey("branch_id", "staff_info", "branch_id", "branch", "id", "RESTRICT", "RESTRICT");
                $this->addForeignKey("staff_enquiry_id", "staff_info", "staff_enquiry_id", "staff_enquiry", "id", "RESTRICT", "RESTRICT");


                $this->createTable('staff_other_info', [
                    'id' => $this->primaryKey(),
                    'staff_id' => $this->integer(),
                    'enquiry_id' => $this->integer(),
                    'hospital_address' => $this->string(200),
                    'designation' => $this->string(200),
                    'length_of_service' => $this->string(200),
                    'current_from' => $this->date(),
                    'current_to' => $this->date(),
                    'salary' => $this->string(200),
                    'emergency_contact_name' => $this->string(200),
                    'relationship' => $this->string(200),
                    'phone' => $this->string(200),
                    'mobile' => $this->string(200),
                    'alt_emergency_contact_name' => $this->string(200)->comment('Alternate emergency contact name'),
                    'alt_relationship' => $this->string(200),
                    'alt_phone' => $this->string(200),
                    'alt_mobile' => $this->string(200),
                ]);

                $this->addForeignKey("staffid", "staff_other_info", "staff_id", "staff_info", "id", "RESTRICT", "RESTRICT");

                $this->createTable('staff_info_education', [
                    'id' => $this->primaryKey(),
                    'staff_id' => $this->integer(),
                    'enquiry_id' => $this->integer(),
                    'sslc_institution' => $this->string(200),
                    'sslc_year_of_passing' => $this->integer(),
                    'sslc_place' => $this->string(200),
                    'hse_institution' => $this->string(200),
                    'hse_year_of_passing' => $this->integer(),
                    'hse_place' => $this->string(200),
                    'nursing_institution' => $this->string(200),
                    'nursing_year_of_passing' => $this->integer(),
                    'nursing_place' => $this->string(200),
                    'timing' => $this->integer()->comment('0 = Part time, 1 = Full time'),
                    'uniform' => $this->integer(),
                    'company_id' => $this->integer(),
                    'emergency_conatct_verification' => $this->integer(),
                    'panchayath_cleraance_verification' => $this->integer(),
                ]);

                $this->createTable('staff_pervious_employer', [
                    'id' => $this->primaryKey(),
                    'staff_id' => $this->integer(),
                    'enquiry_id' => $this->integer(),
                    'hospital_address' => $this->string(200),
                    'designation' => $this->string(200),
                    'length_of_service' => $this->string(200),
                    'service_from' => $this->date(),
                    'service_to' => $this->date(),
                    'salary' => $this->string(200),
                ]);
                $this->addForeignKey("staff_id", "staff_pervious_employer", "staff_id", "staff_info", "id", "RESTRICT", "RESTRICT");
                $this->addForeignKey("post_id", "staff_info", "post_id", "admin_posts", "id", "RESTRICT", "RESTRICT");

                $this->createTable('staff_pervious_employer', [
                    'id' => $this->primaryKey(),
                    'staff_id' => $this->integer(),
                    'basic_salary' => $this->string(200),
                    'hra' => $this->string(200),
                    'food_and_accomodation' => $this->string(200),
                    'conveyance' => $this->string(200),
                    'lta' => $this->string(200),
                    'medical_allowance' => $this->string(200),
                    'other_allowances' => $this->string(200),
                    'stipend' => $this->string(200),
                    'PF_deduction' => $this->string(200),
                    'ESI_deduction' => $this->string(200),
                    'other_deduction' => $this->string(200),
                    'date_of_salary' => $this->date(),
                ]);
        }

        /**
         * @inheritdoc
         */
        public function down() {
                $this->dropTable('staffinfo');
        }

}
