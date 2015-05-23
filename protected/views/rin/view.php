<?php
/* @var $this RinController */
/* @var $model Rin */

$this->breadcrumbs=array(
	'Rins'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Rin', 'url'=>array('index')),
	array('label'=>'Create Rin', 'url'=>array('create')),
	array('label'=>'Update Rin', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Rin', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Rin', 'url'=>array('admin')),
);
?>

<h1>View Rin #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'rin',
	),
)); ?>
