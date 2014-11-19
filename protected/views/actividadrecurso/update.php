<?php
/* @var $this ActividadrecursoController */
/* @var $model Actividadrecurso */

$this->breadcrumbs=array(
	'Actividadrecursos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Actividadrecurso', 'url'=>array('index')),
	array('label'=>'Create Actividadrecurso', 'url'=>array('create')),
	array('label'=>'View Actividadrecurso', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Actividadrecurso', 'url'=>array('admin')),
);
?>

<h1>Update Actividadrecurso <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>