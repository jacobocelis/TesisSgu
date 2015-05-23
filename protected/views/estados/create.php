<?php
/* @var $this EstadosController */
/* @var $model Estados */

$this->breadcrumbs=array(
	'Estadoses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Estados', 'url'=>array('index')),
	array('label'=>'Manage Estados', 'url'=>array('admin')),
);
?>

<h1>Create Estados</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>