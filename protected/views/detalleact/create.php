<?php
/* @var $this DetalleactController */
/* @var $model Detalleact */

$this->breadcrumbs=array(
	'Detalleacts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Detalleact', 'url'=>array('index')),
	array('label'=>'Manage Detalleact', 'url'=>array('admin')),
);
?>

<h1>Create Detalleact</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>