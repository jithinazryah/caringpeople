<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\StaffInfo;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * StaffInfoSearch represents the model behind the search form about `common\models\StaffInfo`.
 */
class StaffInfoSearch extends StaffInfo {

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['id', 'designation', 'gender', 'religion', 'caste', 'nationality', 'years_of_experience', 'driving_licence', 'branch_id', 'status', 'CB', 'UB'], 'integer'],
                        [['staff_name', 'dob', 'place', 'blood_group', 'pan_or_adhar_no', 'permanent_address', 'pincode', 'contact_no', 'email', 'present_address', 'present_pincode', 'present_contact_no', 'present_email', 'licence_no', 'DOC', 'DOU', 'staff_id', 'staff_manager', 'average_point', 'staff_experience', 'working_status'], 'safe'],
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
                    'sort' => ['defaultOrder' => ['id' => SORT_DESC,
                        ]]
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
                        ->andFilterWhere(['like', 'staff_id', $this->staff_id])
                        ->andFilterWhere(['like', 'email', $this->email])
                        ->andFilterWhere(['like', 'present_address', $this->present_address])
                        ->andFilterWhere(['like', 'present_pincode', $this->present_pincode])
                        ->andFilterWhere(['like', 'present_contact_no', $this->present_contact_no])
                        ->andFilterWhere(['like', 'place', $this->place])
                        ->andFilterWhere(['like', 'designation', $this->designation])
                        ->andFilterWhere(['like', 'present_email', $this->present_email])
                        ->andFilterWhere(['like', 'average_point', $this->average_point])
                        ->andFilterWhere(['like', 'staff_experience', $this->staff_experience])
                        ->andFilterWhere(['like', 'working_status', $this->working_status])
                        ->andFilterWhere(['like', 'licence_no', $this->licence_no]);



                return $dataProvider;
        }

        public function getGridColumns() {
                return [
                        ['class' => 'yii\grid\SerialColumn'],
//                                                    [
//                                                    'attribute' => 'profile_image_type',
//                                                    'format' => 'html',
//                                                    'value' => function($data) {
//                                                            $staff_uploads = StaffInfoUploads::findOne(['staff_id' => $data->id]);
//                                                            if (isset($staff_uploads->profile_image_type) && $staff_uploads->profile_image_type != '') {
//                                                                    return Html::img(Yii::$app->homeUrl . '../uploads/staff/' . $data->id . '/profile_image_type.' . $staff_uploads->profile_image_type, ['width' => '100']);
//                                                            } elseif ($data->gender == '0') {
//                                                                    return Html::img(Yii::$app->homeUrl . '/images/themes/photo.png', ['width' => '100']);
//                                                            } else if ($data->gender == '1') {
//                                                                    return Html::img(Yii::$app->homeUrl . '/images/themes/female.png', ['width' => '100']);
//                                                            } else {
//                                                                    return Html::img(Yii::$app->homeUrl . 'images/themes/no-image.gif', ['width' => '100']);
//                                                            }
//                                                    },
//                                                ],
                    'staff_id',
                    'staff_name',
                        [
                        'attribute' => 'gender',
                        'value' => function($model, $key, $index, $column) {
                                if ($model->gender == '0') {
                                        return 'Male';
                                } else if ($model->gender == '1') {
                                        return 'Female';
                                }
                        },
                        'filter' => [1 => 'Female', 0 => 'Male'],
                    ],
                    'place',
                        [
                        'attribute' => 'designation',
                        'value' => function($model, $key, $index, $column) {
                                //  $designation = \common\models\MasterDesignations::findOne(['id' => $model->designation]);
//
                                return $model->designation($model->designation);
                        },
                        'filter' => ArrayHelper::map(\common\models\MasterDesignations::designationlist(), 'id', 'title'),
                    ],
                        [
                        'attribute' => 'branch_id',
                        'value' => function($data) {
                                return Branch::findOne($data->branch_id)->branch_name;
                        },
                        'filter' => ArrayHelper::map(\common\models\Branch::branch(), 'id', 'branch_name'),
                    ],
                        [
                        'attribute' => 'status',
                        'value' => function($model, $key, $index, $column) {
                                if ($model->status == '1') {
                                        return 'Opened';
                                } else if ($model->status == '2') {
                                        return 'Closed';
                                } else if ($model->status == '3') {
                                        return 'Occupied';
                                }
                        },
                        'filter' => [1 => 'Opened', 2 => 'Closed'],
                    ],
                    'average_point',
                        ['class' => 'yii\grid\ActionColumn',
                        'template' => '{view}{update}{delete}',
                        'visibleButtons' => [
                            'delete' => function ($model, $key, $index) {
                                    return Yii::$app->user->identity->post_id != '1' ? false : true;
                            }
                        ],
                    ],
                ];
        }

        public function getExportColumns() {
                return [
                        ['class' => 'yii\grid\SerialColumn'],
//
                    'staff_id',
                    'staff_name',
                        [
                        'attribute' => 'gender',
                        'value' => function($model, $key, $index, $column) {
                                if ($model->gender == '0') {
                                        return 'Male';
                                } else if ($model->gender == '1') {
                                        return 'Female';
                                }
                        },
                        'filter' => [1 => 'Female', 0 => 'Male'],
                    ],
                    'contact_no',
                    'email',
                    'place',
                        [
                        'attribute' => 'designation',
                        'value' => function($model, $key, $index, $column) {
                                return $model->designation($model->designation);
                        },
                    ],
                        [
                        'attribute' => 'branch_id',
                        'value' => function($data) {
                                return Branch::findOne($data->branch_id)->branch_name;
                        },
                    ],
                        ['class' => 'yii\grid\ActionColumn',
                        'template' => '{view}{update}{followup}{delete}',
                        'visibleButtons' => [
                            'delete' => function ($model, $key, $index) {
                                    return Yii::$app->user->identity->post_id != '1' ? false : true;
                            }
                        ],
                        'buttons' => [
                            'followup' => function ($url, $model) {

                                    $url = Yii::$app->homeUrl . 'followup/followups/followups?type_id=' . $model->id . '&type=4';
                                    return Html::a(
                                                    '<span><i class="fa fa-tasks" aria-hidden="true"></i></span>', $url, [
                                                'data-pjax' => '0',
                                                'id' => $model->id,
                                                'title' => 'Add Followups',
                                                'target' => '_blank',
                                                    ]
                                    );
                            },
                        ],
                    ],
                ];
        }

}
