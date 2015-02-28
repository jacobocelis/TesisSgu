<?php
/* @var $this CombustController */
/* @var $model Combust */

$this->breadcrumbs=array(
	'Combusts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Combust', 'url'=>array('index')),
	array('label'=>'Manage Combust', 'url'=>array('admin')),
);
?>

<h1>Create Combust</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>