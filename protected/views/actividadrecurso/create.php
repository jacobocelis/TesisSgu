<?php
/* @var $this ActividadrecursoController */
/* @var $model Actividadrecurso */

$this->breadcrumbs=array(
	'Actividadrecursos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Actividadrecurso', 'url'=>array('index')),
	array('label'=>'Manage Actividadrecurso', 'url'=>array('admin')),
);
?>

<h1>Create Actividadrecurso</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>