<?php
/* @var $this FallacauchoController */
/* @var $model Fallacaucho */

$this->breadcrumbs=array(
	'Fallacauchos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Fallacaucho', 'url'=>array('index')),
	array('label'=>'Create Fallacaucho', 'url'=>array('create')),
	array('label'=>'Update Fallacaucho', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Fallacaucho', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Fallacaucho', 'url'=>array('admin')),
);
?>

<h1>View Fallacaucho #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'falla',
	),
)); ?>
