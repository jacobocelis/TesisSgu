<?php
/* @var $this InfgrupoController */
/* @var $model Infgrupo */

$this->breadcrumbs=array(
	'Infgrupos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Infgrupo', 'url'=>array('index')),
	array('label'=>'Create Infgrupo', 'url'=>array('create')),
	array('label'=>'Update Infgrupo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Infgrupo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Infgrupo', 'url'=>array('admin')),
);
?>

<h1>View Infgrupo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'informacion',
		'idgrupo',
	),
)); ?>
