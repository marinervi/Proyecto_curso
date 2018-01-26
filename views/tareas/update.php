<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tareas */

$this->title = 'Actualizar Tareas: ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Tareas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_tarea, 'url' => ['view', 'id' => $model->id_tarea]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="tareas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
