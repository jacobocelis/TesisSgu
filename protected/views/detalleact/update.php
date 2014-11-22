<?php
/* @var $this DetalleactController */
/* @var $model Detalleact */

$this->breadcrumbs=array(
	'Detalleacts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Detalleact', 'url'=>array('index')),
	array('label'=>'Create Detalleact', 'url'=>array('create')),
	array('label'=>'View Detalleact', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Detalleact', 'url'=>array('admin')),
);
?>

<h1>Update Detalleact <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>