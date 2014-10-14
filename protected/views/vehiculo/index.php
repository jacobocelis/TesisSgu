<?php
/* @var $this VehiculoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Vehiculos',
);

$this->menu=array(
	array('label'=>'Registrar vehiculo', 'url'=>array('create')),
	array('label'=>'Registrar grupo', 'url'=>array('/grupo/create')),
	array('label'=>'Administrar vehiculos', 'url'=>array('admin')),
);
?>

<h1>Vehiculos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
