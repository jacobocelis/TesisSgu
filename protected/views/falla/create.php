<?php
/* @var $this FallaController */
/* @var $model Falla */

$this->breadcrumbs=array(
	'Fallas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Falla', 'url'=>array('index')),
	array('label'=>'Manage Falla', 'url'=>array('admin')),
);
?>

<h1>Create Falla</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>