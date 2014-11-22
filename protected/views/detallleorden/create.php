<?php
/* @var $this DetallleordenController */
/* @var $model Detallleorden */

$this->breadcrumbs=array(
	'Detallleordens'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Detallleorden', 'url'=>array('index')),
	array('label'=>'Manage Detallleorden', 'url'=>array('admin')),
);
?>

<h1>Create Detallleorden</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>