<?php
/* @var $this ViajeController */
/* @var $model Viaje */

$this->breadcrumbs=array(
	'Viajes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Viaje', 'url'=>array('index')),
	array('label'=>'Create Viaje', 'url'=>array('create')),
	array('label'=>'Update Viaje', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Viaje', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Viaje', 'url'=>array('admin')),
);
?>

<h1>View Viaje #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'distanciaKm',
		'idOrigen',
		'idDestino',
		'idtipo',
		'viaje',
	),
)); ?>
