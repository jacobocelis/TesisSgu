<?php
/* @var $this GrupoController */
/* @var $dataProvider CActiveDataProvider */


$this->breadcrumbs=array(
	'Vehiculos'=>array('vehiculo/index'),
	'Grupos registrados',
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

<h1>Grupos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
