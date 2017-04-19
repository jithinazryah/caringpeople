

<div class="mkdf-404-image error-img">
        <img src="<?= Yii::$app->homeUrl; ?>images/gallery/error.jpg" alt="404" />
        <div class="error-cntnt">
                <h1 style="color: white;">
                        Page Under Construction
                </h1>
                <a href="<?= Yii::$app->homeUrl; ?>home" target="_self" class="mkdf-btn mkdf-btn-medium mkdf-btn-solid mkdf-btn-hover-outline">

                        <span class="mkdf-btn-text">Back to Home Page</span>
                </a>
        </div>
</div>
<style>
        .error-img{
                position: relative;
        }
        .error-cntnt{
                position: absolute;
                z-index: 900000;
                top: 30%;
                left: 37%;
                text-align: center;
        }
</style>