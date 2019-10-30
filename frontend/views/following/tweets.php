<?php
/*
 * @var $tweets object twitter returns
 * @screen_name attribute app\models\Following
 * */
use yii\helpers\Html;
?>
<h2><b><?=$screen_name;?></b></h2>
<h4><?='tweets';?></h4>
<hr>
<?php

/* @var $tweets object twitter returns */
foreach ($tweets as $tweet) {
            echo Html::encode($tweet->text);
            echo '<hr>';
}

