<?php
/* @var $this GrupoController */
/* @var $model Grupo */

$this->breadcrumbs=array(
	'Vehiculos'=>array('vehiculo/index'),
	'Crear grupo',
);

$this->menu=array(
	array('label'=>'<div id="menu"><strong>Vehiculos</strong></div>' , 'visible'=>'1'),
	array('label'=>'Vehiculos registrados', 'url'=>array('vehiculo/index')),
	array('label'=>'Registrar vehiculo', 'url'=>array('vehiculo/create')),
	array('label'=>'Histórico de vehiculos', 'url'=>array('vehiculo/historico')),
	//array('label'=>'Administrar vehiculos', 'url'=>array('admin')),
	array('label'=>'<div id="menu"><strong>Grupos</strong></div>' , 'visible'=>'1'),
	array('label'=>'Ver grupos', 'url'=>array('grupo/index')),
	array('label'=>'Crear grupo', 'url'=>array('grupo/create')),

	array('label'=>'<div id="menu"><strong>Administrar</strong></div>' , 'visible'=>'1'),
	array('label'=>'      Parámetros y datos maestros', 'url'=>array('grupo/parametros')),
);
?>
<div class='crugepanel user-assignments-role-list'>
<h1>Crear grupo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>