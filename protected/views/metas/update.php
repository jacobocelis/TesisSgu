<?php
/* @var $this MetasController */
/* @var $model Metas */

$this->breadcrumbs=array(
	'Metases'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Metas', 'url'=>array('index')),
	array('label'=>'Create Metas', 'url'=>array('create')),
	array('label'=>'View Metas', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Metas', 'url'=>array('admin')),
);
?>

<h1>Update Metas <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>