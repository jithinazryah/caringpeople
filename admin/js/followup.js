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

        $('.followup_closed').change(function () {
                var followup_id = $(this).val();
                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {followup_id: followup_id},
                        url: homeUrl + 'ajax/followupstatus',
                        success: function (data) {

                                $('.' + followup_id).hide(1000);

                        }
                });

        });

});
