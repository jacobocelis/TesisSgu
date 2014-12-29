<?php
/* @var $this CombustibleController */
/* @var $model Historicocombustible */

$this->breadcrumbs=array(
	'Historicocombustibles'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Historicocombustible', 'url'=>array('index')),
	array('label'=>'Create Historicocombustible', 'url'=>array('create')),
	array('label'=>'View Historicocombustible', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Historicocombustible', 'url'=>array('admin')),
);
?>

<h1>Update Historicocombustible <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>