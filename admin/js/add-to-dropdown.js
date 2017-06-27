/*
 * Created by   :- Manu K O
 * Created date :- 03-03-2017
 * purpose      :- To add common javascript
 */

$("document").ready(function () {

        /*
         * show add hospital form
         */
        $('.add-hospital-link').on('click', function (e) {
                var select_box = $(this).attr('id');
                $.ajax({
                        type: 'POST',
                        cache: false,
                        async: false,
                        data: 'select_box=' + $(this).attr('id'),
                        url: homeUrl + 'dropdown/addhospital',
                        success: function (data) {

                                $("#modal-pop-up").html(data);
                                $('#modal-6').modal('show', {backdrop: 'static'});
                                e.preventDefault();
                        }
                });
        });
        /*
         * add new hospital
         */

        $(document).on('submit', '#submit-add-hospital', function () {
                var str = $(this).serialize();

                $.ajax({

                        url: homeUrl + 'dropdown/add',
                        type: "POST",
                        data: str,
                        success: function (data) {
                                // var res = $.parseJSON(data);
                                alert(data);
                                //$(".partner_name").text(res.result['hospital_name']);
                                // $("#salesinvoicedetails-busines_partner_code").val(res.result['id']);
                                // $('#modal-6').modal('hide');
                        }
                });

        });



        $(document).on('submit', '#add-remarks', function (e) {
                var remarks = $(this).serialize();
                $.ajax({

                        url: homeUrl + 'dropdown/addremarks',
                        type: "POST",
                        data: remarks,
                        success: function (data) {

                                $('#add-remarks')[0].reset();
                                var res = $.parseJSON(data);
                                $('.remarks-table table').append('<tr id="' + res.result[5] + '"><td>' + res.result[0] + '</td>\n\
                                                                  <td>' + res.result[1] + '</td>\n\
                                                                  <td>' + res.result[2] + '</td>\n\
                                                                  <td>' + res.result[3] + '</td>\n\
                                                                  <td>' + res.result[4] + '</td>\n\
                                                                  <td>Active</td>\n\
                                                                  <td><input type="checkbox" class="iswitch iswitch-secondary remarks-status" id="' + res.result[5] + '"></td></tr>');
                        }
                });
                e.preventDefault();

        });

        $(document).on('click', '.remarks-status', function (e) {
                var remark = $(this).attr('id');
                $.ajax({
                        type: 'POST',
                        cache: false,
                        async: false,
                        data: 'remark_id=' + $(this).attr('id'),
                        url: homeUrl + 'dropdown/changeremarkstatus',
                        success: function (data) {
                                if (data == '1') {
                                        $('.remarks-table table tr#' + remark).remove();
                                }
                        }
                });
        });

});

function postToController() {
        for (i = 0; i < document.getElementsByName('rating').length; i++) {
                if (document.getElementsByName('rating')[i].checked == true) {
                        var ratingValue = document.getElementsByName('rating')[i].value;
                        break;
                }
        }
        $('#rating').val(ratingValue);
}