<?php
/* @var $this EmpleadosController */
/* @var $model Historicoempleados */

$this->breadcrumbs=array(
	'Historicoempleadoses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Historicoempleados', 'url'=>array('index')),
	array('label'=>'Create Historicoempleados', 'url'=>array('create')),
	array('label'=>'Update Historicoempleados', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Historicoempleados', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Historicoempleados', 'url'=>array('admin')),
);
?>

<h1>View Historicoempleados #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fechaInicio',
		'fechaFin',
		'idempleado',
		'idvehiculo',
	),
)); ?>
