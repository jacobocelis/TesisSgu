<?php
/* @var $this DetallegastoController */
/* @var $model Detallegasto */

$this->breadcrumbs=array(
	'Detallegastos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Detallegasto', 'url'=>array('index')),
	array('label'=>'Create Detallegasto', 'url'=>array('create')),
	array('label'=>'Update Detallegasto', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Detallegasto', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Detallegasto', 'url'=>array('admin')),
);
?>

<h1>View Detallegasto #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'material',
		'costoUnitario',
		'cantidad',
		'total',
		'iddetalleAct',
	),
)); ?>
