/*
 * Created by   :- Manu K O
 * Created date :- 03-03-2017
 * purpose      :- To add common javascript
 */

$("document").ready(function () {

        /*
         -----------------ENQUIRY FORM--------------
         */

        $('#service_required_others').hide();
        $('#whatsapp_number').hide();
        $('#whatsapp_note').hide();

        $("#enquiry-contacted_source").change(function () {
                var contact_source = $("#enquiry-contacted_source option:selected").val();
                if (contact_source == 0) {
                        $("label[for = enquiry-incoming_missed]").text("Incoming Number");
                } else if (contact_source == 1) {
                        $("label[for = enquiry-incoming_missed]").text("Incoming Email Id");
                } else {
                        $("label[for = enquiry-incoming_missed]").text("Contact Source Others");
                }
        });

        $relationship = $("#enquiry-relationship option:selected").val();
        if ($relationship === '3') {
                $('#service_required_others').show();
        } else {
                $('#service_required_others').hide();
        }

        $("#enquiry-relationship").change(function () {
                if ($("#enquiry-relationship option:selected").val() === '3')
                        $('#service_required_others').show();
                else
                        $('#service_required_others').hide();
        });


        $whatsapp_number = $("#enquiry-whatsapp_reply option:selected").val();
        if ($whatsapp_number === '1') {
                $('#whatsapp_number').show();
                $('#whatsapp_note').hide();
        } else if ($whatsapp_number === '0') {
                $('#whatsapp_number').hide();
                $('#whatsapp_note').show();
        }



        $("#enquiry-whatsapp_reply").change(function () {
                if ($("#enquiry-whatsapp_reply option:selected").val() === '1') {
                        $('#whatsapp_number').show();
                        $('#whatsapp_note').hide();
                } else if ($("#enquiry-whatsapp_reply option:selected").val() === '0') {
                        $('#whatsapp_number').hide();
                        $('#whatsapp_note').show();
                }
        });



        /*outgoing number from other show/hide on update */
        if ($("#enquiry-outgoing_number_from option:selected").val() === '1')
                $('#outgoing_number_from_other').show();
        else
                $('#outgoing_number_from_other').hide();

        /*outgoing number from other show/hide on create */
        $("#enquiry-outgoing_number_from").change(function () {
                if ($("#enquiry-outgoing_number_from option:selected").val() === '1')
                        $('#outgoing_number_from_other').show();
                else
                        $('#outgoing_number_from_other').hide();
        });
        $('#checkbox_id').on('change', function (e) {
                if (this.checked) {
                        var address = $("#enquiry-address").val();
                        var city = $("#enquiry-city").val();
                        var postal_code = $("#enquiry-zip_pc").val();
                        $("#enquiry-person_address").val(address);
                        $("#enquiry-person_city").val(city);
                        $("#enquiry-person_postal_code").val(postal_code);
                }
                if (!this.checked) {
                        $("#enquiry-person_address").val('');
                        $("#enquiry-person_city").val('');
                        $("#enquiry-person_postal_code").val('');
                }
        });


        /*
         -----------------ENQUIRY FORM----------------------------
         */


        /*
         -----------------ENQUIRY HOSPITAL INFO FORM--------------
         */


        $('#diabetic_note').hide();
        $('#required_other_service').hide();


        /* Diabetic note show/hide on diabetic change*/

        $("#enquiryhospital-diabetic").change(function () {
                if ($(this).val() === '1')
                        $('#diabetic_note').show();
                else
                        $('#diabetic_note').hide();
        });

        /* Diabetic note on update*/
        if ($('#enquiryhospital-diabetic').val() === '1')
                $('#diabetic_note').show();
        else
                $('#diabetic_note').hide();


        /* Other service note show/hide on selecting other service from required service*/
        $("#enquiryhospital-required_service").change(function () {
                var required_service = $(this).val();
                if (jQuery.inArray("7", required_service) !== -1)
                        $('#required_other_service').show();
                else
                        $('#required_other_service').hide();


        });
        /* Other service note show/hide on update */
        var required_service = $("#enquiryhospital-required_service").val();
        if (jQuery.inArray("7", required_service) !== -1)
                $('#required_other_service').show();
        else
                $('#required_other_service').hide();


        /*
         -----------------ENQUIRY HOSPITAL INFO FORM--------------
         */


        /*
         -----------------ENQUIRY OTHER INFO FORM--------------
         */


        /* difficulty in movement others field show/hide on update*/
        $difficulty_in_movement = $("#enquiryotherinfo-difficulty_in_movement").val();
        if ($difficulty_in_movement === '5') {
                $('#difficulty_in_movement_other').show();
        } else {
                $('#difficulty_in_movement_other').hide();
        }

        /* difficulty in movement others field show/hide on create*/
        $('#enquiryotherinfo-difficulty_in_movement').change(function () {
                if ($(this).val() === '5') {
                        $('#difficulty_in_movement_other').show();
                } else {
                        $('#difficulty_in_movement_other').hide();

                }
        });
        /* service required other others field show/hide on update*/
        $service_required = $("#enquiryotherinfo-service_required").val();
        if ($service_required === '5') {
                $('#service_required').show();
        } else {
                $('#service_required').hide();
        }
        /* service required other others field show/hide on create*/
        $('#enquiryotherinfo-service_required').change(function () {
                if ($(this).val() === '5') {
                        $('#service_required').show();
                } else {
                        $('#service_required').hide();
                }
        });
        /*care currently provided service required other others field show/hide on update*/
        if ($('#enquiryotherinfo-care_currently_provided').val() === '4')
                $('#care_currently_provided_others').show();
        else
                $('#care_currently_provided_others').hide();


        /*care currently provided other others field show/hide on cretae*/
        $('#enquiryotherinfo-care_currently_provided').change(function () {
                if ($(this).val() === '4') {
                        $('#care_currently_provided_others').show();
                } else {
                        $('#care_currently_provided_others').hide();
                }
        });

        /*care currently provided service required expected datre of dischargede on update*/
        if ($('#enquiryotherinfo-care_currently_provided').val() === '3')
                $('#date_of_discharge').show();
        else
                $('#date_of_discharge').hide();


        /*care currently provided service required expected datre of dischargede on create*/
        $('#enquiryotherinfo-care_currently_provided').change(function () {
                if ($(this).val() === '3') {
                        $('#date_of_discharge').show();
                } else {
                        $('#date_of_discharge').hide();

                }
        });


        /*
         -----------------ENQUIRY OTHER INFO FORM--------------
         */


});
