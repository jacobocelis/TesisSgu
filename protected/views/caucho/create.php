<?php
/* @var $this CauchoController */
/* @var $model Caucho */

$this->breadcrumbs=array(
	'Cauchos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Caucho', 'url'=>array('index')),
	array('label'=>'Manage Caucho', 'url'=>array('admin')),
);
?>

<h1>Create Caucho</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>