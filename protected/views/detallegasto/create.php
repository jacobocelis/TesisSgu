<?php
/* @var $this DetallegastoController */
/* @var $model Detallegasto */

$this->breadcrumbs=array(
	'Detallegastos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Detallegasto', 'url'=>array('index')),
	array('label'=>'Manage Detallegasto', 'url'=>array('admin')),
);
?>

<h1>Create Detallegasto</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>