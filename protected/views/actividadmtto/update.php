<?php
/* @var $this ActividadmttoController */
/* @var $model Actividadmtto */

$this->breadcrumbs=array(
	'Actividadmttos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Actividadmtto', 'url'=>array('index')),
	array('label'=>'Create Actividadmtto', 'url'=>array('create')),
	array('label'=>'View Actividadmtto', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Actividadmtto', 'url'=>array('admin')),
);
?>

<h1>Update Actividadmtto <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>