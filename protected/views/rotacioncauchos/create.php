<?php
/* @var $this RotacioncauchosController */
/* @var $model Rotacioncauchos */

$this->breadcrumbs=array(
	'Rotacioncauchoses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Rotacioncauchos', 'url'=>array('index')),
	array('label'=>'Manage Rotacioncauchos', 'url'=>array('admin')),
);
?>

<h1>Create Rotacioncauchos</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>