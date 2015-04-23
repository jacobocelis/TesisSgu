<?php
/* @var $this PosicionruedaController */
/* @var $model Posicionrueda */

$this->breadcrumbs=array(
	'Posicionruedas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Posicionrueda', 'url'=>array('index')),
	array('label'=>'Create Posicionrueda', 'url'=>array('create')),
	array('label'=>'Update Posicionrueda', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Posicionrueda', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Posicionrueda', 'url'=>array('admin')),
);
?>

<h1>View Posicionrueda #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'posicionRueda',
	),
)); ?>
