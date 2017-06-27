<?php $form = ActiveForm::begin(['id' => 'add-hospital']); ?>


<form action="" id="submit-add-hospital">
        <div class="modal-content">
                <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Add Hospital</h4>
                </div>

                <div class="modal-body">

                        <div class="row">
                                <div class="col-md-6">

                                        <div class="form-group">
                                                <label for="field-2" class="control-label">Hospital Name</label>
                                                <input type="text" class="form-control" id="hospital_name" name="hospital_name">
                                        </div>

                                </div>
                                <div class="col-md-6">

                                        <div class="form-group">
                                                <label for="field-3" class="control-label">Contact Person</label>
                                                <input type="text" class="form-control" id="contact_person" name="contact_person">
                                        </div>

                                </div>
                        </div>

                        <div class="row">
                                <div class="col-md-6">

                                        <div class="form-group">
                                                <label for="field-4" class="control-label">Contact Email</label>
                                                <input type="text" class="form-control" id="contact_email" name="contact_email">
                                        </div>

                                </div>

                                <div class="col-md-6">

                                        <div class="form-group">
                                                <label for="field-5" class="control-label">Contact Number</label>
                                                <input type="text" class="form-control" id="contact_number" name="contact_number">
                                        </div>

                                </div>

                                <div class="col-md-6">

                                        <div class="form-group">
                                                <label for="field-6" class="control-label">Contact Number 2</label>
                                                <input type="text" class="form-control" id="contact_number_2" name="contact_number_2">
                                        </div>

                                </div>

                                <div class="col-md-6">

                                        <div class="form-group">
                                                <label for="field-7" class="control-label">Address</label>
                                                <input type="text" class="form-control" id="address" name="address">
                                        </div>

                                </div>

                        </div>

                </div>
                <input type="hidden" value="<?php // $partner_type  ?>" name="partner_type"/>

                <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal" name="hospital">Close</button>
                        <button type="submit" class="btn btn-info">Save</button>
                </div>
        </div>
</form>