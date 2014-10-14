<?php
/* @var $this RepuestoController */
/* @var $model Repuesto */

$this->breadcrumbs=array(
	'Repuestos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Repuesto', 'url'=>array('index')),
	array('label'=>'Create Repuesto', 'url'=>array('create')),
	array('label'=>'View Repuesto', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Repuesto', 'url'=>array('admin')),
);
?>

<h1>Update Repuesto <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'tipo'=>$tipo)); ?>