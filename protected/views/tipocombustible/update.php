<?php
/* @var $this TipocombustibleController */
/* @var $model Tipocombustible */

$this->breadcrumbs=array(
	'Tipocombustibles'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Tipocombustible', 'url'=>array('index')),
	array('label'=>'Create Tipocombustible', 'url'=>array('create')),
	array('label'=>'View Tipocombustible', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Tipocombustible', 'url'=>array('admin')),
);
?>

<h1>Update Tipocombustible <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>