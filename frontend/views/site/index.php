<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <?php if (Yii::$app->user->isGuest): ?>
        <h1>Register with Twitter</h1>
        <?= yii\authclient\widgets\AuthChoice::widget(['baseAuthUrl' => ['site/auth'], 'popupMode' => false,]) ?>

    <?php else: ?>
        <h1>Hi  <?= Yii::$app->user->identity->username; ?></h1>
    <?php endif; ?>
</div>
