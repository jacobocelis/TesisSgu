<?php
/* @var $this EmpleadosController */
/* @var $model Historicoempleados */

$this->breadcrumbs=array(
	'Historicoempleadoses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Historicoempleados', 'url'=>array('index')),
	array('label'=>'Manage Historicoempleados', 'url'=>array('admin')),
);
?>

<h1>Create Historicoempleados</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>