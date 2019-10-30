<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'screen_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>