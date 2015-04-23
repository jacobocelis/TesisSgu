<?php
/* @var $this PosicionruedaController */
/* @var $model Posicionrueda */

$this->breadcrumbs=array(
	'Posicionruedas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Posicionrueda', 'url'=>array('index')),
	array('label'=>'Create Posicionrueda', 'url'=>array('create')),
	array('label'=>'View Posicionrueda', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Posicionrueda', 'url'=>array('admin')),
);
?>

<h1>Update Posicionrueda <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>