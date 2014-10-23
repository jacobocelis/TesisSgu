<?php
/* @var $this RepuestoController */
/* @var $model Repuesto */

$this->breadcrumbs=array(
	'piezas'=>array('index'),
	'Registrar',
);

$this->menu=array(
	array('label'=>'Listar piezas', 'url'=>array('index')),
	array('label'=>'Administrar piezas', 'url'=>array('admin')),
);
?>

<h1>Registrar pieza</h1>

<?php $this->renderPartial('_form', array('model'=>$model,'tipo'=>$tipo)); ?>