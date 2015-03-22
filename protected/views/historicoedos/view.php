<?php
/* @var $this HistoricoedosController */
/* @var $model Historicoedos */

$this->breadcrumbs=array(
	'Historicoedoses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Historicoedos', 'url'=>array('index')),
	array('label'=>'Create Historicoedos', 'url'=>array('create')),
	array('label'=>'Update Historicoedos', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Historicoedos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Historicoedos', 'url'=>array('admin')),
);
?>

<h1>View Historicoedos #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idestado',
		'idvehiculo',
		'fecha',
		'motivo',
	),
)); ?>
