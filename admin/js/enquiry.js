/*
 * Created by   :- Manu K O
 * Created date :- 03-03-2017
 * purpose      :- To add common javascript
 */

$("document").ready(function () {

        /*
         -----------------PATIENT ENQUIRY GENERAL INFO FORM--------------
         */
        $('#referral_source_others').hide();
        $('#whatsapp_number').hide();
        $('#whatsapp_note').hide();
        $('#required_other_service').hide();
        $('#service_required').hide();



        /*
         *Change the label of incoming and missed field
         */
        $("#patientenquirygeneralfirst-contacted_source").change(function () {
                var contact_source = $("#patientenquirygeneralfirst-contacted_source option:selected").val();
                if (contact_source == 0) {
                        $("label[for = patientenquirygeneralfirst-incoming_missed]").text("Incoming Number");
                } else if (contact_source == 1) {
                        $("label[for = patientenquirygeneralfirst-incoming_missed]").text("Incoming Email Id");
                        $('#patientenquirygeneralfirst-incoming_missed').replaceWith($('<input/>', {'type': 'text', 'name': 'Other', 'class': 'form-control'}));
                } else {
                        $("label[for = patientenquirygeneralfirst-incoming_missed]").text("Contact Source Others");
                }
        });


        /*
         * Incoming number from other show/hide on update
         */

        if ($("#patientenquirygeneralfirst-incoming_missed option:selected").val() === 'Other')
                $('#incoming_missed_other').show();
        else
                $('#incoming_missed_other').hide();


        /*
         * Incoming number from other show/hide on create
         */

        $("#patientenquirygeneralfirst-incoming_missed").change(function () {
                if ($("#patientenquirygeneralfirst-incoming_missed option:selected").val() === 'Other')
                        $('#incoming_missed_other').show();
                else
                        $('#incoming_missed_other').hide();
        });


        /*
         * outgoing number from other show/hide on update
         */

        if ($("#patientenquirygeneralfirst-outgoing_number_from option:selected").val() === '1')
                $('#outgoing_number_from_other').show();
        else
                $('#outgoing_number_from_other').hide();


        /*
         * outgoing number from other show/hide on create
         */

        $("#patientenquirygeneralfirst-outgoing_number_from").change(function () {
                if ($("#patientenquirygeneralfirst-outgoing_number_from option:selected").val() === '1')
                        $('#outgoing_number_from_other').show();
                else
                        $('#outgoing_number_from_other').hide();
        });


        /*
         *  If referal source field value is other show referal source others field
         */

        $("#patientenquirygeneralfirst-referral_source").change(function () {
                if ($("#patientenquirygeneralfirst-referral_source option:selected").val() === '5')
                        $('#referral_source_others').show();
                else
                        $('#referral_source_others').hide();

        });

        /*
         *  If referal source field value is other show referal source others field on update
         */
        $referal_source = $("#patientenquirygeneralfirst-referral_source option:selected").val();
        if ($referal_source === '5') {
                $('#referral_source_others').show();
        } else {
                $('#referral_source_others').hide();
        }

        /*
         *  If whatsapp_reply field value is yes show whatsapp_number field or if no show note field
         */

        $("#patientenquirygeneralsecond-whatsapp_reply").change(function () {
                if ($("#patientenquirygeneralsecond-whatsapp_reply option:selected").val() === '1') {
                        $('#whatsapp_number').show();
                        $('#whatsapp_note').hide();
                } else if ($("#patientenquirygeneralsecond-whatsapp_reply option:selected").val() === '0') {
                        $('#whatsapp_number').hide();
                        $('#whatsapp_note').show();
                }
        });

        /*
         *  If whatsapp_reply field value is yes show whatsapp_number field or if no show note field on update
         */

        $whatsapp_number = $("#patientenquirygeneralsecond-whatsapp_reply option:selected").val();
        if ($whatsapp_number === '1') {
                $('#whatsapp_number').show();
                $('#whatsapp_note').hide();
        } else if ($whatsapp_number === '0') {
                $('#whatsapp_number').hide();
                $('#whatsapp_note').show();
        }


        /* Other service note show/hide on selecting other service from required service*/
        $("#patientenquirygeneralsecond-required_service").change(function () {
                var required_service = $(this).val();
                if (jQuery.inArray("8", required_service) !== -1)
                        $('#required_other_service').show();
                else
                        $('#required_other_service').hide();


        });
        /* Other service note show/hide on update */
        var required_service = $("#patientenquirygeneralsecond-required_service").val();
        if (jQuery.inArray("8", required_service) !== -1)
                $('#required_other_service').show();
        else
                $('#required_other_service').hide();

        /*
         * service required other others field show/hide on update
         */

        $service_required = $("#patientenquirygeneralsecond-service_required").val();
        if ($service_required === '5') {
                $('#service_required').show();
        } else {
                $('#service_required').hide();
        }
        /*
         * service required other others field show/hide on create
         */

        $('#patientenquirygeneralsecond-service_required').change(function () {
                if ($(this).val() === '5') {
                        $('#service_required').show();
                } else {
                        $('#service_required').hide();
                }
        });




        $('#checkbox_id').on('change', function (e) {
                if (this.checked) {
                        var address = $("#patientenquirygeneralsecond-address").val();
                        var city = $("#patientenquirygeneralsecond-city").val();
                        var postal_code = $("#patientenquirygeneralsecond-zip_pc").val();
                        $("#patientenquiryhospitalfirst-person_address").val(address);
                        $("#patientenquiryhospitalfirst-person_city").val(city);
                        $("#patientenquiryhospitalfirst-person_postal_code").val(postal_code);
                }
                if (!this.checked) {
                        $("#patientenquiryhospitalfirst-person_address").val('');
                        $("#patientenquiryhospitalfirst-person_city").val('');
                        $("#patientenquiryhospitalfirst-person_postal_code").val('');
                }
        });






        /*
         -----------------PATIENT ENQUIRY GENERAL INFO FORM----------------------------
         */







        /*
         -----------------ENQUIRY HOSPITAL INFO FORM--------------
         */


        $('#diabetic_note').hide();
        $('#relationship_others').hide();


        /*
         *  Relationship show/hide on update
         */

        $relationship = $("#patientenquiryhospitalfirst-relationship option:selected").val();
        if ($relationship === '3') {
                $('#relationship_others').show();
        } else {
                $('#relationship_others').hide();
        }

        /*
         *  Relationship show/hide
         */

        $("#patientenquiryhospitalfirst-relationship").change(function () {
                if ($("#patientenquiryhospitalfirst-relationship option:selected").val() === '3')
                        $('#relationship_others').show();
                else
                        $('#relationship_others').hide();
        });



        /*
         * Diabetic note show/hide on diabetic change
         */

        $("#patientenquiryhospitalsecond-diabetic").change(function () {
                if ($(this).val() === '1')
                        $('#diabetic_note').show();
                else
                        $('#diabetic_note').hide();
        });

        /*
         * Diabetic note on update
         */

        if ($('#patientenquiryhospitalsecond-diabetic').val() === '1')
                $('#diabetic_note').show();
        else
                $('#diabetic_note').hide();

        /*
         * care currently provided service required other others field show/hide on update
         */

        if ($('#patientenquiryhospitalsecond-care_currently_provided').val() === '4')
                $('#care_currently_provided_others').show();
        else
                $('#care_currently_provided_others').hide();


        /*
         * care currently provided other others field show/hide on cretae
         */

        $('#patientenquiryhospitalsecond-care_currently_provided').change(function () {
                if ($(this).val() === '4') {
                        $('#care_currently_provided_others').show();
                } else {
                        $('#care_currently_provided_others').hide();
                }
        });

        /*
         * difficulty in movement others field show/hide on update
         */

        $difficulty_in_movement = $("#patientenquiryhospitalsecond-difficulty_in_movement").val();
        if ($difficulty_in_movement === '5') {
                $('#difficulty_in_movement_other').show();
        } else {
                $('#difficulty_in_movement_other').hide();
        }

        /*
         * difficulty in movement others field show/hide on create
         */
        $('#patientenquiryhospitalsecond-difficulty_in_movement').change(function () {
                if ($(this).val() === '5') {
                        $('#difficulty_in_movement_other').show();
                } else {
                        $('#difficulty_in_movement_other').hide();

                }
        });

        /*
         * care currently provided service required expected datre of dischargede on update
         */

        if ($('#patientenquiryhospitalsecond-care_currently_provided').val() === '3')
                $('#date_of_discharge').show();
        else
                $('#date_of_discharge').hide();


        /*
         * care currently provided service required expected datre of dischargede on create
         */

        $('#patientenquiryhospitalsecond-care_currently_provided').change(function () {
                if ($(this).val() === '3') {
                        $('#date_of_discharge').show();
                } else {
                        $('#date_of_discharge').hide();

                }
        });


        /*
         -----------------ENQUIRY HOSPITAL INFO FORM--------------
         */


        var scntDiv = $('#p_scents1');
        var i = $('#p_scents1 span').size() + 1;

        $('#addHosp').on('click', function () {

                var id = 1;

                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {id: id},
                        url: homeUrl + 'ajax/patienthospitaldetails',
                        success: function (data) {
                                $(data).appendTo(scntDiv);
                                i++;
                                return false;
                        }
                });

        });

        $('#p_scents1').on('click', '.remScnt', function () {

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

        /*
         * patient module if address same
         */

        $('#address_id').on('change', function (e) {
                if (this.checked) {
                        var address = $("#patientguardiandetails-permanent_address").val();
                        var landmark = $("#patientguardiandetails-landmark").val();
                        var pincode = $("#patientguardiandetails-pincode").val();
                        var contact_number = $("#patientguardiandetails-contact_number").val();
                        var email = $("#patientguardiandetails-email").val();
                        $("#patientgeneral-present_address").val(address);
                        $("#patientgeneral-landmark").val(landmark);
                        $("#patientgeneral-pin_code").val(pincode);
                        $("#patientgeneral-contact_number").val(contact_number);
                        $("#patientgeneral-email").val(email);
                }
                if (!this.checked) {
                        $("#patientgeneral-present_address").val('');
                        $("#patientgeneral-landmark").val('');
                        $("#patientgeneral-pin_code").val('');
                        $("#patientgeneral-contact_number").val('');
                        $("#patientgeneral-email").val('');
                }
        });
});
