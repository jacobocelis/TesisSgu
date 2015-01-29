<?php
/* @var $this RotacioncauchosController */
/* @var $model Rotacioncauchos */

$this->breadcrumbs=array(
	'Rotacioncauchoses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Rotacioncauchos', 'url'=>array('index')),
	array('label'=>'Create Rotacioncauchos', 'url'=>array('create')),
	array('label'=>'View Rotacioncauchos', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Rotacioncauchos', 'url'=>array('admin')),
);
?>

<h1>Update Rotacioncauchos <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>