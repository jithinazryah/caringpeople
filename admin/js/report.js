/*
 * Created by   :- Sabitha
 * Created date :- 22-06-2017
 */



$("document").ready(function () {

        $("#report-staff").select2({
                allowClear: true
        }).on('select2-open', function ()
        {
                $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });



        $('#report-branch').change(function () {
                var branch = $(this).val();
                showLoader();
                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {branch: branch},
                        url: homeUrl + 'report/staffs',
                        success: function (data) {
                                $('#report-staff').html(data);
                                hideLoader();
                        }
                });
        });


        var branch = $('#report-branch').val();
        if (branch) {
                showLoader();
                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {branch: branch},
                        url: homeUrl + 'report/staffs',
                        success: function (data) {
                                $('#report-staff').html(data);
                                hideLoader();
                        }
                });
        }


});

