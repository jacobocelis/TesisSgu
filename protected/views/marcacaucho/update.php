<?php
/* @var $this MarcacauchoController */
/* @var $model Marcacaucho */

$this->breadcrumbs=array(
	'Marcacauchos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Marcacaucho', 'url'=>array('index')),
	array('label'=>'Create Marcacaucho', 'url'=>array('create')),
	array('label'=>'View Marcacaucho', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Marcacaucho', 'url'=>array('admin')),
);
?>

<h1>Update Marcacaucho <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>