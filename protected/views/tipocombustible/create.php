<?php
/* @var $this TipocombustibleController */
/* @var $model Tipocombustible */

$this->breadcrumbs=array(
	'Tipocombustibles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Tipocombustible', 'url'=>array('index')),
	array('label'=>'Manage Tipocombustible', 'url'=>array('admin')),
);
?>

<h1>Create Tipocombustible</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>