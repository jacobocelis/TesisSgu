<?php
/* @var $this SubtiporepuestoController */
/* @var $model Subtiporepuesto */

$this->breadcrumbs=array(
	'Subtiporepuestos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Subtiporepuesto', 'url'=>array('index')),
	array('label'=>'Create Subtiporepuesto', 'url'=>array('create')),
	array('label'=>'View Subtiporepuesto', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Subtiporepuesto', 'url'=>array('admin')),
);
?>

<h1>Update Subtiporepuesto <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>