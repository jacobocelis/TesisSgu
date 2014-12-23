<?php
/* @var $this ReportefallaController */
/* @var $model Reportefalla */

$this->breadcrumbs=array(
	'Reportefallas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Reportefalla', 'url'=>array('index')),
	array('label'=>'Create Reportefalla', 'url'=>array('create')),
	array('label'=>'Update Reportefalla', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Reportefalla', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Reportefalla', 'url'=>array('admin')),
);
?>

<h1>View Reportefalla #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'detalle',
		'fechaFalla',
		'fechaRealizada',
		'kmRealizada',
		'diasParo',
		'idtiempo',
		'idvehiculo',
		'idempleado',
		'idfalla',
		'idestatus',
	),
)); ?>
