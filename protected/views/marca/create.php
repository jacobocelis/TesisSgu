<?php
/* @var $this MarcaController */
/* @var $model Marca */

$this->breadcrumbs=array(
	'Marcas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Marca', 'url'=>array('index')),
	array('label'=>'Manage Marca', 'url'=>array('admin')),
);
?>

<h1>Create Marca</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>