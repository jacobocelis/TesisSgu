<?php
/* @var $this RecursofallaController */
/* @var $model Recursofalla */

$this->breadcrumbs=array(
	'Recursofallas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Recursofalla', 'url'=>array('index')),
	array('label'=>'Manage Recursofalla', 'url'=>array('admin')),
);
?>

<h1>Create Recursofalla</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>