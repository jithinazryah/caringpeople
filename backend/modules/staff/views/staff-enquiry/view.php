<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\StaffEnquiry */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Staff Enquiries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                        </div>
                        <div class="panel-body">
                                <?= Html::a('<i class="fa-th-list"></i><span> Manage Staff Enquiry</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                <div class="panel-body"><div class="staff-enquiry-view">
                                                <p>
                                                        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

                                                </p>

                                                <?=
                                                DetailView::widget([
                                                    'model' => $model,
                                                    'attributes' => [
                                                        'name',
                                                            [
                                                            'attribute' => 'gender',
                                                            'value' => function($model) {
                                                                    if ($model->gender == '0') {
                                                                            return 'Male';
                                                                    } else if ($model->gender == '1') {
                                                                            return 'Female';
                                                                    }
                                                            }
                                                        ],
                                                            [
                                                            'attribute' => 'dob',
                                                            'value' => function($model) {
//                                                                    return Yii::$app->formatter->asDate($model->dob);
                                                                    if (isset($model->dob) && $model->dob != '0000-00-00') {
                                                                            $datee = date('d-m-Y', strtotime($model->dob));
                                                                            $age = date_diff(date_create($datee), date_create('today'))->y;
                                                                            if (isset($age))
                                                                                    return \Yii::$app->formatter->asDatetime($model->dob, "php:d-m-Y") . ' (' . $age . ')';
                                                                            else
                                                                                    return \Yii::$app->formatter->asDatetime($model->dob, "php:d-m-Y");
                                                                    }
                                                            }
                                                        ],
                                                        'phone_number',
                                                        'email:email',
                                                        'address',
                                                            [
                                                            'attribute' => 'designation',
                                                            'value' => function($model) {
                                                                    if ($model->designation == '1') {
                                                                            return 'Registered Nurse';
                                                                    } else if ($model->designation == '2') {
                                                                            return 'Care Assistant';
                                                                    } else if ($model->designation == '3') {
                                                                            return 'Doctor visit at home';
                                                                    } else if ($model->designation == '4') {
                                                                            return 'OP Clinic';
                                                                    } else if ($model->designation == '5') {
                                                                            return 'DV + OP';
                                                                    } else if ($model->designation == '6') {
                                                                            return 'Physio';
                                                                    } else if ($model->designation == '7') {
                                                                            return 'Psychologist';
                                                                    } else if ($model->designation == '8') {
                                                                            return 'Dietician';
                                                                    } else if ($model->designation == '9') {
                                                                            return 'Receptionist';
                                                                    } else if ($model->designation == '10') {
                                                                            return 'Office Staff';
                                                                    } else if ($model->designation == '11') {
                                                                            return 'Accountant';
                                                                    } else if ($model->designation == '12') {
                                                                            return 'Nurse Manager';
                                                                    }
                                                            }
                                                        ],
                                                        // 'follow_up_date',
                                                        'notes:ntext',
                                                        'education.sslc_institution',
                                                        'education.sslc_year_of_passing',
                                                        'education.sslc_place',
                                                        'education.hse_institution',
                                                        'education.hse_year_of_passing',
                                                        'education.hse_place',
                                                        'education.nursing_institution',
                                                        'education.nursing_year_of_passing',
                                                        'education.nursing_place',
                                                        'interviewfirst.police_station_name',
                                                        'interviewfirst.panchayat',
                                                        'interviewfirst.muncipality_corporation',
                                                        'interviewfirst.mentioned_per_day_salary',
                                                            [
                                                            'label' => 'Languages known',
                                                            'attribute' => 'interviewfirst.language_1',
                                                            'value' => function($model) {
                                                                    $lang = $model->language($model->interviewfirst->language_1);
                                                                    $lang2 = $model->language($model->interviewfirst->language_2);
                                                                    $lang3 = $model->language($model->interviewfirst->language_3);
                                                                    $lang4 = $model->language($model->interviewfirst->language_4);
                                                                    return $lang . "," . $lang2 . "," . $lang3 . "," . $lang4;
                                                            }
                                                        ],
                                                        'interviewfirst.family_name',
                                                            [
                                                            'attribute' => 'interviewfirst.relation',
                                                            'value' => function($model) {
                                                                    if ($model->interviewfirst->relation == '1') {
                                                                            return 'Father';
                                                                    } else if ($model->interviewfirst->relation == '2') {
                                                                            return 'Mother';
                                                                    } else if ($model->interviewfirst->relation == '3') {
                                                                            return 'Spouse';
                                                                    } else if ($model->interviewfirst->relation == '4') {
                                                                            return 'Brother';
                                                                    } else if ($model->interviewfirst->relation == '5') {
                                                                            return 'Sister';
                                                                    } else if ($model->interviewfirst->relation == '6') {
                                                                            return 'Neighbour';
                                                                    }
                                                            }
                                                        ],
                                                        'interviewfirst.job',
                                                        'interviewfirst.mobile_no',
                                                        'otherinfo.emergency_contact_name',
                                                        'otherinfo.relationship',
                                                        'otherinfo.phone',
                                                        'otherinfo.mobile',
                                                        'otherinfo.alt_emergency_contact_name',
                                                        'otherinfo.alt_relationship',
                                                        'otherinfo.alt_phone',
                                                        'otherinfo.alt_mobile',
                                                        'interviewsecond.contact_verified_by',
                                                        'interviewsecond.contact_verified_date',
                                                        'interviewsecond.contact_verified_note',
                                                        'interviewsecond.alt_contact_verified_by',
                                                        'interviewsecond.alt_contact_verified_date',
                                                        'interviewsecond.alt_contact_verified_note',
                                                        'interviewsecond.verified_name_1',
                                                        'interviewsecond.verified_designation_1',
                                                        'interviewsecond.verified_date_1',
                                                        'interviewsecond.verified_mobile_no_1',
                                                        'interviewthird.bank_ac_no',
                                                        'interviewthird.bank_ac_hodername',
                                                        'interviewthird.bank_name',
                                                        'interviewthird.bank_branch',
                                                        'interviewthird.bank_ifsc',
                                                            [
                                                            'attribute' => 'interviewthird.staff_experience',
                                                            'value' => function($model) {
                                                                    return $model->staffexperience($model->interviewthird->staff_experience);
                                                            }
                                                        ],
                                                        'interviewthird.document_required',
                                                        'interviewthird.document_received',
                                                            [
                                                            'attribute' => 'interviewthird.form_filled',
                                                            'value' => function($model) {
                                                                    if ($model->interviewthird->form_filled == '0') {
                                                                            return 'No';
                                                                    } else if ($model->interviewthird->form_filled == '1') {
                                                                            return 'Yes';
                                                                    }
                                                            }
                                                        ],
                                                            [
                                                            'attribute' => 'interviewthird.interest_level',
                                                            'value' => function($model) {
                                                                    if ($model->interviewthird->interest_level == '1') {
                                                                            return 'High';
                                                                    } else if ($model->interviewthird->interest_level == '2') {
                                                                            return 'No Interest';
                                                                    } else if ($model->interviewthird->interest_level == '3') {
                                                                            return 'Medium';
                                                                    }
                                                            }
                                                        ],
                                                        'interviewthird.expected_date_of_joining',
                                                        'interviewthird.interview_notes',
                                                        'interviewthird.interviewed_by',
                                                        'interviewthird.interviewed_date',
                                                            [
                                                            'attribute' => 'status',
                                                            'value' => $model->status == 1 ? 'Enabled' : 'Disabled',
                                                        ],
                                                    ],
                                                ])
                                                ?>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>


