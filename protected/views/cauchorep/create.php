<?php
/* @var $this CauchorepController */
/* @var $model Cauchorep */

$this->breadcrumbs=array(
	'Cauchoreps'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Cauchorep', 'url'=>array('index')),
	array('label'=>'Manage Cauchorep', 'url'=>array('admin')),
);
?>

<h1>Create Cauchorep</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>