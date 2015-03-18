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
<div class='crugepanel user-assignments-role-list'>
<h1>Registrar vehiculo</h1>

<?php $this->renderPartial('_form', array('model'=>$model,'marca'=>$marca)); ?>

</div>
<style>
.errorMessage{
	color:red;
}
.errorSummary{
	color:red;
}
</style>