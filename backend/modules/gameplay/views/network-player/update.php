<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\gameplay\models\NetworkPlayer */

$this->title=Yii::t('app', 'Update Network Player: {name}', [
    'name' => $model->network_id,
]);
$this->params['breadcrumbs'][]=['label' => Yii::t('app', 'Network Players'), 'url' => ['index']];
$this->params['breadcrumbs'][]=['label' => $model->network_id, 'url' => ['view', 'network_id' => $model->network_id, 'player_id' => $model->player_id]];
$this->params['breadcrumbs'][]=Yii::t('app', 'Update');
?>
<div class="network-player-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
