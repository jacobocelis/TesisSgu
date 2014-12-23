<?php
/* @var $this FallaController */
/* @var $model Falla */

$this->breadcrumbs=array(
	'Fallas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Falla', 'url'=>array('index')),
	array('label'=>'Create Falla', 'url'=>array('create')),
	array('label'=>'View Falla', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Falla', 'url'=>array('admin')),
);
?>

<h1>Update Falla <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>