<?php
/* @var $this LugarController */
/* @var $model Lugar */

$this->breadcrumbs=array(
	'Lugars'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Lugar', 'url'=>array('index')),
	array('label'=>'Manage Lugar', 'url'=>array('admin')),
);
?>

<h1>Create Lugar</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>