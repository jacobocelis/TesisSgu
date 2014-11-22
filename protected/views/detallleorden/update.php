<?php
/* @var $this DetallleordenController */
/* @var $model Detallleorden */

$this->breadcrumbs=array(
	'Detallleordens'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Detallleorden', 'url'=>array('index')),
	array('label'=>'Create Detallleorden', 'url'=>array('create')),
	array('label'=>'View Detallleorden', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Detallleorden', 'url'=>array('admin')),
);
?>

<h1>Update Detallleorden <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>