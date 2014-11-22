<?php
/* @var $this DetalleactController */
/* @var $model Detalleact */

$this->breadcrumbs=array(
	'Detalleacts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Detalleact', 'url'=>array('index')),
	array('label'=>'Create Detalleact', 'url'=>array('create')),
	array('label'=>'Update Detalleact', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Detalleact', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Detalleact', 'url'=>array('admin')),
);
?>

<h1>View Detalleact #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idfactura',
		'iddetallleOrden',
	),
)); ?>
