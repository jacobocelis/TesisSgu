<?php
/* @var $this CauchorepController */
/* @var $model Cauchorep */

$this->breadcrumbs=array(
	'Cauchoreps'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Cauchorep', 'url'=>array('index')),
	array('label'=>'Create Cauchorep', 'url'=>array('create')),
	array('label'=>'View Cauchorep', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Cauchorep', 'url'=>array('admin')),
);
?>

<h1>Update Cauchorep <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>