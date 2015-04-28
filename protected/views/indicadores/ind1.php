<?php

$this->breadcrumbs=array(
	'Indicadores y reportes',
);

$this->menu=array(
	array('label'=>'<div id="menu"><strong>Vehiculos</strong></div>' , 'visible'=>'1'),
	array('label'=>'      Vehiculos registrados', 'url'=>array('vehiculo/index')),
	array('label'=>'      Registrar vehiculo', 'url'=>array('vehiculo/create')),
	array('label'=>'      Histórico de vehiculos', 'url'=>array('vehiculo/historico')),
	//array('label'=>'Administrar vehiculos', 'url'=>array('admin')),
	array('label'=>'<div id="menu"><strong>Grupos</strong></div>' , 'visible'=>'1'),
	array('label'=>'      Ver grupos', 'url'=>array('grupo/index')),
	array('label'=>'      Crear grupo', 'url'=>array('grupo/create')),

	array('label'=>'<div id="menu"><strong>Administrar</strong></div>' , 'visible'=>'1'),
	array('label'=>'      Parámetros y datos maestros', 'url'=>array('grupo/parametros')),
);
?>

<h1>Indicadores y reportes</h1>

