<?php
/* @var $this PosicionejeController */
/* @var $model Posicioneje */

$this->breadcrumbs=array(
	'Posicionejes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Posicioneje', 'url'=>array('index')),
	array('label'=>'Manage Posicioneje', 'url'=>array('admin')),
);
?>

<h1>Create Posicioneje</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>