<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tareas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tareas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Tareas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider, 
        'columns' => [
            'id_tarea',
            'nombre',
            'descripcion',
            'categoria',
            'prioridad',
            'fecha_inicio',
            'fecha_fin',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
     
</div>
