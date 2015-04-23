<?php
/* @var $this CauchoController */
/* @var $model Caucho */

$this->breadcrumbs=array(
	'Cauchos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Caucho', 'url'=>array('index')),
	array('label'=>'Create Caucho', 'url'=>array('create')),
	array('label'=>'View Caucho', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Caucho', 'url'=>array('admin')),
);
?>

<h1>Update Caucho <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>