<?php
/* @var $this FacturaController */
/* @var $model Factura */

$this->breadcrumbs=array(
	'Facturas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Factura', 'url'=>array('index')),
	array('label'=>'Create Factura', 'url'=>array('create')),
	array('label'=>'Update Factura', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Factura', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Factura', 'url'=>array('admin')),
);
?>

<h1>View Factura #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fechaFactura',
		'codigo',
		'idproveedor',
		'idordenMtto',
		'total',
		'iva',
		'totalFactura',
	),
)); ?>
