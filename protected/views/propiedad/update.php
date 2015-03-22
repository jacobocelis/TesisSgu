<?php
/* @var $this PropiedadController */
/* @var $model Propiedad */

$this->breadcrumbs=array(
	'Propiedads'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Propiedad', 'url'=>array('index')),
	array('label'=>'Create Propiedad', 'url'=>array('create')),
	array('label'=>'View Propiedad', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Propiedad', 'url'=>array('admin')),
);
?>

<h1>Update Propiedad <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>