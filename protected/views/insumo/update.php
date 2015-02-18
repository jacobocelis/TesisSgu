<?php
/* @var $this InsumoController */
/* @var $model Insumo */

$this->breadcrumbs=array(
	'Insumos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Insumo', 'url'=>array('index')),
	array('label'=>'Create Insumo', 'url'=>array('create')),
	array('label'=>'View Insumo', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Insumo', 'url'=>array('admin')),
);
?>

<h1>Update Insumo <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>