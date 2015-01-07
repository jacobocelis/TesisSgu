<?php
/* @var $this ChasisController */
/* @var $model Chasis */

$this->breadcrumbs=array(
	'Chasises'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Chasis', 'url'=>array('index')),
	array('label'=>'Create Chasis', 'url'=>array('create')),
	array('label'=>'Update Chasis', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Chasis', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Chasis', 'url'=>array('admin')),
);
?>

<h1>View Chasis #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre',
		'nroEjes',
		'cantidadNormales',
		'cantidadRepuesto',
	),
)); ?>
