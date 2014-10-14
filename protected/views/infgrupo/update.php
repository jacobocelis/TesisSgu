<?php
/* @var $this InfgrupoController */
/* @var $model Infgrupo */

$this->breadcrumbs=array(
	'Infgrupos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Infgrupo', 'url'=>array('index')),
	array('label'=>'Create Infgrupo', 'url'=>array('create')),
	array('label'=>'View Infgrupo', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Infgrupo', 'url'=>array('admin')),
);
?>

<h1>Update Infgrupo <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>