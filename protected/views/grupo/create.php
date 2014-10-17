<?php
/* @var $this GrupoController */
/* @var $model Grupo */

$this->breadcrumbs=array(
	'Grupos'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar grupos', 'url'=>array('index')),
	array('label'=>'Administrar grupos', 'url'=>array('admin')),
);
?>

<h1>Crear grupo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>