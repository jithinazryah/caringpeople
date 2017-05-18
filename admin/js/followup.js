/*
 * Created by   :- Sabitha
 * Created date :- 04-04-2017
 */

$("document").ready(function () {




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
         * To add more followup (multiple)
         */


        var scntDiv = $('#followups');
        var i = $('#followups span').size() + 1;

        $('#addFollowups').on('click', function () {
                var type = $('#type').val();
                var type_id = $('#type_id').val();
                showLoader();
                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {type: type, type_id: type_id},
                        url: homeUrl + 'followupajax/followups',
                        success: function (data) {

                                hideLoader();
                                $(data).appendTo(scntDiv);
                                i++;
                                return false;
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
                        $('#delete_port_vals').val($('#delete_port_vals').val() + valu + ',');
                        var value = $('#delete_port_vals').val();
                        $.ajax({
                                type: 'POST',
                                cache: false,
                                data: {valu: valu},
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
                        data: {type: type_id[0]},
                        url: homeUrl + 'followupajax/addfollowups',
                        success: function (data) {
                                hideLoader();
                                $(".subtype").append(data);
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
                var notes = $('#field-5').val();

                showLoader();
                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {type: type, type_id: type_id, subtype: subtype, followupdate: followupdate, assignedto: assignedto, assignedfrom: assignedfrom, notes: notes},
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
}
);
