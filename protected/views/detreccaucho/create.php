<?php
/* @var $this DetreccauchoController */
/* @var $model Detreccaucho */

$this->breadcrumbs=array(
	'Detreccauchos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Detreccaucho', 'url'=>array('index')),
	array('label'=>'Manage Detreccaucho', 'url'=>array('admin')),
);
?>

<h1>Create Detreccaucho</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>