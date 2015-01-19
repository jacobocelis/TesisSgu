<?php
/* @var $this DetalleeventocaController */
/* @var $model Detalleeventoca */

$this->breadcrumbs=array(
	'Detalleeventocas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Detalleeventoca', 'url'=>array('index')),
	array('label'=>'Manage Detalleeventoca', 'url'=>array('admin')),
);
?>

<h1>Create Detalleeventoca</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>