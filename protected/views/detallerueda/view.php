<?php
/* @var $this DetalleruedaController */
/* @var $model Detallerueda */

$this->breadcrumbs=array(
	'Detalleruedas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Detallerueda', 'url'=>array('index')),
	array('label'=>'Create Detallerueda', 'url'=>array('create')),
	array('label'=>'Update Detallerueda', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Detallerueda', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Detallerueda', 'url'=>array('admin')),
);
?>

<h1>View Detallerueda #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idposicionRueda',
		'iddetalleEje',
		'idcaucho',
	),
)); ?>
