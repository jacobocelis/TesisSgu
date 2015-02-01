<?php
/* @var $this RecursocauchoController */
/* @var $model Recursocaucho */

$this->breadcrumbs=array(
	'Recursocauchos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Recursocaucho', 'url'=>array('index')),
	array('label'=>'Create Recursocaucho', 'url'=>array('create')),
	array('label'=>'Update Recursocaucho', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Recursocaucho', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Recursocaucho', 'url'=>array('admin')),
);
?>

<h1>View Recursocaucho #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'recurso',
		'descripcion',
	),
)); ?>
