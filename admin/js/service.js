/*
 * Created by   :- Sabitha
 * Created date :- 22-03-2017
 */

$("document").ready(function () {



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
                                        $('.add-rate-card').attr('id', id_attr);
                                        $('.rate-card-error').show();
                                } else if (data == '3') {
                                        var id_attr = branch + "_" + service;
                                        $('.update-rate-card').attr('id', id_attr);
                                        $('.rate-card-update-error').show();
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

        $('.schedule-update').blur(function () {
                var id_attr = $(this).attr('id');
                var id = id_attr.split('-');
                var remark_manager = $('#remarks_from_manager-' + id[1]).val();
                var remark_staff = $('#remarks_from_staff-' + id[1]).val();
                var remark_patient = $('#remarks_from_patient-' + id[1]).val();
                var status = $('#status-' + id[1]).val();
                var attendance = $('#attendance-' + id[1]).val();

                $.ajax({
                        type: 'POST',
                        url: homeUrl + 'serviceajax/scheduleupdate',
                        data: {id: id[1], remarks_from_manager: remark_manager, remarks_from_staff: remark_staff, remarks_from_patient: remark_patient, status: status, attendance: attendance},
                        success: function (data) {

                        }
                });
        });
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


});

function FrequencyChange() {

        var duty_Type = $('#service-duty_type').val();
        var frequency = $('#service-frequency').val();
        if (frequency) {
                if ((duty_Type == '3' || duty_Type == '4' || duty_Type == '5') && frequency == '1') { /* duty type= day or night, frequency= daily */
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




