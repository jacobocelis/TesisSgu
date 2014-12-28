<?php
/* @var $this ActividadmttoController */
/* @var $model Actividadmtto */

$this->breadcrumbs=array(
	'Actividadmttos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Actividadmtto', 'url'=>array('index')),
	array('label'=>'Manage Actividadmtto', 'url'=>array('admin')),
);
?>

<h1>Create Actividadmtto</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>