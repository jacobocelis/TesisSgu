<?php
/* @var $this AsigchasisController */
/* @var $model Asigchasis */

$this->breadcrumbs=array(
	'Asigchasises'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Asigchasis', 'url'=>array('index')),
	array('label'=>'Manage Asigchasis', 'url'=>array('admin')),
);
?>

<h1>Create Asigchasis</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>