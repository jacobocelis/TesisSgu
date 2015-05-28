<?php
/* @var $this VehiculoController */
/* @var $model Vehiculo */

$this->breadcrumbs=array(
	'Vehiculos'=>array('index'),
	'Unidad '.$model->numeroUnidad=>array('view','id'=>$model->id),
	'Editar',
);

$this->menu=array(
	array('label'=>'<div id="menu"><strong>Opciones de vehiculo</strong></div>' , 'visible'=>'1'),
	array('label'=>'Ficha técnica', 'url'=>array('vehiculo/view', 'id'=>$model->id)),
	array('label'=>'Editar vehiculo', 'url'=>array('vehiculo/update', 'id'=>$model->id)),
	array('label'=>'Agregar fotografía', 'url'=>array('foto/index', 'id'=>$model->id)),
	array('label'=>'<div id="menu"><strong>Operaciones</strong></div>' , 'visible'=>'1'),
	array('label'=>'Desincorporar vehiculo', 'url'=>array('vehiculo/desincorporar', 'id'=>$model->id) ,'linkOptions'=>array('style'=>'cursor:pointer;')),
	
	array('label'=>'Eliminar vehiculo', 'url'=>'' ,'linkOptions'=>array('confirm'=>'¿Confirma que desea eliminar el vehiculo?','onclick'=>'eliminar('.$model->id.')','style'=>'cursor:pointer;background:#FFE0E1;')),
);
?>
<div class='crugepanel user-assignments-role-list'>
<h1>Editar información de vehiculo</h1>

<?php $this->renderPartial('_form', array('model'=>$model,'marca'=>$marca)); ?>
</div>