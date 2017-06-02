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

        /*
         * select 2 for update staffs
         */
        $("#update-related_staffs").select2({
                placeholder: 'Select Staffs',
                allowClear: true
        }).on('select2-open', function ()
        {
                $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });




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
         * To add more followup (multiple)
         */


        var scntDiv = $('#followups');
        var i = $('#followups span').size() + 1;
        $('#addFollowups').on('click', function () {

                $('#repeated').hide();
                var type = $('#type').val();
                var type_id = $('#type_id').val();
                showLoader();
                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {type: type, type_id: type_id, count: i},
                        url: homeUrl + 'ajax/followups',
                        success: function (data) {
                                hideLoader();
                                if ($(data).appendTo(scntDiv)) {
                                        $('#create-related_staffs_' + i).select2({
                                                placeholder: 'Choose Staffs',
                                                allowClear: true
                                        }).on('select2-open', function ()
                                        {
                                                $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                                        });
                                        i++;
                                }


                        }
                });
        });

        /*
         * to change the status of followup (change status to closed)
         */

        $('.followup_closed').change(function () {
                var followup_id = $(this).val();

                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {followup_id: followup_id},
                        url: homeUrl + 'followupajax/followupstatus',
                        success: function (data) {

                                $('.' + followup_id).hide(1000);

                        }
                });

        });



        /*
         * to remove followups
         */

        $('#followups').on('click', '.remFollowup', function () {

                if (i > 2) {

                        $(this).parents('span').remove();
                        i--;
                }
                if (this.hasAttribute("val")) {

                        var valu = $(this).attr('val');
                        var idd = $(this).attr('id');
                        var ids = idd.split('_');

                        $('#delete_port_vals').val($('#delete_port_vals').val() + valu + ',');
                        var value = $('#delete_port_vals').val();
                        $.ajax({
                                type: 'POST',
                                cache: false,
                                data: {valu: valu, type: ids[1]},
                                url: homeUrl + 'followupajax/delete',
                                success: function (data) {

                                        hideLoader();

                                }
                        });
                }

                return false;
        });

        /*
         * Show popup and form for add followup
         */

        $('.Addfollowup').on('click', function () {

                var id = $(this).attr('id');
                var type_id = id.split("_");
                $('#add_type').val(type_id[0]);
                $('#add_type_id').val(type_id[1]);
                $('.subtypediv').remove();
                showLoader();
                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {type: type_id[0], type_id: type_id[1]},
                        url: homeUrl + 'followupajax/addfollowups',
                        success: function (data) {

                                hideLoader();

                                $("#modal-followup").html(data);
                                $("#related_staffs_field").select2({
                                        placeholder: 'Select Staffs',
                                        allowClear: true
                                }).on('select2-open', function ()
                                {
                                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                                });
                                $('#modal-6').modal('show', {backdrop: 'static'});
                        }
                });
        });


        /*
         * Add followup on popup submit
         */
        $(document).on('submit', '#addFollowupsubmit', function () {

                $('#modal-6').modal('hide');
                var type = $('#add_type').val();
                var type_id = $('#add_type_id').val();
                var subtype = $('#field-1').val();
                var followupdate = $('#field-2').val();
                var assignedto = $('#field-3').val();
                var assignedfrom = $('#field-4').val();
                var related_staffs = $('#related_staffs_field').val();
                var notes = $('#field-5').val();

                showLoader();
                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {type: type, type_id: type_id, subtype: subtype, followupdate: followupdate, assignedto: assignedto, assignedfrom: assignedfrom, related_staffs: related_staffs, notes: notes},
                        url: homeUrl + 'followupajax/add',
                        success: function (data) {
                                hideLoader();
                        }
                });

        });


        /*
         * Followup subtype on followup type chanf
         */

// $('.followup_type').on('change', function () {
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
                                //  $('#' + id_rand).html(data);
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

        $(document).on('click', '#repeated_followups', function () {
                if ($(this).prop("checked") == true) {
                        $('#addFollowups').hide();
                        $('#repeated-types').show();
                } else if ($(this).prop("checked") == false) {
                        $('#addFollowups').show();
                        $('#repeated-types').hide();
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
                }
        });

        var repaeted_option_update = $('#repeated-option-update').val();
        if (repaeted_option_update == '1') {
                $('.option2_update').hide();
                $('.option3_update').hide();
        } else if (repaeted_option_update == '2') {
                $('.option2_update').show();
                $('.option3_update').hide();
        } else if (repaeted_option_update == '3') {
                $('.option3_update').show();
                $('.option2_update').hide();
        }

        $('#repeated-option-update').change(function () {
                if ($(this).val() == '1') {
                        $('.option2_update').hide();
                        $('.option3_update').hide();
                } else if ($(this).val() == '2') {
                        $('.option2_update').show();
                        $('.option3_update').hide();
                } else if ($(this).val() == '3') {
                        $('.option3_update').show();
                        $('.option2_update').hide();
                }
        });


        $('.add-items').click(function () {
                var n = $('.text-items').length + 1;
                var box_html = $('<div class="col-md-3 col-sm-6 col-xs-12 left_padd text-items"><div class="form-group field-followups-date"><label class="control-label " for="reminder-remind_days">Select Date</label><input type="datetime-local" id="reminder-remind_days' + n + '" class="form-control remind_days1" name="create[remind_days1][0][]"></div></div>');
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

        $("#specific-days-update").select2({
                placeholder: '--Select Days--',
                allowClear: true
        }).on('select2-open', function ()
        {
                $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        $("#specific-dates-month-update").select2({
                placeholder: '--Select Days--',
                allowClear: true
        }).on('select2-open', function ()
        {
                $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });
});
