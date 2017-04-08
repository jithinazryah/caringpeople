<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PatientEnquiryGeneralFirst;

/**
 * PatientEnquiryGeneralFirstSearch represents the model behind the search form about `common\models\PatientEnquiryGeneralFirst`.
 */
class PatientEnquiryGeneralFirstSearch extends PatientEnquiryGeneralFirst {

        /**
         * @inheritdoc
         */
        public $email;
        public $required_service;
        public $patient_name;

        public function rules() {
                return [
                        [['id', 'contacted_source', 'caller_gender', 'branch_id', 'status', 'CB', 'UB'], 'integer'],
                        [['enquiry_number', 'email', 'required_service', 'patient_name', 'contacted_date', 'incoming_missed', 'outgoing_number_from', 'outgoing_number_from_other', 'outgoing_call_date', 'caller_name', 'referral_source', 'referral_source_others', 'mobile_number', 'mobile_number_2', 'mobile_number_3', 'DOC', 'DOU'], 'safe'],
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

                $query = PatientEnquiryGeneralFirst::find();
                $query->joinWith(['patientGeneralInfo']);
                $query->joinWith(['patientHospitalInfo']);
                // add conditions that should always apply here

                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                    'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
                ]);
                $dataProvider->sort->attributes['email'] = [
                    // The tables are the ones our relation are configured to
                    // in my case they are prefixed with "tbl_"
                    'asc' => ['patient_enquiry_general_second.email' => SORT_ASC],
                    'desc' => ['patient_enquiry_general_second.email' => SORT_DESC],
                ];

                $this->load($params);

                if (!$this->validate()) {
                        // uncomment the following line if you do not want to return any records when validation fails
                        // $query->where('0=1');
                        return $dataProvider;
                }

                // grid filtering conditions
                $query->andFilterWhere([
                    'id' => $this->id,
                    'contacted_source' => $this->contacted_source,
                    'contacted_date' => $this->contacted_date,
                    'outgoing_call_date' => $this->outgoing_call_date,
                    'caller_gender' => $this->caller_gender,
                    'branch_id' => $this->branch_id,
                    'status' => $this->status,
                    'CB' => $this->CB,
                    'UB' => $this->UB,
                    'DOC' => $this->DOC,
                    'DOU' => $this->DOU,
                ]);

                $query->andFilterWhere(['like', 'enquiry_number', $this->enquiry_number])
                        ->andFilterWhere(['like', 'incoming_missed', $this->incoming_missed])
                        ->andFilterWhere(['like', 'outgoing_number_from', $this->outgoing_number_from])
                        ->andFilterWhere(['like', 'outgoing_number_from_other', $this->outgoing_number_from_other])
                        ->andFilterWhere(['like', 'caller_name', $this->caller_name])
                        ->andFilterWhere(['like', 'referral_source', $this->referral_source])
                        ->andFilterWhere(['like', 'referral_source_others', $this->referral_source_others])
                        ->andFilterWhere(['like', 'mobile_number', $this->mobile_number])
                        ->andFilterWhere(['like', 'mobile_number_2', $this->mobile_number_2])
                        ->andFilterWhere(['like', 'patient_enquiry_general_second.email', $this->email])
                        ->andFilterWhere(['like', 'patient_enquiry_general_second.required_service', $this->required_service])
                        ->andFilterWhere(['like', 'patient_enquiry_hospital_first.required_person_name', $this->patient_name])
                        ->andFilterWhere(['like', 'mobile_number_3', $this->mobile_number_3])
                        ->andFilterWhere(['>=', 'contacted_date', $params['Enquiry']['contactedFrom']])
                        ->andFilterWhere(['<=', 'contacted_date', $params['Enquiry']['contactedTo']])
                        ->andFilterWhere(['>=', 'outgoing_call_date', $params['Enquiry']['$outgoingFrom']])
                        ->andFilterWhere(['<=', 'outgoing_call_date', $params['Enquiry']['$outgoingTo']]);

                return $dataProvider;
        }

}
