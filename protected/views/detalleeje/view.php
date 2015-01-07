<?php
/* @var $this DetalleejeController */
/* @var $model Detalleeje */

$this->breadcrumbs=array(
	'Detalleejes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Detalleeje', 'url'=>array('index')),
	array('label'=>'Create Detalleeje', 'url'=>array('create')),
	array('label'=>'Update Detalleeje', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Detalleeje', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Detalleeje', 'url'=>array('admin')),
);
?>

<h1>View Detalleeje #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nroRuedas',
		'idchasis',
		'idposicionEje',
		'nombre',
	),
)); ?>
