<?php
/* @var $this ViajeController */
/* @var $model Viaje */

$this->breadcrumbs=array(
	'Viajes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Viaje', 'url'=>array('index')),
	array('label'=>'Create Viaje', 'url'=>array('create')),
	array('label'=>'View Viaje', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Viaje', 'url'=>array('admin')),
);
?>

<h1>Update Viaje <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>