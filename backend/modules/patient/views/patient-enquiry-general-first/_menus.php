<?php

use yii\helpers\Html;
?>

<ul class="nav nav-tabs nav-tabs-justified">

        <li class="active">
                <a href="#home-3" data-toggle="tab"><span class="visible-xs"><i class="fa-envelope-o"></i></span>
                        <span class="hidden-xs span-font-size">General Information</span></a>
        </li>

        <li>
                <a href="#profile-3" data-toggle="tab"><span class="visible-xs"><i class="fa-hospital-o"></i></span>
                        <span class="hidden-xs span-font-size">Patient Information</span></a>
        </li>


        <li>
                <a href="#settings-3" data-toggle="tab"><span class="visible-xs"><i class="fa-info-circle"></i></span>
                        <span class="hidden-xs span-font-size">Followup</span></a>
        </li>


</ul>

<script>
        $(document).ready(function () {
                var current_page = "<?php echo $followup_id; ?>";
                if (current_page != '')
                        activaTab('settings-3');
        });

        function activaTab(tab) {
                $('.nav-tabs a[href="#' + tab + '"]').tab('show');
        }
</script>