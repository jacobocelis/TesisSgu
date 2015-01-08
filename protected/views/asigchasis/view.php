<?php
/* @var $this AsigchasisController */
/* @var $model Asigchasis */

$this->breadcrumbs=array(
	'Asigchasises'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Asigchasis', 'url'=>array('index')),
	array('label'=>'Create Asigchasis', 'url'=>array('create')),
	array('label'=>'Update Asigchasis', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Asigchasis', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Asigchasis', 'url'=>array('admin')),
);
?>

<h1>View Asigchasis #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idchasis',
		'idgrupo',
	),
)); ?>
