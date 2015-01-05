<?php
/* @var $this NeumaticosController */
/* @var $model Historicocaucho */

$this->breadcrumbs=array(
	'Historicocauchos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Historicocaucho', 'url'=>array('index')),
	array('label'=>'Manage Historicocaucho', 'url'=>array('admin')),
);
?>

<h1>Create Historicocaucho</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>