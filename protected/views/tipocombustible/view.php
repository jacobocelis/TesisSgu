<?php
/* @var $this TipocombustibleController */
/* @var $model Tipocombustible */

$this->breadcrumbs=array(
	'Tipocombustibles'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Tipocombustible', 'url'=>array('index')),
	array('label'=>'Create Tipocombustible', 'url'=>array('create')),
	array('label'=>'Update Tipocombustible', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Tipocombustible', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Tipocombustible', 'url'=>array('admin')),
);
?>

<h1>View Tipocombustible #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'combustible',
	),
)); ?>
