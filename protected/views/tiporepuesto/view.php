<?php
/* @var $this TiporepuestoController */
/* @var $model Tiporepuesto */

$this->breadcrumbs=array(
	'Tiporepuestos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Tiporepuesto', 'url'=>array('index')),
	array('label'=>'Create Tiporepuesto', 'url'=>array('create')),
	array('label'=>'Update Tiporepuesto', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Tiporepuesto', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Tiporepuesto', 'url'=>array('admin')),
);
?>

<h1>View Tiporepuesto #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'tipo',
	),
)); ?>
