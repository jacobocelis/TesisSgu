<?php
/* @var $this OrdenmttoController */
/* @var $model Ordenmtto */

$this->breadcrumbs=array(
	'Ordenmttos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Ordenmtto', 'url'=>array('index')),
	array('label'=>'Manage Ordenmtto', 'url'=>array('admin')),
);
?>

<h1>Create Ordenmtto</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>