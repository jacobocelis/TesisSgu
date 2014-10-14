<?php
/* @var $this InformacionController */
/* @var $model Informacion */

$this->breadcrumbs=array(
	'Informacions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Informacion', 'url'=>array('index')),
	array('label'=>'Create Informacion', 'url'=>array('create')),
	array('label'=>'Update Informacion', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Informacion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Informacion', 'url'=>array('admin')),
);
?>

<h1>View Informacion #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'informacion',
		'descripcion',
		'idvehiculo',
	),
)); ?>
