<?php
/* @var $this ActividadrecursogrupoController */
/* @var $model Actividadrecursogrupo */

$this->breadcrumbs=array(
	'Actividadrecursogrupos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Actividadrecursogrupo', 'url'=>array('index')),
	array('label'=>'Create Actividadrecursogrupo', 'url'=>array('create')),
	array('label'=>'View Actividadrecursogrupo', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Actividadrecursogrupo', 'url'=>array('admin')),
);
?>

<h1>Update Actividadrecursogrupo <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>