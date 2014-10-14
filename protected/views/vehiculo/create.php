<?php
/* @var $this VehiculoController */
/* @var $model Vehiculo */

$this->breadcrumbs=array(
	'Vehiculos'=>array('index'),
	'Registrar',
);

$this->menu=array(
	array('label'=>'Listar Vehiculos', 'url'=>array('index')),
	array('label'=>'Administrar Vehiculos', 'url'=>array('admin')),
);
?>
<h1>Registrar vehiculo</h1>

<?php $this->renderPartial('_form', array('model'=>$model,'marca'=>$marca)); ?>
<style>
.errorMessage{
	color:red;
}
.errorSummary{
	color:red;
}
</style>