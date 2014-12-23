<?php
/* @var $this ReportefallaController */
/* @var $model Reportefalla */

$this->breadcrumbs=array(
	'Reportefallas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Reportefalla', 'url'=>array('index')),
	array('label'=>'Manage Reportefalla', 'url'=>array('admin')),
);
?>

<h1>Create Reportefalla</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>