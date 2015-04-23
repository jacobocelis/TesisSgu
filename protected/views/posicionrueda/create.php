<?php
/* @var $this PosicionruedaController */
/* @var $model Posicionrueda */

$this->breadcrumbs=array(
	'Posicionruedas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Posicionrueda', 'url'=>array('index')),
	array('label'=>'Manage Posicionrueda', 'url'=>array('admin')),
);
?>

<h1>Create Posicionrueda</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>