<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PatientPresentMedication */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-present-medication-form form-inline">

        <div class="row">
                <div id="presnt_medication">
                        <input type="hidden" id="delete_port_vals"  name="delete_port_vals" value="">
                        <?php
                        if (!empty($pationt_medication_details)) {

                                foreach ($pationt_medication_details as $data) {
                                        ?>
                                        <span>
                                                <div class="col-md-2 col-sm-6 col-xs-12 left_padd">
                                                        <div class="form-group field-patientpresentmedication-tablet_injection">
                                                                <label class="control-label" for="patientpresentmedication-tablet_injection">Tablet/injection</label>
                                                                <select id="patientpresentmedication-tablet_injection" class="form-control" name="updatee[<?= $data->id; ?>][tablet_injection][]" aria-invalid="false">
                                                                        <option value="">--Select--</option>
                                                                        <option value="0" <?= $data->tablet_injection == 0 ? "selected" : "" ?>>tablet</option>
                                                                        <option value="1" <?= $data->tablet_injection == 1 ? "selected" : "" ?>>injection</option>
                                                                </select>

                                                                <div class="help-block"></div>
                                                        </div>
                                                </div>
                                                <div class="col-md-2 col-sm-6 col-xs-12 left_padd">
                                                        <div class="form-group field-patientpresentmedication-medicine_name">
                                                                <label class="control-label" for="patientpresentmedication-medicine_name">Medicine Name</label>
                                                                <input type="text" id="patientpresentmedication-medicine_name" class="form-control" name="updatee[<?= $data->id; ?>][medicine_name][]" maxlength="100" value="<?= $data->medicine_name; ?>">

                                                                <div class="help-block"></div>
                                                        </div>
                                                </div>
                                                <div class="col-md-2 col-sm-6 col-xs-12 left_padd">
                                                        <div class="form-group field-patientpresentmedication-dosage">
                                                                <label class="control-label" for="patientpresentmedication-dosage">Dosage</label>
                                                                <input type="text" id="patientpresentmedication-dosage" class="form-control" name="updatee[<?= $data->id; ?>][dosage][]" maxlength="100" aria-invalid="false" value="<?= $data->dosage ?>">

                                                                <div class="help-block"></div>
                                                        </div>
                                                </div>
                                                <div class="col-md-2 col-sm-6 col-xs-12 left_padd">
                                                        <div class="form-group field-patientpresentmedication-mode">
                                                                <label class="control-label" for="patientpresentmedication-mode">Mode</label>
                                                                <input type="text" id="patientpresentmedication-mode" class="form-control" name="updatee[<?= $data->id; ?>][mode][]" maxlength="100" value="<?= $data->mode; ?>">

                                                                <div class="help-block"></div>
                                                        </div>
                                                </div>
                                                <div class="col-md-2 col-sm-6 col-xs-12 left_padd">
                                                        <div class="form-group field-patientpresentmedication-since">
                                                                <label class="control-label" for="patientpresentmedication-since">Since</label>
                                                                <textarea id="patientpresentmedication-since" class="form-control" name="updatee[<?= $data->id; ?>][since][]" rows="1" aria-invalid="false"><?= $data->since; ?></textarea>

                                                                <div class="help-block"></div>
                                                        </div>
                                                </div>
                                                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                                        <a id="remScnt" val="<?= $data->id; ?>" class="btn btn-icon btn-red remScnt" ><i class="fa-remove"></i></a>
                                                </div>
                                                <div style="clear:both"></div>
                                        </span>
                                        <br>
                                        <?php
                                }
                        }
                        ?>
                        <span>

                                <div class="col-md-2 col-sm-6 col-xs-12 left_padd">
                                        <div class="form-group field-patientpresentmedication-tablet_injection">
                                                <label class="control-label" for="patientpresentmedication-tablet_injection">Tablet/injection</label>
                                                <select id="patientpresentmedication-tablet_injection" class="form-control" name="create[tablet_injection][]" aria-invalid="false">
                                                        <option value="">--Select--</option>
                                                        <option value="0">tablet</option>
                                                        <option value="1">injection</option>
                                                </select>

                                                <div class="help-block"></div>
                                        </div>
                                </div>
                                <div class="col-md-2 col-sm-6 col-xs-12 left_padd">
                                        <div class="form-group field-patientpresentmedication-medicine_name">
                                                <label class="control-label" for="patientpresentmedication-medicine_name">Medicine Name</label>
                                                <input type="text" id="patientpresentmedication-medicine_name" class="form-control" name="create[medicine_name][]" maxlength="100">

                                                <div class="help-block"></div>
                                        </div>
                                </div>
                                <div class="col-md-2 col-sm-6 col-xs-12 left_padd">
                                        <div class="form-group field-patientpresentmedication-dosage">
                                                <label class="control-label" for="patientpresentmedication-dosage">Dosage</label>
                                                <input type="text" id="patientpresentmedication-dosage" class="form-control" name="create[dosage][]" maxlength="100" aria-invalid="false">

                                                <div class="help-block"></div>
                                        </div>
                                </div>
                                <div class="col-md-2 col-sm-6 col-xs-12 left_padd">
                                        <div class="form-group field-patientpresentmedication-mode">
                                                <label class="control-label" for="patientpresentmedication-mode">Mode</label>
                                                <input type="text" id="patientpresentmedication-mode" class="form-control" name="create[mode][]" maxlength="100">

                                                <div class="help-block"></div>
                                        </div>
                                </div>
                                <div class="col-md-2 col-sm-6 col-xs-12 left_padd">
                                        <div class="form-group field-patientpresentmedication-since">
                                                <label class="control-label" for="patientpresentmedication-since">Since</label>
                                                <textarea id="patientpresentmedication-since" class="form-control" name="create[since][]" rows="1" aria-invalid="false"></textarea>

                                                <div class="help-block"></div>
                                        </div>
                                </div>


                                <div style="clear:both"></div>
                        </span>
                </div>
                <div class="row">
                        <div class="col-md-6"> <a id="addScnt" class="btn btn-icon btn-blue addScnt"><i class="fa-plus"></i>Add More Medication</a></div>
                </div>

        </div>


