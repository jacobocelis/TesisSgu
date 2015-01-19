<?php
/* @var $this DetalleeventocaController */
/* @var $model Detalleeventoca */

$this->breadcrumbs=array(
	'Detalleeventocas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Detalleeventoca', 'url'=>array('index')),
	array('label'=>'Create Detalleeventoca', 'url'=>array('create')),
	array('label'=>'View Detalleeventoca', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Detalleeventoca', 'url'=>array('admin')),
);
?>

<h1>Update Detalleeventoca <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>