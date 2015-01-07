<?php
/* @var $this PosicionejeController */
/* @var $model Posicioneje */

$this->breadcrumbs=array(
	'Posicionejes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Posicioneje', 'url'=>array('index')),
	array('label'=>'Create Posicioneje', 'url'=>array('create')),
	array('label'=>'Update Posicioneje', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Posicioneje', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Posicioneje', 'url'=>array('admin')),
);
?>

<h1>View Posicioneje #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'posicionEje',
	),
)); ?>