</div>

<div class='col-md-12 col-sm-6 col-xs-12' >
        <div class="form-group" >
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;', 'id' => 'form_button']) ?>

        </div>
</div>






<script>
        $("document").ready(function () {
        var scntDiv = $('#presnt_medication');
        var i = $('#presnt_medication span').size() + 1;
        $('#addScnt').on('click', function () {
        var ver = '<span>\n\
                                <div class="col-md-2 col-sm-6 col-xs-12 left_padd">\n\
                                <div class="form-group field-patientpresentmedication-tablet_injection">\n\
                                <label class="control-label" for="patientpresentmedication-tablet_injection">Tablet/injection</label>\n\
                                <select id="" class="form-control" name="create[tablet_injection][]" aria-invalid="false">\n\
                                <option value="">--Select--</option>\n\
                                <option value="0">tablet</option>\n\
                                <option value="1">injection</option>\n\\n\
                                </select>\n\
                                </div> \n\
                                </div> \n\
                                <div class="col-md-2 col-sm-6 col-xs-12 left_padd">\n\
                                <div class="form-group field-patientpresentmedication-medicine_name">\n\
                                <label class="control-label" for="patientpresentmedication-medicine_name">Medicine Name</label>\n\
                                <input type="text" id="" class="form-control" name="create[medicine_name][]" maxlength="100">\n\
                                </div> \n\
                                </div> \n\
                                <div class="col-md-2 col-sm-6 col-xs-12 left_padd">\n\
                                <div class="form-group field-patientpresentmedication-dosage">\n\
                                <label class="control-label" for="patientpresentmedication-dosage">Dosage</label>\n\
                                <input type="text" id="" class="form-control" name="create[dosage][]" maxlength="100" aria-invalid="false">\n\
                                </div>\n\
                                </div> \n\
                                <div class="col-md-2 col-sm-6 col-xs-12 left_padd">\n\
                                 <div class="form-group field-patientpresentmedication-mode">\n\
                        <label class="control-label" for="patientpresentmedication-mode">Mode</label>\n\
                        <input type="text" id="" class="form-control" name="create[mode][]" maxlength="100">\n\
                                </div>\n\
                                </div> \n\
                                <div class="col-md-2 col-sm-6 col-xs-12 left_padd">\n\
                               <div class="form-group field-patientpresentmedication-since">\n\
                        <label class="control-label" for="patientpresentmedication-since">Since</label>\n\
                        <textarea id="" class="form-control" name="create[since][]" rows="1" aria-invalid="false"></textarea>\n\
                                </div>\n\
                                </div> \n\
                                <a id="remScnt" class="btn btn-icon btn-red remScnt" style="margin-top: 15px;"><i class="fa-remove"></i></a>\n\
<div style="claer:both"></div><br/>\n\
                                </span><br/>';
        $(ver).appendTo(scntDiv);
        i++;
        return false;
        });
        $('#presnt_medication').on('click', '.remScnt', function () {
        if (i > 2) {
        $(this).parents('span').remove();
        i--;
        }
        if (this.hasAttribute("val")) {
        var valu = $(this).attr('val');
        $('#delete_port_vals').val($('#delete_port_vals').val() + valu + ',');
        var value = $('#delete_port_vals').val();
        }
        return false;
        });
        });
</script>