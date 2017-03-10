/*
 * Created by   :- Manu K O
 * Created date :- 03-03-2017
 * purpose      :- To add common javascript
 */

$("document").ready(function () {


        /*
         * Purpose   :- On change of country dropdown
         * parameter :- country_id
         * return   :- The list of states depends on the country_id
         */

        $('.country-change').change(function () {
          
                var country_id = $(this).val();
                showLoader();
                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {country_id: country_id},
                        url: homeUrl + 'ajax/state',
                        success: function (data) {
                           
                                if (data == 0) {
                                        alert('Failed to Load data, please try again error:1001');
                                } else {
                                        $(".state-change").html(data);
                                }
                                hideLoader();
                        }
                });
        });

        /*
         * Purpose   :- On change of state dropdown
         * parameter :- state_id
         * return   :- The list of district depends on the state_id
         */

        $('.state-change').change(function () {
                if ($(this).hasClass('no-city')) {

                } else {
                        var state_id = $(this).val();
                        showLoader();
                        $.ajax({
                                type: 'POST',
                                cache: false,
                                data: {state_id: state_id},
                                url: homeUrl + 'ajax/city',
                                success: function (data) {
                                        if (data == 0) {
                                                alert('Failed to Load data, please try again error:1002');
                                        } else {
                                                $(".city-change").html(data);
                                        }
                                        hideLoader();
                                }
                        });
                }
        });


});
