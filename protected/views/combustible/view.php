<?php
/* @var $this CombustibleController */
/* @var $model Historicocombustible */

$this->breadcrumbs=array(
	'Historicocombustibles'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Historicocombustible', 'url'=>array('index')),
	array('label'=>'Create Historicocombustible', 'url'=>array('create')),
	array('label'=>'Update Historicocombustible', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Historicocombustible', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Historicocombustible', 'url'=>array('admin')),
);
?>

<h1>View Historicocombustible #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fecha',
		'litros',
		'costoTotal',
		'idestacionServicio',
		'idconductor',
		'idvehiculo',
	),
)); ?>
