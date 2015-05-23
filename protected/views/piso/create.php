<?php
/* @var $this PisoController */
/* @var $model Piso */

$this->breadcrumbs=array(
	'Pisos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Piso', 'url'=>array('index')),
	array('label'=>'Manage Piso', 'url'=>array('admin')),
);
?>

<h1>Create Piso</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>