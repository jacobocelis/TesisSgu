<?php
/* @var $this ModeloController */
/* @var $model Modelo */

$this->breadcrumbs=array(
	'Modelos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Modelo', 'url'=>array('index')),
	array('label'=>'Manage Modelo', 'url'=>array('admin')),
);
?>

<h1>Create Modelo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>