/*
 * Created by   :- Sabitha
 * Created date :- 22-03-2017
 */

$("document").ready(function () {

        /* if permanent address and present address is same */
        $('#checkbox_id').on('change', function (e) {
                if (this.checked) {
                        var address = $("#staffinfo-permanent_address").val();
                        var pincode = $("#staffinfo-pincode").val();
                        var contact_no = $("#staffinfo-contact_no").val();
                        var email = $("#staffinfo-email").val();
                        $("#staffinfo-present_address").val(address);
                        $("#staffinfo-present_pincode").val(pincode);
                        $("#staffinfo-present_contact_no").val(contact_no);
                        $("#staffinfo-present_email").val(email);
                }

        });



        $('#staffenquiry-agreement_copy').change(function () {
                if ($('#staffenquiry-agreement_copy').val() == '4')
                        $('#agreement_copy_other').show();
                else
                        $('#agreement_copy_other').hide();

        });



        if ($('#staffenquiry-agreement_copy').val() == '4')
                $('#agreement_copy_other').show();
        else
                $('#agreement_copy_other').hide();



        var scntDivs = $('#p_scents');
        var j = $('#p_scents span').size() + 1;

        $('#addScnt').on('click', function () {
                var vers = '<span>\n\
                                <hr style="border-top: 1px solid #979898 !important;">\n\
                                <div class="col-md-4 col-sm-6 col-xs-12 left_padd">\n\
                                <div class="form-group field-staffperviousemployer-hospital_address">\n\
                                <label class="control-label">Hospital Address</label>\n\
                                <input type="text" id="" class="form-control" name="create[hospitaladdress][]" required>\n\
                                </div> \n\
                                </div> \n\
                                <div class="col-md-4 col-sm-6 col-xs-12 left_padd">\n\
                                <div class="form-group field-staffperviousemployer-designation">\n\
                                <label class="control-label" for="">Designation</label>\n\
                                <input type="text" class="form-control" name="create[designation][]" required>\n\
                                </div> \n\
                                </div> \n\
                                <div class="col-md-4 col-sm-6 col-xs-12 left_padd">\n\
                                <div class="form-group field-staffperviousemployer-length_of_service">\n\
                                <label class="control-label" >Length of service</label>\n\
                                <input type="text" id="" class="form-control" name="create[length][]" required>\n\
                                </div>\n\
                                </div> \n\
                                <div class="col-md-4 col-sm-6 col-xs-12 left_padd">\n\
                                <div class="form-group field-staffperviousemployer-service_from">\n\
                                <label class="control-label" >From</label>\n\
                                <input type="date" id="" class="form-control" name="create[from][]" required>\n\
                                </div>\n\
                                </div> \n\
                                <div class="col-md-4 col-sm-6 col-xs-12 left_padd">\n\
                                <div class="form-group field-staffperviousemployer-service_to">\n\
                                <label class="control-label" >To</label>\n\
                                <input type="date" id="" class="form-control" name="create[to][]" required>\n\
                                </div>\n\
                                </div> \n\
                                <div class="col-md-3 col-sm-6 col-xs-12 left_padd">\n\
                                <div class="form-group field-staffperviousemployer-salary">\n\
                                <label class="control-label" >Salary</label>\n\
                                <input type="text" id="" class="form-control" name="create[salary][]" required>\n\
                                </div>\n\
                                </div> \n\
                                <a id="remScnt" class="btn btn-icon btn-red remScnt" style="margin-top: 15px;"><i class="fa-remove"></i></a>\n\
<div style="claer:both"></div><br/>\n\
                                </span><br/>';
                $(vers).appendTo(scntDivs);
                j++;
                return false;
        });
        $('#p_scents').on('click', '.remScnt', function () {
                if (j > 2) {
                        $(this).parents('span').remove();
                        j--;
                }
                if (this.hasAttribute("val")) {
                        var valu = $(this).attr('val');
                        $('#delete_port_vals').val($('#delete_port_vals').val() + valu + ',');
                        var value = $('#delete_port_vals').val();
                }
                return false;
        });


        $('.img-remove').on('click', function (e) {

                var data = $(this).attr('id');
                var datas = data.split("-");

                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {id: datas[0], name: datas[1], type: datas[2]},
                        url: homeUrl + 'ajax/remove',
                        success: function (data) {

                                $('#' + datas[2]).remove();
                        }
                });
        });

        $('.staff-enq-img-remove').on('click', function (e) {
                var data = $(this).attr('id');
                var datas = data.split("-");
                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {id: datas[0], name: datas[1]},
                        url: homeUrl + 'ajax/staffenqremove',
                        success: function (data) {
                                $('#' + datas[2]).remove();
                        }
                });
        });

        $('.img-removes').on('click', function (e) {
                var data = $(this).attr('id');
                var datas = data.split("-");

                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {id: datas[0], name: datas[1], type: datas[2]},
                        url: homeUrl + 'ajax/patientremove',
                        success: function (data) {
                                $('#' + datas[2]).remove();
                        }
                });
        });

        $('.terms').on('click', function () {
                var id = $(this).attr('id');
                showAjaxModal(id);

        });





        var scntDiv = $('#p_attach');
        var i = $('#p_attach span').size() + 1;

        $('#addAttach').on('click', function () {
                var ver = '<span>\n\
                                <div class="col-md-2 col-sm-6 col-xs-12 left_padd">\n\
                                <div class="form-group field-staffperviousemployer-hospital_address">\n\
                                <label class="control-label">Attachment</label>\n\
                                <input type="file"  name="creates[file][]">\n\
                                </div> \n\
                                </div> \n\
                                <div class="col-md-2 col-sm-6 col-xs-12 left_padd">\n\
                                <div class="form-group field-staffperviousemployer-salary">\n\
                                <label class="control-label" >Attachment Name</label>\n\
                                <input type="text" class="form-control" name="creates[file_name][]">\n\
                                </div>\n\
                                </div> \n\
                                <a id="remAttach" class="btn btn-icon btn-red remAttach" style="margin-top: 15px;"><i class="fa-remove"></i></a>\n\
                                <div style="claer:both"></div><br/>\n\
                                </span><br/>';
                $(ver).appendTo(scntDiv);
                i++;
                return false;
        });
        $('#p_attach').on('click', '.remAttach', function () {
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






        var staff_family = $('#staff_family');
        var k = $('#staff_family span').size() + 1;

        $('#add_Staff_family').on('click', function () {
                var ver_family = '<span>\n\
                                <div class="col-md-3 col-sm-6 col-xs-12 left_padd">\n\
                                     <div class="form-group field-staffenquiryinterviewfirst-family_name">\n\
                                        <label class="control-label">Name</label>\n\
                                        <input type="text" class="form-control" name="createfamily[name][]">\n\
                                     </div> \n\
                                </div> \n\
                                <div class="col-md-3 col-sm-6 col-xs-12 left_padd">\n\
                                     <div class="form-group field-staffenquiryinterviewfirst-relation">\n\
                                        <label class="control-label">Relationship</label>\n\
                                        <select name="createfamily[relationship][]" id="family_relationships" class="form-control">\n\
                                             <option value="Father">--Select--</option>\n\
                                             <option value="Father">Father</option>\n\
                                             <option value="Mother">Mother</option>\n\
                                             <option value="Spouse">Spouse</option>\n\
                                             <option value="Brother">Brother</option>\n\
                                             <option value="Sister">Sister</option>\n\
                                        </select>\n\
                                     </div> \n\
                                </div> \n\
                                <div class="col-md-3 col-sm-6 col-xs-12 left_padd">\n\
                                     <div class="form-group field-staffenquiryinterviewfirst-job">\n\
                                        <label class="control-label">Job</label>\n\
                                        <input type="text" class="form-control" name="createfamily[job][]">\n\
                                     </div> \n\
                                </div> \n\
                                <div class="col-md-2 col-sm-6 col-xs-12 left_padd">\n\
                                     <div class="form-group field-staffenquiryinterviewfirst-mobile_no">\n\
                                        <label class="control-label">Mobile No</label>\n\
                                        <input type="text" class="form-control" name="createfamily[mobile_no][]">\n\
                                     </div> \n\
                                </div> \n\
                                <div class="col-md-1 col-sm-6 col-xs-12 left_padd">\n\
                                       <a id="remFamily" class="btn btn-icon btn-red remFamily" style="margin-top: 15px;"><i class="fa-remove"></i></a>\n\
                                </div>\
                                <div style="claer:both"></div><br/>\n\
                                </span><br/>';
                ;
                $(ver_family).appendTo(staff_family);
                k++;
                return false;
        });

        $('#staff_family').on('click', '.remFamily', function () {

                if (k > 2) {
                        $(this).parents('span').remove();
                        k--;
                }
                if (this.hasAttribute("val")) {
                        var valu = $(this).attr('val');
                        $('#delete_port_vals_family').val($('#delete_port_vals_family').val() + valu + ',');
                        var value = $('#delete_port_vals_family').val();
                }
                return false;
        });

});
function showAjaxModal(id)
{
        jQuery('#modal-7').modal('show', {backdrop: 'static'});

        setTimeout(function ()
        {
                jQuery.ajax({
                        type: 'POST',
                        url: homeUrl + "ajax/content",
                        data: {id: id},
                        success: function (response)
                        {
                                jQuery('#modal-7 .modal-body').html(response);
                        }
                });
        }, 800); // just an example
}

