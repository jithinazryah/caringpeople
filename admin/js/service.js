/*
 * Created by   :- Sabitha
 * Created date :- 22-06-2017
 */



$("document").ready(function () {
        $(function () {
                if (performance.navigation.type == 1) {
                        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                                localStorage.setItem('lastTab', $(this).attr('href'));
                        });

                        var lastTab = localStorage.getItem('lastTab');
                        if (lastTab) {
                                $('[href="' + lastTab + '"]').tab('show');
                        }
                }
        });



        /********************************************************  Service  **********************************************/
        $("#service-patient_id").select2({
                allowClear: true
        }).on('select2-open', function ()
        {
                $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        /*
         * Ratecard service-select2
         */
        $("#ratecard-service_id").select2({
                allowClear: true
        }).on('select2-open', function ()
        {
                $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });
        /*
         * service form-service select 2
         */

        $("#service-service").select2({
                allowClear: true
        }).on('select2-open', function ()
        {
                $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        /*
         * show sub service in ratecard
         */
        $('#ratecard-service_id').change(function () {
                showLoader();
                var branch = $('#ratecard-branch_id').val();
                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {service: $(this).val(), branch: branch},
                        url: homeUrl + 'serviceajax/subservices',
                        success: function (data) {
                                $('#ratecard-sub_service').html(data);
                                hideLoader();
                        }
                });
        });


        /*
         * check this ratecard is already added or not
         */

        $(document).on('submit', '#rate-card', function (e) {
                var action = $('#action').val();

                if (action == '1') {
                        var branch = $('#ratecard-branch_id').val();
                        var service = $('#ratecard-service_id').val();
                        var sub_service = $('#ratecard-sub_service').val();


                        $.ajax({
                                url: homeUrl + 'serviceajax/checkratecard',
                                'async': false,
                                'type': "POST",
                                'global': false,
                                data: {service: service, branch: branch, sub_service: sub_service},
                                beforeSend: function () {
                                        showLoader();
                                }
                        })
                                .done(function (data) {
                                        if (data == 0) {
                                                return true;

                                        } else {
                                                alert('Rate card is already added for this service and sub service');
                                                e.preventDefault();
                                                hideLoader();
                                                return false;
                                        }
                                });
                }
        });

        /*
         * show patients depends on branch
         */
        $('#service-branch_id').change(function () {
                showLoader();
                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {branch: $(this).val()},
                        url: homeUrl + 'ajax/patients',
                        success: function (data) {
                                $("#service-patient_id").html(data);
                                hideLoader();
                        }
                });
        });

        /*
         * show mangers depends on branch
         */
        $('#service-branch_id').change(function () {
                var branch = $('#service-branch_id').val();
                showLoader();
                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {patient: $(this).val(), branch: branch},
                        url: homeUrl + 'ajax/staffmanager',
                        success: function (data) {
                                $("#service-staff_manager").html(data);
                                hideLoader();
                        }
                });
        });

        /*
         * show sub services
         */
        $('#service-service').change(function () {
                showLoader();
                var branch = $('#service-branch_id').val();
                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {service: $(this).val(), branch: branch},
                        url: homeUrl + 'serviceajax/subservices',
                        success: function (data) {
                                $('#service-sub_service').html(data);
                                hideLoader();
                        }
                });
        });


        /*
         * service show duty type
         */
        $('#service-service').change(function () {
                var branch = $('#service-branch_id').val();
                var service = $(this).val();
                $.ajax({
                        url: homeUrl + 'serviceajax/dutytype',
                        type: 'POST',
                        data: {service: $(this).val(), branch: branch},
                        success: function (data) {

                                if (data == '1') {
                                        alert('Please select branch');
                                        $('#service-service').select2('val', '');
                                } else if (data == '2') {
                                        var id_attr = branch + "_" + service + "_";
                                        $('#service-duty_type').empty();
                                        $('.add-rate-card').attr('id', id_attr);
                                        $('.rate-card-error').show();
                                        $('.rate-card-update-error').hide();
                                } else if (data == '3') {
                                        var id_attr = branch + "_" + service + "_";
                                        $('#service-duty_type').empty();
                                        $('.update-rate-card').attr('id', id_attr);
                                        $('.rate-card-update-error').show();
                                        $('.rate-card-error').hide();
                                } else {
                                        $('.rate-card-error').hide();
                                        $('.rate-card-update-error').hide();
                                        $('#service-duty_type').html(data);

                                }
                        }
                });
        });
        /*
         * show duty types of sub service
         */

        $('#service-sub_service').change(function () {
                var branch = $('#service-branch_id').val();
                var service = $('#service-service').val();
                var sub_service = $('#service-sub_service').val();
                $.ajax({
                        url: homeUrl + 'serviceajax/subdutytype',
                        type: 'POST',
                        data: {service: service, branch: branch, sub_service: sub_service},
                        success: function (data) {

                                if (data == '1') {
                                        alert('Please select branch');
                                        $('#service-service').select2('val', '');
                                        $('#service-sub_service').val('');
                                } else if (data == '2') {
                                        var id_attr = branch + "_" + service + "_" + sub_service;
                                        $('#service-duty_type').empty();
                                        $('.add-rate-card').attr('id', id_attr);
                                        $('.rate-card-error').show();
                                        $('.rate-card-update-error').hide();
                                } else if (data == '3') {
                                        var id_attr = branch + "_" + service + "_" + sub_service;
                                        $('#service-duty_type').empty();
                                        $('.update-rate-card').attr('id', id_attr);
                                        $('.rate-card-update-error').show();
                                        $('.rate-card-error').hide();
                                } else {
                                        $('.rate-card-error').hide();
                                        $('.rate-card-update-error').hide();
                                        $('#service-duty_type').html(data);

                                }
                        }
                });
        });


        /*
         * add new rate card popup
         */
        $('.add-rate-card').click(function () {
                var id_attr = $(this).attr('id');
                var type = id_attr.split('_');
                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {branch: type[0], service: type[1], sub_service: type[2]},
                        url: homeUrl + 'dropdown/ratecard',
                        success: function (data) {
                                $("#modal-pop-up").html(data);
                                $('#modal-6').modal('show', {backdrop: 'static'});
                        }
                });
        });
        /*
         * add rate card to db
         */
        $(document).on('submit', '#submit-add-rate-card', function (e) {

                e.preventDefault();
                var data = $(this).serialize();
                $.ajax({
                        type: 'POST',
                        url: homeUrl + 'dropdown/addratecard',
                        data: data,
                        success: function (data) {
                                $('#service-duty_type').html(data);
                                $('.rate-card-error').hide();
                                $('#modal-6').modal('hide');
                        }
                });
        });


        /*
         * update new rate card popup
         */
        $('.update-rate-card').click(function () {
                var id_attr = $(this).attr('id');
                var type = id_attr.split('_');
                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {branch: type[0], service: type[1]},
                        url: homeUrl + 'dropdown/ratecardupdate',
                        success: function (data) {
                                $("#modal-pop-up").html(data);
                                $('#modal-6').modal('show', {backdrop: 'static'});
                        }
                });
        });

        /*
         * update rate card to db
         */
        $(document).on('submit', '#submit-update-rate-card', function (e) {

                e.preventDefault();
                var data = $(this).serialize();
                $.ajax({
                        type: 'POST',
                        url: homeUrl + 'dropdown/updateratecard',
                        data: data,
                        success: function (data) {
                                $('#service-duty_type').html(data);
                                $('.rate-card-update-error').hide();
                                $('#modal-6').modal('hide');
                        }
                });
        });


        $('.service-frequency').hide();
        $('.service-hours').hide();
        $('.service-days').hide();
        $('#day_night_staff').hide();

        $('#service-duty_type').change(function () {
                $('.service-frequency').show();
                FrequencyChange();
                if ($(this).val() == '5')
                        $('#day_night_staff').show();
                else
                        $('#day_night_staff').hide();

        });



        /*
         * show hours/days on frequency change
         */
        $('#service-frequency').change(function () {
                FrequencyChange();
        });

        $('#service-from_date').change(function () {
                Datecalculate();
        });

        $('#service-days').change(function () {
                EstimatedPrice();
                Datecalculate();

        });

        var duty_type = $('#service-duty_type').val();
        if (duty_type) {
                $('.service-frequency').show();
                FrequencyChange();
                if (duty_type == '5')
                        $('#day_night_staff').show();


        }

        $('.service_status').change(function () {
                var service_id = $(this).val();
                $.ajax({
                        type: 'POST',
                        url: homeUrl + 'serviceajax/servicestatus',
                        data: {service_id: service_id},
                        success: function (data) {
                                if (data == '1') {
                                        $('.service-status-text').text('Closed');
                                        $(".service_stat").css({"pointer-events": "none"});
                                        alert('Status updated successfully');
                                } else if (data == '2') {
                                        $('.service_stat .cbr-replaced').removeClass("cbr-checked");
                                        alert('This service has pending schedules. You cannot close this service!');
                                }
                        }
                });

        });

        /********************************************************  Service  **********************************************/




        /********************************************************  Service Schedule **********************************************/



        /*
         * upadte schedule row
         */
        $('.schedule-update').blur(function () {
                var id_attr = $(this).attr('id');
                var id = id_attr.split('-');
                var remark_manager = $('#remarks_from_manager-' + id[1]).val();
                var remark_staff = $('#remarks_from_staff-' + id[1]).val();
                var remark_patient = $('#remarks_from_patient-' + id[1]).val();


                $.ajax({
                        type: 'POST',
                        url: homeUrl + 'serviceajax/scheduleupdate',
                        data: {id: id[1], remarks_from_manager: remark_manager, remarks_from_staff: remark_staff, remarks_from_patient: remark_patient},
                        success: function (data) {

                        }
                });
        });
        /*
         * update schedule date
         */
        // $('.schedule-update-date').change(function () {
        $(document).on('change', '.schedule-update-date', function (e) {
                var id_attr = $(this).attr('id');
                var id = id_attr.split('-');
                var date = $('#schedule_date-' + id[1]).val();

                $.ajax({
                        type: 'POST',
                        url: homeUrl + 'serviceajax/scheduledateupdate',
                        data: {id: id[1], date: date},
                        success: function (data) {

                        }
                });

        });


        /*
         * update rating in schedule
         */
        $('.schedule-rating').change(function () {
                var schedule_id = $(this).attr('id');
                var rating = $(this).val();
                $.ajax({
                        type: 'POST',
                        url: homeUrl + 'serviceajax/addrating',
                        data: {schedule_id: schedule_id, rating: rating},
                        success: function (data) {

                        }
                });

        });

        /*
         * change status of schedule
         */

        $('.status-update').change(function () {

                var status = $(this).val();
                var idd_atr = $(this).attr('id');
                var schedule_id = idd_atr.split('_');
                var date = $('#schedule_date-' + schedule_id[1]).val();
                var staf = $('#staff_on_duty_' + schedule_id[1]).attr('val');
                if (staf && staf != '') {
                        if (date && date != '') {
                                showLoader();
                                $.ajax({
                                        type: 'POST',
                                        url: homeUrl + 'serviceajax/statusupdate',
                                        data: {schedule_id: schedule_id, status: status},
                                        success: function (data) {
                                                hideLoader();
                                                $("#modal-2-pop-up").html(data);
                                                $('#modal-2').modal('show', {backdrop: 'static'});

                                        }
                                });
                        } else {
                                $('#' + idd_atr + ' option[value=1]').prop("selected", "selected");
                                alert('Please select a date for this schedule');
                        }
                } else {
                        $('#' + idd_atr + ' option[value=1]').prop("selected", "selected");
                        alert('Please assign a staff for this schedule');
                }
        });


        /*
         * schedule daily rate submit
         */
        $(document).on('submit', '#schedule-daily-rate', function (e) {
                e.preventDefault();
                var data = $(this).serialize();
                $.ajax({
                        type: 'POST',
                        url: homeUrl + 'serviceajax/addrate',
                        data: data,
                        success: function (data) {
                                $('#modal-2').modal('hide');
                                location.reload();
                        }
                });
        });





        $('input[type=radio][name=staff_choose]').change(function () {
                var selected_radio = $(this).val();
                $('#choosed_staff').val(selected_radio);
        });


        /*
         * selct staff from the search result
         */
        $(document).on('submit', '#searchChooseStaff', function (e) {
                e.preventDefault();
                var staff = $('#choosed_staff').val();
                var service_id = $('#service_id').val();
                var schedule_id = $('#schedule_id').val();
                var replace_or_new = $('#replace_or_new').val();
                var type = $('#type').val();
                $.ajax({
                        type: 'POST',
                        url: homeUrl + 'serviceajax/selectedstaff',
                        data: {staff: staff, service_id: service_id, schedule_id: schedule_id, type: type, replace_or_new: replace_or_new},
                        success: function (data) {

                                opener.location.reload();
                                window.top.close();


                        }
                });

        });




        /*
         * add more schedules popup
         */
        $('.add-schedules').on('click', function () {
                var service_id = $(this).attr('id');
                $.ajax({
                        type: 'POST',
                        url: homeUrl + 'serviceajax/schedule',
                        data: {service_id: service_id},
                        success: function (data) {
                                $("#modal-pop-up").html(data);
                                $('#modal-6').modal('show', {backdrop: 'static'});
                        }
                });
        });
        /*
         * add schedules submit
         */
        $(document).on('submit', '#add-schedules', function (e) {
                e.preventDefault();
                var data = $(this).serialize();
                $.ajax({
                        type: 'POST',
                        url: homeUrl + 'serviceajax/addschedule',
                        data: data,
                        success: function (data) {
                                $('#modal-6').modal('hide');
                                location.reload();
                        }
                });
        });



        $(document).on('click', '.view_schedule', function (e) {
                var schedule_id = $(this).attr('id');
                $.ajax({
                        type: 'POST',
                        url: homeUrl + 'serviceajax/viewschedule',
                        data: {schedule_id: schedule_id},
                        success: function (data) {
                                $("#modal-pop-up").html(data);
                                $('#modal-6').modal('show', {backdrop: 'static'});
                        }
                });
        });







        /********************************************************  Service Schedule **********************************************/

        /********************************************************  Service Discounts **********************************************/


        $('#servicediscounts-discount_type').change(function () {
                var type = $("#servicediscounts-discount_type input[type='radio']:checked").val();
                Discounts(type);
        });


        $('#servicediscounts-discount_value').change(function () {
                var type = $("#servicediscounts-discount_type input[type='radio']:checked").val();
                if (type && type != '')
                        Discounts(type);
                else
                        alert('Please choose a discount type');


        });



        /********************************************************  Service Discounts **********************************************/



});

