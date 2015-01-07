<?php
/* @var $this DetalleejeController */
/* @var $model Detalleeje */

$this->breadcrumbs=array(
	'Detalleejes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Detalleeje', 'url'=>array('index')),
	array('label'=>'Create Detalleeje', 'url'=>array('create')),
	array('label'=>'View Detalleeje', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Detalleeje', 'url'=>array('admin')),
);
?>

<h1>Update Detalleeje <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>