/*
 * Created by   :- Manu K O
 * Created date :- 03-03-2017
 * purpose      :- To add common javascript
 */

$("document").ready(function () {

    $('.add-hospital-link').on('click', function (e) {
        var select_box=$(this).attr('id');
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

});
