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

        <div class="col-8">
            <span class="username"><?=Yii::$app->user->identity->firstname . ' ' . Yii::$app->user->identity->lastname?></span>
            <span class="user-email"><?=Yii::$app->user->identity->username?></span>
        </div>

        <div class="col-4">
            <form action="<?=\yii\helpers\Url::to('/logout', true)?>" method="post">
                <input type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->csrfToken?>"/>
                <button type="submit" class="btn btn-link text-danger btn-sm js-logout-btn">Log out</button>
            </form>
            <script>
                $(document).ready(function () {
                    $('.js-logout-btn').on('click', function () {
                        return confirm('Are you sure?');
                    });
                });
            </script>
        </div>

        <div class="col-12 text-center mt-5">
        </div>
    </div>
</div>