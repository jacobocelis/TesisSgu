<?php
/* @var $this CauchoController */
/* @var $model Caucho */

$this->breadcrumbs=array(
	'Cauchos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Caucho', 'url'=>array('index')),
	array('label'=>'Create Caucho', 'url'=>array('create')),
	array('label'=>'Update Caucho', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Caucho', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Caucho', 'url'=>array('admin')),
);
?>

<h1>View Caucho #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idmedidaCaucho',
		'idrin',
		'idpiso',
	),
)); ?>
