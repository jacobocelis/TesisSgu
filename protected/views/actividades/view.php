<?php
/* @var $this ActividadesController */
/* @var $model Actividades */

$this->breadcrumbs=array(
	'Actividades'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Actividades', 'url'=>array('index')),
	array('label'=>'Create Actividades', 'url'=>array('create')),
	array('label'=>'Update Actividades', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Actividades', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Actividades', 'url'=>array('admin')),
);
?>

<h1>View Actividades #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'actividad',
		'ultimoKm',
		'ultimoFecha',
		'frecuenciaKm',
		'frecuenciaMes',
		'proximoKm',
		'proximoFecha',
		'atraso',
		'idprioridad',
		'idplan',
	),
)); ?>
