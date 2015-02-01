<?php
/* @var $this RecursocauchoController */
/* @var $model Recursocaucho */

$this->breadcrumbs=array(
	'Recursocauchos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Recursocaucho', 'url'=>array('index')),
	array('label'=>'Create Recursocaucho', 'url'=>array('create')),
	array('label'=>'View Recursocaucho', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Recursocaucho', 'url'=>array('admin')),
);
?>

<h1>Update Recursocaucho <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>