<?php
/* @var $this PisoController */
/* @var $model Piso */

$this->breadcrumbs=array(
	'Pisos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Piso', 'url'=>array('index')),
	array('label'=>'Create Piso', 'url'=>array('create')),
	array('label'=>'Update Piso', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Piso', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Piso', 'url'=>array('admin')),
);
?>

<h1>View Piso #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'piso',
	),
)); ?>
