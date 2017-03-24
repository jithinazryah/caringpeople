/*
 * Created by   :- Manu K O
 * Created date :- 03-03-2017
 * purpose      :- To add common javascript
 */

$("document").ready(function () {


        $('#checkbox_id').on('change', function (e) {
                if (this.checked) {
                        var address = $("#staffinfo-permanent_address").val();
                        var pincode = $("#staffinfo-pincode").val();
                        var contact_no = $("#staffinfo-contact_no").val();
                        var email = $("#staffinfo-email").val();
                        $("#staffinfo-present_address").val(address);
                        $("#staffinfo-present_pincode").val(pincode);
                        $("#staffinfo-present_contact_no").val(contact_no);
                        $("#staffinfo-present_email").val(email);
                }

        });


});
