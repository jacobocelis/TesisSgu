<?php
/* @var $this RotacioncauchosController */
/* @var $model Rotacioncauchos */

$this->breadcrumbs=array(
	'Rotacioncauchoses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Rotacioncauchos', 'url'=>array('index')),
	array('label'=>'Create Rotacioncauchos', 'url'=>array('create')),
	array('label'=>'Update Rotacioncauchos', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Rotacioncauchos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Rotacioncauchos', 'url'=>array('admin')),
);
?>

<h1>View Rotacioncauchos #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre',
		'descripcion',
		'costoTotal',
		'fechaRealizada',
		'idestatus',
	),
)); ?>
