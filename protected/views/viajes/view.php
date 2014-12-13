<?php
/* @var $this ViajesController */
/* @var $model Historicoviajes */

$this->breadcrumbs=array(
	'Historicoviajes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Historicoviajes', 'url'=>array('index')),
	array('label'=>'Create Historicoviajes', 'url'=>array('create')),
	array('label'=>'Update Historicoviajes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Historicoviajes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Historicoviajes', 'url'=>array('admin')),
);
?>

<h1>View Historicoviajes #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fecha',
		'horaSalida',
		'horaLlegada',
		'idviaje',
		'idvehiculo',
	),
)); ?>
