<?php
/* @var $this CombustibleController */
/* @var $model Historicocombustible */

$this->breadcrumbs=array(
	'Combustible'=>array('index'),
	'Registrar reposición',
);

$this->menu=array(
	array('label'=>'List Historicocombustible', 'url'=>array('index')),
	array('label'=>'Manage Historicocombustible', 'url'=>array('admin')),
);
?>

<h1>Registrar reposición de combustible</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>