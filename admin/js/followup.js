/*
 * Created by   :- Sabitha
 * Created date :- 04-04-2017
 */

$("document").ready(function () {


        /*
         * select 2 for related staffs
         */
        $("#create-related_staffs").select2({
                placeholder: 'Select Staffs',
                allowClear: true
        }).on('select2-open', function ()
        {
                $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });


        $("#create-assigned_to").select2({
                placeholder: '--Select--',
                allowClear: true
        }).on('select2-open', function ()
        {
                $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });



        /*
         * followup notes update
         */
        $('.follow_notes').blur(function () {

                var followup_id = $(this).attr('id');
                var notes = $(this).val();
                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {followup_id: followup_id, notes: notes},
                        url: homeUrl + 'ajax/followup',
                        success: function (data) {


                        }
                });
        });

        /*
         * when submitting followup
         */
        $(document).on('submit', '#add-followup', function (e) {
                var followups = $(this).serialize();
                $.ajax({

                        url: homeUrl + 'followupajax/addfollowup',
                        type: "POST",
                        data: followups,
                        success: function (data) {
                                alert(data);
                        }
                });
                e.preventDefault();

        });




        /*
         * to change the status of followup (change status to closed)
         */

        $('.followup_closed').change(function () {
                if ($(this).attr('id') == '') {
                        var type = '1';
                } else {
                        var type = '2';
                }
                var followup_id = $(this).val();
                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {followup_id: followup_id, type: type},
                        url: homeUrl + 'followupajax/followupstatus',
                        success: function (data) {
                                $('.' + followup_id).hide(1000);
                        }
                });
        });








        /*
         * Followup subtype on followup type chanf
         */


        $(document).on('change', '.followup_type', function () {
                var type = $(this).val();
                var id_rand = $(this).attr('id');
                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {type: type},
                        url: homeUrl + 'followupajax/subtype',
                        success: function (data) {
                                $('#sub_' + id_rand).html(data);
                                hideLoader();
                        }
                });
        });

        /*
         * delete attachment
         */

        $('.followup-attach-remove').on('click', function (e) {
                var data = $(this).attr('id');
                var datas = data.split("-");

                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {id: datas[0], name: datas[1]},
                        url: homeUrl + 'followupajax/attachremove',
                        success: function (data) {
                                $('#attach_' + datas[0]).remove();
                        }
                });
        });


        /*
         * if repetaed followup is checked hide Add more followups
         */
        $('#repeated-types').hide();
        $(document).on('click', '#repeated_followups', function () {
                if ($(this).prop("checked") == true) {
                        $('#addFollowups').hide();
                        $('#repeated-types').show();
                } else if ($(this).prop("checked") == false) {
                        $('#addFollowups').show();
                        $('#repeated-types').hide();
                        $('.option3').hide();
                        $('.option1').hide();
                        $('.option2').hide();
                }
        });



        $('#repeated-option').change(function () {

                if ($(this).val() == '1') {
                        $('.option1').show();
                        $('.option2').hide();
                        $('.option3').hide();
                } else if ($(this).val() == '2') {
                        $('.option2').show();
                        $('.option1').hide();
                        $('.option3').hide();
                } else if ($(this).val() == '3') {
                        $('.option3').show();
                        $('.option1').hide();
                        $('.option2').hide();
                } else if ($(this).val() == '4') {
                        $('.option3').hide();
                        $('.option1').hide();
                        $('.option2').hide();
                }
        });




        $('.add-items').click(function () {
                var n = $('.text-items').length + 1;
                var box_html = $('<div class="col-md-3 col-sm-6 col-xs-12 left_padd text-items"><div class="form-group field-followups-date"><label class="control-label " for="reminder-remind_days">Select Date</label><input type="datetime-local" id="reminder-remind_days' + n + '" class="form-control remind_days1" name="date[remind_days1][]"></div></div>');
                box_html.hide();
                $('.text-items:last').after(box_html);
                box_html.fadeIn('slow');
                return false;
        });


        $("#specific-days").select2({
                placeholder: '--Select Days--',
                allowClear: true
        }).on('select2-open', function ()
        {
                $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        $("#specific-dates-month").select2({
                placeholder: '--Select Days--',
                allowClear: true
        }).on('select2-open', function ()
        {
                $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });







        $(document).on('change', '.create-assignedto', function () {
                var str = $("#" + $(this).attr('id') + " option:selected").text();
                if (str.indexOf('Patient') > -1)
                {
                        $('#assigned_to_type_' + i).val('1');
                } else {
                        $('#assigned_to_type_' + i).val('2');
                }
        });
});
