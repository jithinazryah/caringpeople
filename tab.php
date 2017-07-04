<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

<body>Single select example
        <div class="selectRow">
                <select id="singleSelectExample">
                        <option></option>
                        <option value="1">Apple</option>
                        <option value="2">Orange 2</option>
                        <option value="3">Banana</option>
                        <option value="4">Mango</option>
                        <option value="5">Pomegranate</option>
                        <option value="5">avaa</option>
                </select>



                <script>
                        $(document).ready(function () {
                                // Single select example if using params obj or configuration seen above
                                var configParamsObj = {
                                        placeholder: 'Select an option...', // Place holder text to place in the select
                                        minimumResultsForSearch: 3, // Overrides default of 15 set above
                                        matcher: function (params, data) {
                                                // If there are no search terms, return all of the data
                                                if ($.trim(params.term) === '') {
                                                        return data;
                                                }

                                                // `params.term` should be the term that is used for searching
                                                // `data.text` is the text that is displayed for the data object
                                                if (data.text.toLowerCase().startsWith(params.term.toLowerCase())) {
                                                        var modifiedData = $.extend({}, data, true);
                                                        modifiedData.text += ' ';

                                                        // You can return modified objects from here
                                                        // This includes matching the `children` how you want in nested data sets
                                                        return modifiedData;
                                                }

                                                // Return `null` if the term should not be displayed
                                                return null;
                                        }
                                };
                                $("#singleSelectExample").select2(configParamsObj);
                        });

                </script>