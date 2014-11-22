<?php
/* @var $this DetallegastoController */
/* @var $model Detallegasto */

$this->breadcrumbs=array(
	'Detallegastos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Detallegasto', 'url'=>array('index')),
	array('label'=>'Create Detallegasto', 'url'=>array('create')),
	array('label'=>'View Detallegasto', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Detallegasto', 'url'=>array('admin')),
);
?>

<h1>Update Detallegasto <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>