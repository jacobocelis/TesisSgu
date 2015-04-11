<?php
/* @var $this TiporepuestoController */
/* @var $model Tiporepuesto */

$this->breadcrumbs=array(
	'Tiporepuestos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Tiporepuesto', 'url'=>array('index')),
	array('label'=>'Manage Tiporepuesto', 'url'=>array('admin')),
);
?>

<h1>Create Tiporepuesto</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>