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

                $.ajax({
                        type: 'POST',
                        url: homeUrl + 'dropdown/addhospital',
                        success: function (data) {
                                $("#modal-pop-up").html(data);
                                $('#modal-6').modal('show', {backdrop: 'static'});
                               
                        }
                });
        });
        /*
         * add new hospital
         */

        
            $("form#add-hospital").submit(function (e) {
                $('form#add-hospital').submit(false);
           e.preventDefault();
                var str = $(this).serialize();
                
                $.ajax({
                        url: homeUrl + 'dropdown/add',
                        type: "POST",
                        data: id,
                        success: function (data) {

                                //$(".partner_name").text(res.result['hospital_name']);
                                // $("#salesinvoicedetails-busines_partner_code").val(res.result['id']);
                                // $('#modal-6').modal('hide');
                        }
                });

        });



        $(document).on('submit', '#add-remarks', function (e) {
                e.preventDefault();
                var remarks = $(this).serialize();
                $.ajax({

                        url: homeUrl + 'dropdown/addremarks',
                        type: "POST",
                        data: remarks,
                        success: function (data) {

                                $('#add-remarks')[0].reset();
                                var res = $.parseJSON(data);
                                $('.remarks-table table').append('<tr id="' + res.id + '"><td>' + res.UB + '</td>\n\
                                                                  <td>' + res.category + '</td>\n\
                                                                  <td>' + res.sub_category + '</td>\n\
                                                                  <td>' + res.point + '</td>\n\
                                                                  <td>' + res.notes + '</td>\n\
                                                                  <td>' + res.date + '</td>\n\
                                                                  <td>Active</td>\n\
                                                                  <td><input type="checkbox" class="iswitch iswitch-secondary remarks-status" id="' + res.id + '"></td></tr>');
                        }
                });


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