function FrequencyChange() {

        var duty_Type = $('#service-duty_type').val();
        var frequency = $('#service-frequency').val();
        if (frequency) {
                if ((duty_Type == '3' || duty_Type == '4' || duty_Type == '5') && frequency == '1') { /* duty type= day or night or day & night, frequency= daily */
                        $("label[for = service-days]").text("No of days");
                        $('.service-hours').hide();
                        $('.service-days').show();
                } else {
                        if (duty_Type == 1) { /* if duty type= hourly*/
                                $("label[for = service-hours]").text("Hours");
                        } else if (duty_Type == 2) {  /* if duty type= visit*/
                                $("label[for = service-hours]").text("No.of visits");
                        } else if (duty_Type == 5) { /* if duty type= day & night*/
                                $("label[for = service-hours]").text("Days");
                        } else if (duty_Type == 3) { /* if duty type= day & night*/
                                $("label[for = service-hours]").text("Days");
                        } else if (duty_Type == 4) { /* if duty type= day & night*/
                                $("label[for = service-hours]").text("Days");
                        }
                        if (frequency == 1) { /* if frequency= daily */
                                $("label[for = service-days]").text("No of days");
                        } else if (frequency == 2) { /* if frequency= weekly */
                                $("label[for = service-days]").text("No of weeks");
                        } else if (frequency == 3) { /* if frequency= monthly */
                                $("label[for = service-days]").text("No of months");
                        }
                        $('.service-hours').show();
                        $('.service-days').show();
                }
        }

}


