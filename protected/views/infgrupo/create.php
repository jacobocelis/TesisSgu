<?php
/* @var $this InfgrupoController */
/* @var $model Infgrupo */

$this->breadcrumbs=array(
	'Infgrupos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Infgrupo', 'url'=>array('index')),
	array('label'=>'Manage Infgrupo', 'url'=>array('admin')),
);
?>

<h1>Create Infgrupo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>