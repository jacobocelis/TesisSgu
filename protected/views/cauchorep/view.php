<?php
/* @var $this CauchorepController */
/* @var $model Cauchorep */

$this->breadcrumbs=array(
	'Cauchoreps'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Cauchorep', 'url'=>array('index')),
	array('label'=>'Create Cauchorep', 'url'=>array('create')),
	array('label'=>'Update Cauchorep', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Cauchorep', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Cauchorep', 'url'=>array('admin')),
);
?>

<h1>View Cauchorep #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idchasis',
		'idcaucho',
	),
)); ?>
