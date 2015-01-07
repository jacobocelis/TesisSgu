<?php
/* @var $this ChasisController */
/* @var $model Chasis */

$this->breadcrumbs=array(
	'Chasises'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Chasis', 'url'=>array('index')),
	array('label'=>'Create Chasis', 'url'=>array('create')),
	array('label'=>'View Chasis', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Chasis', 'url'=>array('admin')),
);
?>

<h1>Update Chasis <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>