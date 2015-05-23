<?php
/* @var $this PisoController */
/* @var $model Piso */

$this->breadcrumbs=array(
	'Pisos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Piso', 'url'=>array('index')),
	array('label'=>'Create Piso', 'url'=>array('create')),
	array('label'=>'View Piso', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Piso', 'url'=>array('admin')),
);
?>

<h1>Update Piso <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>