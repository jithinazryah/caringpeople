<?php

use yii\helpers\Html;
?>


<ul class="nav nav-tabs nav-tabs-justified">
    <li class="active">
        <a href="#home-3" data-toggle="tab"><span class="visible-xs"><i class="fa-envelope-o"></i></span>
            <span class="hidden-xs span-font-size">Patient Information</span></a>
    </li>

    <li>
        <a href="#profile-3" data-toggle="tab"><span class="visible-xs"><i class="fa-info-circle"></i></span>
            <span class="hidden-xs span-font-size">Patient Chronic Info</span></a>
    </li>
    <li>
        <a href="#medication" data-toggle="tab"><span class="visible-xs"><i class="fa-info-circle"></i></span>
            <span class="hidden-xs span-font-size">Present Medication</span></a>
    </li>
    <li>
        <a href="#condition" data-toggle="tab"><span class="visible-xs"><i class="fa-info-circle"></i></span>
            <span class="hidden-xs span-font-size">Present Condition</span></a>
    </li>
    <li>
        <a href="#bystander" data-toggle="tab"><span class="visible-xs"><i class="fa-info-circle"></i></span>
            <span class="hidden-xs span-font-size">Bystander Details</span></a>
    </li>
</ul>


<script>
    $(document).ready(function () {
        var current_page = "<?php echo $followup_id; ?>";
        if (current_page != '')
            activaTab('profile-3');
    });

    function activaTab(tab) {
        $('.nav-tabs a[href="#' + tab + '"]').tab('show');
    }
</script>