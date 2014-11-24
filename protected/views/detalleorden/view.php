<?php
/* @var $this DetalleordenController */
/* @var $model Detalleorden */

$this->breadcrumbs=array(
	'Detalleordens'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Detalleorden', 'url'=>array('index')),
	array('label'=>'Create Detalleorden', 'url'=>array('create')),
	array('label'=>'Update Detalleorden', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Detalleorden', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Detalleorden', 'url'=>array('admin')),
);
?>

<h1>View Detalleorden #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idordenMtto',
		'idactividades',
	),
)); ?>
