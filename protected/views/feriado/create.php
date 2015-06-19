<?php
/* @var $this FeriadoController */
/* @var $model Feriado */

$this->breadcrumbs=array(
	'Feriados'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Feriado', 'url'=>array('index')),
	array('label'=>'Manage Feriado', 'url'=>array('admin')),
);
?>

<h1>Create Feriado</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>