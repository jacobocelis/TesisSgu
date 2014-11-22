<?php
/* @var $this DetallleordenController */
/* @var $model Detallleorden */

$this->breadcrumbs=array(
	'Detallleordens'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Detallleorden', 'url'=>array('index')),
	array('label'=>'Create Detallleorden', 'url'=>array('create')),
	array('label'=>'Update Detallleorden', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Detallleorden', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Detallleorden', 'url'=>array('admin')),
);
?>

<h1>View Detallleorden #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idactividades',
		'idordenMtto',
	),
)); ?>
