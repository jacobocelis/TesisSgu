<?php
/* @var $this InformacionController */
/* @var $model Informacion */

$this->breadcrumbs=array(
	'Informacions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Informacion', 'url'=>array('index')),
	array('label'=>'Manage Informacion', 'url'=>array('admin')),
);
?>

<h1>Create Informacion</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>