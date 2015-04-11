<?php
/* @var $this SubtiporepuestoController */
/* @var $model Subtiporepuesto */

$this->breadcrumbs=array(
	'Subtiporepuestos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Subtiporepuesto', 'url'=>array('index')),
	array('label'=>'Create Subtiporepuesto', 'url'=>array('create')),
	array('label'=>'Update Subtiporepuesto', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Subtiporepuesto', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Subtiporepuesto', 'url'=>array('admin')),
);
?>

<h1>View Subtiporepuesto #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idTipoRepuesto',
		'subTipo',
	),
)); ?>
