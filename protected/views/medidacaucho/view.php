<?php
/* @var $this MedidacauchoController */
/* @var $model Medidacaucho */

$this->breadcrumbs=array(
	'Medidacauchos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Medidacaucho', 'url'=>array('index')),
	array('label'=>'Create Medidacaucho', 'url'=>array('create')),
	array('label'=>'Update Medidacaucho', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Medidacaucho', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Medidacaucho', 'url'=>array('admin')),
);
?>

<h1>View Medidacaucho #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'medida',
	),
)); ?>
