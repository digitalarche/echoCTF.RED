<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\activity\models\Headshot */

$this->title=Yii::t('app', 'Create Headshot');
$this->params['breadcrumbs'][]=['label' => Yii::t('app', 'Headshots'), 'url' => ['index']];
$this->params['breadcrumbs'][]=$this->title;
?>
<div class="headshot-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
