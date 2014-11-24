<?php
/* @var $this DetalleordenController */
/* @var $model Detalleorden */

$this->breadcrumbs=array(
	'Detalleordens'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Detalleorden', 'url'=>array('index')),
	array('label'=>'Manage Detalleorden', 'url'=>array('admin')),
);
?>

<h1>Create Detalleorden</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>