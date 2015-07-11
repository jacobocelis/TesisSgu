<?php
/* @var $this MetasController */
/* @var $model Metas */

$this->breadcrumbs=array(
	'Metases'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Metas', 'url'=>array('index')),
	array('label'=>'Create Metas', 'url'=>array('create')),
	array('label'=>'Update Metas', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Metas', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Metas', 'url'=>array('admin')),
);
?>

<h1>View Metas #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'TMEF',
		'TMPR',
		'DISP',
	),
)); ?>
