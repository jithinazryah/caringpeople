<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\StaffInfo;

/**
 * StaffInfoSearch represents the model behind the search form about `common\models\StaffInfo`.
 */
class StaffInfoSearch extends StaffInfo {

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['id', 'designation', 'gender', 'religion', 'caste', 'nationality', 'years_of_experience', 'driving_licence', 'sslc_year_of_passing', 'hse_year_of_passing', 'nursing_year_of_passing', 'timing', 'uniform', 'company_id', 'emergency_conatct_verification', 'panchayath_cleraance_verification', 'branch_id', 'status', 'CB', 'UB'], 'integer'],
                        [['staff_name', 'dob', 'place', 'blood_group', 'pan_or_adhar_no', 'permanent_address', 'pincode', 'contact_no', 'email', 'present_address', 'present_pincode', 'present_contact_no', 'present_email', 'licence_no', 'sslc_institution', 'sslc_place', 'hse_institution', 'hse_place', 'nursing_institution', 'nursing_place', 'profile_image_type', 'biodata', 'DOC', 'DOU'], 'safe'],
                ];
        }

        /**
         * @inheritdoc
         */
        public function scenarios() {
                // bypass scenarios() implementation in the parent class
                return Model::scenarios();
        }

        /**
         * Creates data provider instance with search query applied
         *
         * @param array $params
         *
         * @return ActiveDataProvider
         */
        public function search($params) {
                $query = StaffInfo::find();

                // add conditions that should always apply here

                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                    'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
                ]);

                $this->load($params);

                if (!$this->validate()) {
                        // uncomment the following line if you do not want to return any records when validation fails
                        // $query->where('0=1');
                        return $dataProvider;
                }

                // grid filtering conditions
                $query->andFilterWhere([
                    'id' => $this->id,
                    'gender' => $this->gender,
                    'dob' => $this->dob,
                    'religion' => $this->religion,
                    'caste' => $this->caste,
                    'nationality' => $this->nationality,
                    'years_of_experience' => $this->years_of_experience,
                    'driving_licence' => $this->driving_licence,
                    'sslc_year_of_passing' => $this->sslc_year_of_passing,
                    'hse_year_of_passing' => $this->hse_year_of_passing,
                    'nursing_year_of_passing' => $this->nursing_year_of_passing,
                    'timing' => $this->timing,
                    'uniform' => $this->uniform,
                    'company_id' => $this->company_id,
                    'emergency_conatct_verification' => $this->emergency_conatct_verification,
                    'panchayath_cleraance_verification' => $this->panchayath_cleraance_verification,
                    'branch_id' => $this->branch_id,
                    'status' => $this->status,
                    'CB' => $this->CB,
                    'UB' => $this->UB,
                    'DOC' => $this->DOC,
                    'DOU' => $this->DOU,
                ]);

                $query->andFilterWhere(['like', 'staff_name', $this->staff_name])
                        ->andFilterWhere(['like', 'blood_group', $this->blood_group])
                        ->andFilterWhere(['like', 'pan_or_adhar_no', $this->pan_or_adhar_no])
                        ->andFilterWhere(['like', 'permanent_address', $this->permanent_address])
                        ->andFilterWhere(['like', 'pincode', $this->pincode])
                        ->andFilterWhere(['like', 'contact_no', $this->contact_no])
                        ->andFilterWhere(['like', 'email', $this->email])
                        ->andFilterWhere(['like', 'present_address', $this->present_address])
                        ->andFilterWhere(['like', 'present_pincode', $this->present_pincode])
                        ->andFilterWhere(['like', 'present_contact_no', $this->present_contact_no])
                        ->andFilterWhere(['like', 'place', $this->place])
                        ->andFilterWhere(['like', 'designation', $this->designation])
                        ->andFilterWhere(['like', 'present_email', $this->present_email])
                        ->andFilterWhere(['like', 'licence_no', $this->licence_no])
                        ->andFilterWhere(['like', 'sslc_institution', $this->sslc_institution])
                        ->andFilterWhere(['like', 'sslc_place', $this->sslc_place])
                        ->andFilterWhere(['like', 'hse_institution', $this->hse_institution])
                        ->andFilterWhere(['like', 'hse_place', $this->hse_place])
                        ->andFilterWhere(['like', 'nursing_institution', $this->nursing_institution])
                        ->andFilterWhere(['like', 'nursing_place', $this->nursing_place])
                        ->andFilterWhere(['like', 'profile_image_type', $this->profile_image_type])
                        ->andFilterWhere(['like', 'biodata', $this->biodata]);

                return $dataProvider;
        }

}
