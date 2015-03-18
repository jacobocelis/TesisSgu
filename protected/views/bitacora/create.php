<?php
/* @var $this BitacoraController */
/* @var $model Bitacora */

$this->breadcrumbs=array(
	'Bitacoras'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Bitacora', 'url'=>array('index')),
	array('label'=>'Manage Bitacora', 'url'=>array('admin')),
);
?>

<h1>Create Bitacora</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>