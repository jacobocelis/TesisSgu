<?php
/* @var $this DetreccauchoController */
/* @var $model Detreccaucho */

$this->breadcrumbs=array(
	'Detreccauchos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Detreccaucho', 'url'=>array('index')),
	array('label'=>'Create Detreccaucho', 'url'=>array('create')),
	array('label'=>'View Detreccaucho', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Detreccaucho', 'url'=>array('admin')),
);
?>

<h1>Update Detreccaucho <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>