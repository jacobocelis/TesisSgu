<?php
/* @var $this ViajesController */
/* @var $model Historicoviajes */

$this->breadcrumbs=array(
	'Historicoviajes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Historicoviajes', 'url'=>array('index')),
	array('label'=>'Manage Historicoviajes', 'url'=>array('admin')),
);
?>

<h1>Create Historicoviajes</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>