function EstimatedPrice() {
        var frequency = $('#service-frequency').val();
        var days = $('#service-days').val();
        var hours = $('#service-hours').val();
        var service = $('#service-service').val();
        var branch = $('#service-branch_id').val();
        var duty_Type = $('#service-duty_type').val();
        var sub_service = $('#service-sub_service').val();

        if (frequency && service && branch && duty_Type) {
                $.ajax({
                        url: homeUrl + 'serviceajax/estimatedprice',
                        type: 'POST',
                        data: {frequency: frequency, days: days, hours: hours, service: service, branch: branch, duty_Type: duty_Type, sub_service: sub_service},
                        success: function (data) {
                                $('#service-estimated_price').val(data);
                        }
                });

        } else {
                alert('An error occured');
        }
}

function Datecalculate() {

        var frequency = $('#service-frequency').val();
        var days = $('#service-days').val();
        var from = $('#service-from_date').val();

        if (from) {
                $.ajax({
                        url: homeUrl + 'serviceajax/todate',
                        type: 'POST',
                        data: {frequency: frequency, days: days, from: from},
                        success: function (data) {
                                $('#service-to_date').val(data);
                        }
                });
        }

}

function Discounts(type) {

        var discount_amount = $('#servicediscounts-discount_value').val();
        var rate = $('#servicediscounts-rate').val();
        var total_amount = 0;
        if (discount_amount && discount_amount != '') {
                if (type == 2) {
                        total_amount = parseFloat(rate) - parseFloat(discount_amount);
                } else if (type == 1) {
                        var per = parseFloat(rate) * parseFloat(discount_amount) / 100;
                        total_amount = parseFloat(rate) - parseFloat(per);
                }
                $('#servicediscounts-total_amount').val(total_amount);
        }
}




