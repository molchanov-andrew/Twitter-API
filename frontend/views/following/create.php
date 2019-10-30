<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Following */
/*$users array objects twitter users*/

$this->title = 'Choose Following';
$this->params['breadcrumbs'][] = ['label' => 'Followings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="following-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="following-form">

        <?php if ($users) {
            foreach ($users as $user) {
                echo Html::a(Html::encode($user->name) . ' -> @' . Html::encode($user->screen_name), ['following/save-choose-user', 'screen_name' => $user->screen_name]);
                echo "<br>";
            }
        } ?>
        <?= $this->render('_form', ['model' => $model, 'users' => $users]) ?>

    </div>
