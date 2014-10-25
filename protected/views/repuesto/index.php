<?php
/* @var $this RepuestoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Partes y piezas',
);

$this->menu=array(
	array('label'=>'Registrar pieza', 'url'=>array('create')),
	array('label'=>'Asignación de piezas a grupos', 'url'=>array('asignarPiezaGrupo/AsignarPieza')),
	array('label'=>'Ver piezas asignadas en grupos', 'url'=>array('detallePiezaGrupo/detallePieza')),
	array('label'=>'Administrar piezas', 'url'=>array('admin')),
);
?>
<h1>Partes y piezas</h1>

