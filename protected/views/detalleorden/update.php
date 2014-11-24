<?php
/* @var $this DetalleordenController */
/* @var $model Detalleorden */

$this->breadcrumbs=array(
	'Detalleordens'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Detalleorden', 'url'=>array('index')),
	array('label'=>'Create Detalleorden', 'url'=>array('create')),
	array('label'=>'View Detalleorden', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Detalleorden', 'url'=>array('admin')),
);
?>

<h1>Update Detalleorden <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>