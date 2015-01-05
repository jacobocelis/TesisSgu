<?php
/* @var $this NeumaticosController */
/* @var $model Historicocaucho */

$this->breadcrumbs=array(
	'Historicocauchos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Historicocaucho', 'url'=>array('index')),
	array('label'=>'Create Historicocaucho', 'url'=>array('create')),
	array('label'=>'Update Historicocaucho', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Historicocaucho', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Historicocaucho', 'url'=>array('admin')),
);
?>

<h1>View Historicocaucho #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fecha',
		'serial',
		'idestatusCaucho',
		'idcaucho',
		'idmarcaCaucho',
		'idposicionEje',
		'idposicionRueda',
		'idvehiculo',
	),
)); ?>
