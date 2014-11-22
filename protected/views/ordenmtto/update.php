<?php
/* @var $this OrdenmttoController */
/* @var $model Ordenmtto */

$this->breadcrumbs=array(
	'Ordenmttos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Ordenmtto', 'url'=>array('index')),
	array('label'=>'Create Ordenmtto', 'url'=>array('create')),
	array('label'=>'View Ordenmtto', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Ordenmtto', 'url'=>array('admin')),
);
?>

<h1>Update Ordenmtto <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>