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
                    'staff_name' => $this->string(200),
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
                    'licence_no' => $this->string(200),
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
                    'profile_image_type' => $this->string(200),
                    'uniform' => $this->integer(),
                    'company_id' => $this->integer(),
                    'emergency_conatct_verification' => $this->integer(),
                    'panchayath_cleraance_verification' => $this->integer(),
                    'biodata' => $this->string(200),
                    'sslc' => $this->string(200),
                    'hse' => $this->string(200),
                    'KNC' => $this->string(200),
                    'INC' => $this->string(200),
                    'marklist' => $this->string(200),
                    'experience' => $this->string(200),
                    'id_proof' => $this->string(200),
                    'PCC' => $this->string(200)->comment('Police Clearance certificate'),
                    'authorised_letter' => $this->string(200)->comment('authorised letter from panchayth or muncipality or corporation'),
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


                $this->createTable('staff_other_info', [
                    'id' => $this->primaryKey(),
                    'staff_id' => $this->integer(),
                    'hospital_address' => $this->string(200),
                    'designation' => $this->string(200),
                    'length_of_service' => $this->string(200),
                    'current_from' => $this->date(),
                    'current_to' => $this->date(),
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

                $this->createTable('staff_pervious_employer', [
                    'id' => $this->primaryKey(),
                    'staff_id' => $this->integer(),
                    'hospital_address' => $this->string(200),
                    'designation' => $this->string(200),
                    'length_of_service' => $this->string(200),
                    'service_from' => $this->date(),
                    'service_to' => $this->date(),
                ]);
                $this->addForeignKey("staff_id", "staff_pervious_employer", "staff_id", "staff_info", "id", "RESTRICT", "RESTRICT");
        }

        /**
         * @inheritdoc
         */
        public function down() {
                $this->dropTable('staffinfo');
        }

}
