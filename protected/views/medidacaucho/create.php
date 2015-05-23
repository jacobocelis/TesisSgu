<?php
/* @var $this MedidacauchoController */
/* @var $model Medidacaucho */

$this->breadcrumbs=array(
	'Medidacauchos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Medidacaucho', 'url'=>array('index')),
	array('label'=>'Manage Medidacaucho', 'url'=>array('admin')),
);
?>

<h1>Create Medidacaucho</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>