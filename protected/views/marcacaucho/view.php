<?php
/* @var $this MarcacauchoController */
/* @var $model Marcacaucho */

$this->breadcrumbs=array(
	'Marcacauchos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Marcacaucho', 'url'=>array('index')),
	array('label'=>'Create Marcacaucho', 'url'=>array('create')),
	array('label'=>'Update Marcacaucho', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Marcacaucho', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Marcacaucho', 'url'=>array('admin')),
);
?>

<h1>View Marcacaucho #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre',
	),
)); ?>
