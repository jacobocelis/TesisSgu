<?php
/* @var $this ServicioController */
/* @var $model Servicio */

$this->breadcrumbs=array(
	'Servicios'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Servicio', 'url'=>array('index')),
	array('label'=>'Create Servicio', 'url'=>array('create')),
	array('label'=>'Update Servicio', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Servicio', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Servicio', 'url'=>array('admin')),
);
?>

<h1>View Servicio #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'servicio',
	),
)); ?>
