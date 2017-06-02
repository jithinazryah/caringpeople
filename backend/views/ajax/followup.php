
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Followups;
use common\models\FollowupType;
use common\models\Hospital;
use common\models\FollowupSubType;
use common\models\StaffInfo;
use kartik\datetime\DateTimePicker;

$cnt = $count + 1;
$rand = rand();
$todays_date = date('d-M-Y h:i');
//---------Followup types from db
$followup_type = FollowupType::find()->all();
$types = Html::dropDownList('create[typed][]', null, ArrayHelper::map($followup_type, 'id', 'type'), ['class' => 'form-control followup_type', 'prompt' => '--Select--', 'id' => $rand, 'required' => "required"]);

//--------Followup subtype from table
$followup_subtype = FollowupSubType::find()->where(['type_id' => $type, 'status' => '1'])->all();
$options = Html::dropDownList('create[sub_type][]', null, ArrayHelper::map($followup_subtype, 'id', 'sub_type'), ['class' => 'form-control followup_subtype', 'id' => 'sub_' . $rand, 'prompt' => '--Select--']);

//-------If parameter type is null show type dropdown option (Add Tasks)
if ($type == 'NULL') {
        $followtype = "<div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                              <div class='form-group field-followups-sub_type'>
                                                 <label class='control-label'> Type</label>
                                                 $types
                                              </div>
                                          </div>";
} else {
        $followtype = '';
}

//----------------If followup type = service, assigned to as->the staffs,manager,patient invovled in that particular service, else assigned->to,show staffs expect those who have post as staff
if ($type != 5) {

        $all_users = StaffInfo::find()->where(['<>', 'post_id', '5'])->orderBy(['staff_name' => SORT_ASC])->all();
        $assigned_to = Html::dropDownList('create[assigned_to][]', null, ArrayHelper::map($all_users, 'id', 'namepost'), ['class' => 'form-control create-assignedto', 'prompt' => '--Select--', 'id' => 'create-assignedto_' . $cnt]);
} else {

        $service = \common\models\Service::find()->where(['id' => $type_id])->one();
        $data = Yii::$app->SetValues->Assigned($service);
        $assigned_to = Html::dropDownList('create[assigned_to][]', null, $data, ['class' => 'form-control create-assignedto', 'prompt' => '--Select--', 'required' => "required", 'id' => 'create-assignedto_' . $cnt]);
}
//---------------Followup assigned from->current user;
$userid = Yii::$app->user->identity->id;
$user = StaffInfo::findOne($userid);
//---------------Related staffa-all staffs
$related_staff = Yii::$app->SetValues->Relatedstaffs($type, $type_id);

$related_staff_data = Html::dropDownList('create[related_staffs][' . $count . '][]', null, $related_staff, ['class' => 'form-control ', 'prompt' => '--Select--', 'id' => 'create-related_staffs_' . $count, 'multiple' => 'multiple']);



//-----------------data to append
$datas = "<span>
                                <hr style='border-top: 1px solid #979898 !important;'>
                                <input type='hidden' name='create[type][]' value='" . $type . "'>
                                <input type='hidden' name='create[type_id][]' value='" . $type_id . "'>
                                        $followtype

                                       <div class = 'col-md-4 col-sm-6 col-xs-12 left_padd'>
                                             <div class = 'form-group field-followups-sub_type'>
                                                <label class = 'control-label'>Sub Type</label>
                                                  $options
                                            </div>
                                        </div>

                                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                            <div class='form-group field-followups-followup_date'>
                                               <label class='control-label followup_date' for='followups-followup_date'>Followup Date</label>
                                                <input type='datetime-local' class='form-control some_class' name='create[followup_date][]' data-mask='datetime'>
                                            </div>
                                        </div>

                                         <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                              <div class='form-group field-followups-assigned_to'>
                                                 <label class='control-label'>Assigned To</label>
                                                 $assigned_to
                                              </div>
                                          </div>

                                         <input type='hidden' name='create[assigned_to_type][]' id='assigned_to_type_$cnt' value=''>

                                           <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                              <div class='form-group field-followups-related_staffs'>
                                                 <label class='control-label'>Related Staffs</label>
                                                 $related_staff_data
                                              </div>
                                          </div>

                                         <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                            <div class='form-group field-followups-followup_notes'>
                                               <label class='control-label' for='followups-followup_notes'>Followup Notes</label>
                                                 <textarea class='form-control' name='create[followup_notes][]'></textarea>
                                            </div>
                                        </div>

                                          <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                            <div class='form-group field-followups-assigned_from'>
                                               <label class='control-label' for='followups-assigned_from'>Assigned From</label>
                                                 <input type='text' class='form-control' name='create[assigned_from][]' value='.$user->staff_name' readonly='readonly'>
                                            </div>
                                        </div>

                                       <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                            <div class='form-group field-followups-followup_notes'>
                                               <label class='control-label' for='followups-followup_notes'>Attachments</label>
                                                 <input type = 'file' name = 'create[image][]' />
                                            </div>
                                        </div>

                                          <a id='remFollowup' class='btn btn-icon btn-red remFollowup' title='Delete' style='margin-top: 15px;'><i class='fa-remove'></i></a>
                                          <div style='clear:both'></div>


                                  </span>";
echo $datas;
?>


