<?php
/* @var $this InsumoController */
/* @var $model Insumo */

$this->breadcrumbs=array(
	'Insumos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Insumo', 'url'=>array('index')),
	array('label'=>'Create Insumo', 'url'=>array('create')),
	array('label'=>'Update Insumo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Insumo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Insumo', 'url'=>array('admin')),
);
?>

<h1>View Insumo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'insumo',
		'tipoInsumo',
	),
)); ?>
