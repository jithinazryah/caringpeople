
<?php
/*
 * staff
 */
if ($type == 4) {
        $link = 'staff/staff-info';
} else if ($type == 2) {
        $link = 'patient/patient-information';
}
?>




<div class="col-md-3" style="float:right">
        <ul class="nav navbar-nav views">
                <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding: 4px 19px 23px 20px;height: 10px;">View <b class="caret"></b></a>
                        <ul class="dropdown-menu menu-views">
                                <li>
                                        <a href="<?= Yii::$app->homeUrl . $link ?>/view?id=<?= $type_id; ?>">View Profile</a>
                                </li>
                                <li>
                                        <a href="<?= Yii::$app->homeUrl . $link ?>/followups?id=<?= $type_id; ?>">View All Followups</a>
                                </li>
                                <?php if ($type != 2) { ?>
                                        <li>
                                                <a href="<?= Yii::$app->homeUrl . $link ?>/relatedfollowups?id=<?= $type_id; ?>">View Related Followups</a>
                                        </li>
                                <?php } ?>
                                <li>
                                        <a href="<?= Yii::$app->homeUrl . $link ?>/remarks?id=<?= $type_id; ?>">View All Remarks</a>
                                </li>

                        </ul>
                </li>
        </ul>
</div>