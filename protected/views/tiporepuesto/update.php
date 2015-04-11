<?php
/* @var $this TiporepuestoController */
/* @var $model Tiporepuesto */

$this->breadcrumbs=array(
	'Tiporepuestos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Tiporepuesto', 'url'=>array('index')),
	array('label'=>'Create Tiporepuesto', 'url'=>array('create')),
	array('label'=>'View Tiporepuesto', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Tiporepuesto', 'url'=>array('admin')),
);
?>

<h1>Update Tiporepuesto <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>