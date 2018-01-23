<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';

use app\assets\MainAsset;

MainAsset::register($this);
?>


<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <p class="h2 pt-4" style={{'fontWeight': '600'}}>Smart Door</p>
            <p class="h5 pt-1 text-muted">Professional IT</p>
        </div>

        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <div class="col-12">
            <p>
                <a href="<?= \yii\helpers\Url::to('/profile', true) ?>"
                   class="btn btn-outline-primary btn-block btn-sm">Gurban Gurbanov</a>
            </p>
            <p>

            <form action="<?=\yii\helpers\Url::to('/logout', true)?>" method="post">
                <input type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->csrfToken?>"/>
                <button type="submit" class="btn btn-outline-danger btn-block btn-sm js-logout-btn">Log out</button>
            </form>

            <script>
                $(document).ready(function () {
                    $('.js-logout-btn').on('click', function () {
                        return confirm('Are you sure?');
                    });
                });
            </script>
            </p>
        </div>

        <div class="col-12 text-center mt-5">
        </div>
    </div>
</div>