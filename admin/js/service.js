/*
 * Created by   :- Sabitha
 * Created date :- 22-06-2017
 */

$("document").ready(function () {


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
         * service rate card
         */

        $('#ratecard-branch_id').change(function () {
                showLoader();
                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {branch: $(this).val()},
                        url: homeUrl + 'serviceajax/services',
                        success: function (data) {
                                $('#ratecard-service_id').html(data);
                                hideLoader();
                        }
                });
        });

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
        $('#service-patient_id').change(function () {
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
                                        var id_attr = branch + "_" + service;
                                        $('#service-duty_type').empty();
                                        $('.add-rate-card').attr('id', id_attr);
                                        $('.rate-card-error').show();
                                        $('.rate-card-update-error').hide();
                                } else if (data == '3') {
                                        var id_attr = branch + "_" + service;
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
         * add new rate card
         */
        $('.add-rate-card').click(function () {
                var id_attr = $(this).attr('id');
                var type = id_attr.split('_');
                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {branch: type[0], service: type[1]},
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
         * update new rate card
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

        $('#service-duty_type').change(function () {
                $('.service-frequency').show();
                FrequencyChange();
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
        }

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
        $('.schedule-update-date').change(function () {
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
                var schedule_id = $(this).attr('id');
                $.ajax({
                        type: 'POST',
                        url: homeUrl + 'serviceajax/statusupdate',
                        data: {schedule_id: schedule_id, status: status},
                        success: function (data) {

                        }
                });
        });

        /*
         * assign staff  for schedule
         */

        $('.choose-staff').click(function () {
                var service = $(this).attr('id');
                $.ajax({
                        type: 'POST',
                        url: homeUrl + 'serviceajax/choosestaff',
                        data: {service: service},
                        success: function (data) {
                                $("#modal-2-pop-up").html(data);
                                $('#modal-2').modal('show');
                        }
                });
        });


        /*
         * search staff for schedule
         */

        $(document).on('submit', '#schedulestaffSearch', function (e) {

                e.preventDefault();
                var data = $(this).serialize();
                $.ajax({
                        type: 'POST',
                        url: homeUrl + 'serviceajax/searchstaff',
                        data: data,
                        success: function (data) {

                                $('.staff-results table').remove();
                                $('.staff-results .pagination').remove();
                                $('.result-buttons').show();
                                $(".staff-results").append(data);
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
                var type = $('#type').val();
                $.ajax({
                        type: 'POST',
                        url: homeUrl + 'serviceajax/selectedstaff',
                        data: {staff: staff, service_id: service_id, schedule_id: schedule_id, type: type},
                        success: function (data) {
                                opener.location.reload();
                                window.top.close();
                        }
                });

        });

        /*
         *clear results whwn click on reset button
         */

        $(document).on('click', '#Resetbtn', function (e) {
                $("#example-11").remove();
                $('.staff-results .pagination').remove();
                $('.replace-results .pagination').remove();
                $('.result-buttons').hide();

        });


        /*
         * replace staff for a particular schedule
         */
        $(document).on('click', '.replace-staff', function (e) {

                var schedule_id = $(this).attr('id');
                var type = $(this).attr('type');

                $.ajax({
                        type: 'POST',
                        url: homeUrl + 'serviceajax/replacestaffform',
                        data: {schedule_id: schedule_id, type: type},
                        success: function (data) {
                                $("#modal-2-pop-up").html(data);
                                $('#modal-2').modal('show');
                        }
                });
        });

        /*
         * staff search in staff replace form
         */
        $(document).on('submit', '#replacestaffSearch', function (e) {

                e.preventDefault();
                var data = $(this).serialize();
                $.ajax({
                        type: 'POST',
                        url: homeUrl + 'serviceajax/searchstaff',
                        data: data,
                        success: function (data) {


                                $('.replace-results table').remove();
                                $('.replace-results .pagination').remove();
                                $('.result-buttons').show();
                                $(".replace-results").append(data);
                        }
                });
        });

        /*
         * staff replacement
         */
        $(document).on('submit', '#searchReplaceStaff', function (e) {
                e.preventDefault();
                var staff = $('input[name=staff_choose]:checked').val();
                var schedule_id = $('#choose_service_id').val();
                var type = $('#type').val();

                $.ajax({
                        type: 'POST',
                        url: homeUrl + 'serviceajax/replacestaff',
                        data: {staff: staff, schedule_id: schedule_id, type: type},
                        success: function (data) {

                                $('#staff_on_duty_' + schedule_id).val(data);
                                $('#modal-2').modal('hide');
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

        if (frequency && service && branch && duty_Type) {
                $.ajax({
                        url: homeUrl + 'serviceajax/estimatedprice',
                        type: 'POST',
                        data: {frequency: frequency, days: days, hours: hours, service: service, branch: branch, duty_Type: duty_Type},
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




