<?php
/* @var $this RinController */
/* @var $model Rin */

$this->breadcrumbs=array(
	'Rins'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Rin', 'url'=>array('index')),
	array('label'=>'Manage Rin', 'url'=>array('admin')),
);
?>

<h1>Create Rin</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>