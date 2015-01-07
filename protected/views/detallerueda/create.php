<?php
/* @var $this DetalleruedaController */
/* @var $model Detallerueda */

$this->breadcrumbs=array(
	'Detalleruedas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Detallerueda', 'url'=>array('index')),
	array('label'=>'Manage Detallerueda', 'url'=>array('admin')),
);
?>

<h1>Create Detallerueda</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>