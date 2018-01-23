<?php

/* @var $this yii\web\View */

$this->title = 'Smart Door - Professional IT';

use app\assets\MainAsset;

MainAsset::register($this);
?>


<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <p class="h2 pt-4">Smart Door</p>
            <p class="h5 pt-1 text-muted">Professional IT</p>
        </div>

        <div class="col-12 text-center">
            <div class="row">
                <div class="col-12 text-center mt-4">
                    <div class="lock lock__closed">

                        <i class="fa lock__icon" aria-hidden="true"></i>
                        <span class="text-muted">Opening...</span>

                        <div class="lock__wave lock__wave_1"></div>
                    </div>
                </div>

                <div class="col-12 text-center mt-3">
                    <p style="color: #999;">Tap to open</p>
                </div>

                <div class="col-12 text-center">
                    <p class="text-muted" style="font-size: 13px;">⚠ You have to be in front of the door ⚠</p>
                </div>
            </div>
        </div>

        <div class="col-sm-6 offset-sm-3 pb-2">
            <div class="row">
                <div class="col-12">
                    <hr>
                </div>
                <div class="col-8">
                    <span class="username"><?= Yii::$app->user->identity->firstname . ' ' . Yii::$app->user->identity->lastname ?></span><br>
                    <span class="user-email"><?= Yii::$app->user->identity->username ?></span>
                </div>

                <div class="col-4 text-right">
                    <form action="<?= \yii\helpers\Url::to('/logout', true) ?>" method="post">
                        <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>"
                               value="<?= Yii::$app->request->csrfToken ?>"/>
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
            </div>
        </div>
    </div>
</div>