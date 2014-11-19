<?php
/* @var $this ActividadrecursogrupoController */
/* @var $model Actividadrecursogrupo */

$this->breadcrumbs=array(
	'Actividadrecursogrupos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Actividadrecursogrupo', 'url'=>array('index')),
	array('label'=>'Manage Actividadrecursogrupo', 'url'=>array('admin')),
);
?>

<h1>Create Actividadrecursogrupo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>