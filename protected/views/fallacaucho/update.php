<?php
/* @var $this FallacauchoController */
/* @var $model Fallacaucho */

$this->breadcrumbs=array(
	'Fallacauchos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Fallacaucho', 'url'=>array('index')),
	array('label'=>'Create Fallacaucho', 'url'=>array('create')),
	array('label'=>'View Fallacaucho', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Fallacaucho', 'url'=>array('admin')),
);
?>

<h1>Update Fallacaucho <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>