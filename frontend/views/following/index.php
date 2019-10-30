<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Followings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="following-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Search Twitter Users', ['search-user'], ['class' => 'btn btn-success']) ?>
    </p>

<!--    --><?php
//    echo '<pre>';
//
//    echo '</pre>';
//    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'screen_name',

            ['class' => 'yii\grid\ActionColumn'],
            [
                'label' => 'Get tweets',
                'format' => 'raw',
                'value' => function($data){
                    return Html::a('GetTweets',['get-tweets','screen_name'=>$data->screen_name], ['class' => 'btn btn-success']);
                }
            ],
        ],
    ]); ?>


</div>
