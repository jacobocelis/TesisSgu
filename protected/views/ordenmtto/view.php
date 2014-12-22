<?php
/* @var $this OrdenmttoController */
/* @var $model Ordenmtto */

$this->breadcrumbs=array(
	'Ordenmttos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Ordenmtto', 'url'=>array('index')),
	array('label'=>'Create Ordenmtto', 'url'=>array('create')),
	array('label'=>'Update Ordenmtto', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Ordenmtto', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Ordenmtto', 'url'=>array('admin')),
);
?>

<h1>View Ordenmtto #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fecha',
		'tipo',
		'idestatus',
		'taller',
		'cOperativo',
		'cTaller',
	),
)); ?>
