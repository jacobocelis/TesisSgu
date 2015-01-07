<?php
/* @var $this DetalleruedaController */
/* @var $model Detallerueda */

$this->breadcrumbs=array(
	'Detalleruedas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Detallerueda', 'url'=>array('index')),
	array('label'=>'Create Detallerueda', 'url'=>array('create')),
	array('label'=>'View Detallerueda', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Detallerueda', 'url'=>array('admin')),
);
?>

<h1>Update Detallerueda <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>