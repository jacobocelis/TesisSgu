<?php
/* @var $this FeriadoController */
/* @var $model Feriado */

$this->breadcrumbs=array(
	'Feriados'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Feriado', 'url'=>array('index')),
	array('label'=>'Create Feriado', 'url'=>array('create')),
	array('label'=>'Update Feriado', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Feriado', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Feriado', 'url'=>array('admin')),
);
?>

<h1>View Feriado #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'descripcion',
		'fechaInicio',
		'fechaFin',
	),
)); ?>
