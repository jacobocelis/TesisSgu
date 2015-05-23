<?php
/* @var $this MarcacauchoController */
/* @var $model Marcacaucho */

$this->breadcrumbs=array(
	'Marcacauchos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Marcacaucho', 'url'=>array('index')),
	array('label'=>'Manage Marcacaucho', 'url'=>array('admin')),
);
?>

<h1>Create Marcacaucho</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>