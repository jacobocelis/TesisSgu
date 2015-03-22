<?php
/* @var $this HistoricoedosController */
/* @var $model Historicoedos */

$this->breadcrumbs=array(
	'Historicoedoses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Historicoedos', 'url'=>array('index')),
	array('label'=>'Manage Historicoedos', 'url'=>array('admin')),
);
?>

<h1>Create Historicoedos</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>