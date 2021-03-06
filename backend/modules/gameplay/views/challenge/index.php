<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\gameplay\models\ChallengeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title=ucfirst(Yii::$app->controller->module->id).' / '.ucfirst(Yii::$app->controller->id);
$this->params['breadcrumbs'][]=$this->title;
?>
<div class="challenge-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Challenge', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            'name',
            'category',
            'difficulty',
            'description:ntext',
            [
              'attribute'=>'player_type',
              'filter'=>['offense'=>'Offense', 'defense'=>'Defense', 'both'=>'Both'],
            ],
            //'file:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);?>


</div>
