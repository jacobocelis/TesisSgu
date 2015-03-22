<?php
/* @var $this HistoricoedosController */
/* @var $model Historicoedos */

$this->breadcrumbs=array(
	'Historicoedoses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Historicoedos', 'url'=>array('index')),
	array('label'=>'Create Historicoedos', 'url'=>array('create')),
	array('label'=>'View Historicoedos', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Historicoedos', 'url'=>array('admin')),
);
?>

<h1>Update Historicoedos <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>