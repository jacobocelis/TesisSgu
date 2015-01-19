<?php
/* @var $this FallacauchoController */
/* @var $model Fallacaucho */

$this->breadcrumbs=array(
	'Fallacauchos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Fallacaucho', 'url'=>array('index')),
	array('label'=>'Manage Fallacaucho', 'url'=>array('admin')),
);
?>

<h1>Create Fallacaucho</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>