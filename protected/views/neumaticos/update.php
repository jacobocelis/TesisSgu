<?php
/* @var $this NeumaticosController */
/* @var $model Historicocaucho */

$this->breadcrumbs=array(
	'Historicocauchos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Historicocaucho', 'url'=>array('index')),
	array('label'=>'Create Historicocaucho', 'url'=>array('create')),
	array('label'=>'View Historicocaucho', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Historicocaucho', 'url'=>array('admin')),
);
?>

<h1>Update Historicocaucho <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>