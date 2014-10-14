<?php
/* @var $this RepuestoController */
/* @var $model Repuesto */

$this->breadcrumbs=array(
	'Repuestos'=>array('index'),
	'Registrar',
);

$this->menu=array(
	array('label'=>'Listar repuestos', 'url'=>array('index')),
	array('label'=>'Administrar repuestos', 'url'=>array('admin')),
);
?>

<h1>Registrar repuesto</h1>

<?php $this->renderPartial('_form', array('model'=>$model,'tipo'=>$tipo)); ?>