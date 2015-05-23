<?php
/* @var $this MedidacauchoController */
/* @var $model Medidacaucho */

$this->breadcrumbs=array(
	'Medidacauchos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Medidacaucho', 'url'=>array('index')),
	array('label'=>'Create Medidacaucho', 'url'=>array('create')),
	array('label'=>'View Medidacaucho', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Medidacaucho', 'url'=>array('admin')),
);
?>

<h1>Update Medidacaucho <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>