<?php
/* @var $this EstacionservicioController */
/* @var $model Estacionservicio */

$this->breadcrumbs=array(
	'Estacionservicios'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Estacionservicio', 'url'=>array('index')),
	array('label'=>'Create Estacionservicio', 'url'=>array('create')),
	array('label'=>'View Estacionservicio', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Estacionservicio', 'url'=>array('admin')),
);
?>

<h1>Update Estacionservicio <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>