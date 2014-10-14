<?php
/* @var $this InformacionController */
/* @var $model Informacion */

$this->breadcrumbs=array(
	'Informacions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Informacion', 'url'=>array('index')),
	array('label'=>'Create Informacion', 'url'=>array('create')),
	array('label'=>'View Informacion', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Informacion', 'url'=>array('admin')),
);
?>

<h1>Update Informacion <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>