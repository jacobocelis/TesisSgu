<?php
/* @var $this CombustController */
/* @var $model Combust */

$this->breadcrumbs=array(
	'Combusts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Combust', 'url'=>array('index')),
	array('label'=>'Create Combust', 'url'=>array('create')),
	array('label'=>'View Combust', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Combust', 'url'=>array('admin')),
);
?>

<h1>Update Combust <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>