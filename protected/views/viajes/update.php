<?php
/* @var $this ViajesController */
/* @var $model Historicoviajes */

$this->breadcrumbs=array(
	'Historicoviajes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Historicoviajes', 'url'=>array('index')),
	array('label'=>'Create Historicoviajes', 'url'=>array('create')),
	array('label'=>'View Historicoviajes', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Historicoviajes', 'url'=>array('admin')),
);
?>

<h1>Update Historicoviajes <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>