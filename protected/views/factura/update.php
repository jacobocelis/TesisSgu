<?php
/* @var $this FacturaController */
/* @var $model Factura */

$this->breadcrumbs=array(
	'Facturas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Factura', 'url'=>array('index')),
	array('label'=>'Create Factura', 'url'=>array('create')),
	array('label'=>'View Factura', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Factura', 'url'=>array('admin')),
);
?>

<h1>Update Factura <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>