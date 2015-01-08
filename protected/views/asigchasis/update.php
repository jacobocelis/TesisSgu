<?php
/* @var $this AsigchasisController */
/* @var $model Asigchasis */

$this->breadcrumbs=array(
	'Asigchasises'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Asigchasis', 'url'=>array('index')),
	array('label'=>'Create Asigchasis', 'url'=>array('create')),
	array('label'=>'View Asigchasis', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Asigchasis', 'url'=>array('admin')),
);
?>

<h1>Update Asigchasis <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>