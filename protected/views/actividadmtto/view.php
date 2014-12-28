<?php
/* @var $this ActividadmttoController */
/* @var $model Actividadmtto */

$this->breadcrumbs=array(
	'Actividadmttos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Actividadmtto', 'url'=>array('index')),
	array('label'=>'Create Actividadmtto', 'url'=>array('create')),
	array('label'=>'Update Actividadmtto', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Actividadmtto', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Actividadmtto', 'url'=>array('admin')),
);
?>

<h1>View Actividadmtto #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'actividad',
	),
)); ?>
