<?php
/* @var $this InsumoController */
/* @var $model Insumo */

$this->breadcrumbs=array(
	'Insumos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Insumo', 'url'=>array('index')),
	array('label'=>'Manage Insumo', 'url'=>array('admin')),
);
?>

<h1>Create Insumo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>