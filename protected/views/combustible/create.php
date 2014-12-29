<?php
/* @var $this CombustibleController */
/* @var $model Historicocombustible */

$this->breadcrumbs=array(
	'Historicocombustibles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Historicocombustible', 'url'=>array('index')),
	array('label'=>'Manage Historicocombustible', 'url'=>array('admin')),
);
?>

<h1>Create Historicocombustible</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>