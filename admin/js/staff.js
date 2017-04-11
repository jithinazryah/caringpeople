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



        var scntDiv = $('#p_scents');
        var i = $('#p_scents span').size() + 1;

        $('#addScnt').on('click', function () {
                var ver = '<span>\n\
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
                                <a id="remScnt" class="btn btn-icon btn-red remScnt" style="margin-top: 15px;"><i class="fa-remove"></i></a>\n\
<div style="claer:both"></div><br/>\n\
                                </span><br/>';
                $(ver).appendTo(scntDiv);
                i++;
                return false;
        });
        $('#p_scents').on('click', '.remScnt', function () {
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
