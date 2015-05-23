<?php
/* @var $this TipoinsumoController */
/* @var $model Tipoinsumo */

$this->breadcrumbs=array(
	'Tipoinsumos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Tipoinsumo', 'url'=>array('index')),
	array('label'=>'Manage Tipoinsumo', 'url'=>array('admin')),
);
?>

<h1>Create Tipoinsumo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>