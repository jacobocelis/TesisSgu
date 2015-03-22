<?php
/* @var $this VehiculoController */
/* @var $model Vehiculo */

$this->breadcrumbs=array(
	'Vehiculos'=>array('index'),
	'Registro',
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
);
if(!isset($grupo))
	$grupo=0;
?>
<div class='crugepanel user-assignments-role-list'>
<h1>Registrar vehiculo</h1>

<?php $this->renderPartial('_form', array('model'=>$model,'marca'=>$marca,'grupo'=>$grupo)); ?>

</div>
<style>
.errorMessage{
	color:red;
}
.errorSummary{
	color:red;
}
</style>