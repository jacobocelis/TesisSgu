<?php
/* @var $this ViajeController */
/* @var $model Viaje */

$this->breadcrumbs=array(
	'Viajes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Viaje', 'url'=>array('index')),
	array('label'=>'Manage Viaje', 'url'=>array('admin')),
);
?>

<h1>Create Viaje</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>