<?php
/* @var $this ChasisController */
/* @var $model Chasis */

$this->breadcrumbs=array(
	'Chasises'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Chasis', 'url'=>array('index')),
	array('label'=>'Manage Chasis', 'url'=>array('admin')),
);
?>

<h1>Create Chasis</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>