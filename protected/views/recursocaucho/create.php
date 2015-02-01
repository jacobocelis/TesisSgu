<?php
/* @var $this RecursocauchoController */
/* @var $model Recursocaucho */

$this->breadcrumbs=array(
	'Recursocauchos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Recursocaucho', 'url'=>array('index')),
	array('label'=>'Manage Recursocaucho', 'url'=>array('admin')),
);
?>

<h1>Create Recursocaucho</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>