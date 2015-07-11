<?php
/* @var $this MetasController */
/* @var $model Metas */

$this->breadcrumbs=array(
	'Metases'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Metas', 'url'=>array('index')),
	array('label'=>'Manage Metas', 'url'=>array('admin')),
);
?>

<h1>Create Metas</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>