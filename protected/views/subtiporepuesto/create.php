<?php
/* @var $this SubtiporepuestoController */
/* @var $model Subtiporepuesto */

$this->breadcrumbs=array(
	'Subtiporepuestos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Subtiporepuesto', 'url'=>array('index')),
	array('label'=>'Manage Subtiporepuesto', 'url'=>array('admin')),
);
?>

<h1>Create Subtiporepuesto</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>