<?php
/* @var $this RepuestoController */
/* @var $model Repuesto */

$this->breadcrumbs=array(
	'Repuestos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar repuestos', 'url'=>array('index')),
	array('label'=>'Registrar repuesto', 'url'=>array('create')),
	array('label'=>'Actualizar repuesto', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar repuesto', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar repuestos', 'url'=>array('admin')),
);
?>

<h1>Detalle de repuesto </h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		
		'repuesto',
		'descripcion',
		'idsubTipoRepuesto',
	),
)); ?>
