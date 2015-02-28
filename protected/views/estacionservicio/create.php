<?php
/* @var $this EstacionservicioController */
/* @var $model Estacionservicio */

$this->breadcrumbs=array(
	'Estacionservicios'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Estacionservicio', 'url'=>array('index')),
	array('label'=>'Manage Estacionservicio', 'url'=>array('admin')),
);
?>

<h1>Create Estacionservicio</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>