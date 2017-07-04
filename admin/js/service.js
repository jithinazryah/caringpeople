/*
 * Created by   :- Sabitha
 * Created date :- 22-03-2017
 */

$("document").ready(function () {


        $('#service-service').change(function () {
                $.ajax({
                        url: homeUrl + 'ajax/dutytype',
                        type: 'POST',
                        data: {service: $(this).val()},
                        success: function (data) {
                                $('#service-duty_type').html(data);
                        }
                });
        });

        $('#service-patient_id').change(function () {
                $.ajax({
                        url: homeUrl + 'ajax/patientmanager',
                        type: 'POST',
                        data: {service: $(this).val()},
                        success: function (data) {

                        }
                });
        });


});

