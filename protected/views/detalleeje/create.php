<?php
/* @var $this DetalleejeController */
/* @var $model Detalleeje */

$this->breadcrumbs=array(
	'Detalleejes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Detalleeje', 'url'=>array('index')),
	array('label'=>'Manage Detalleeje', 'url'=>array('admin')),
);
?>

<h1>Create Detalleeje</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>