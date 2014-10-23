<?php
/* @var $this RepuestoController */
/* @var $model Repuesto */

$this->breadcrumbs=array(
	'Piezas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar piezas', 'url'=>array('index')),
	array('label'=>'Registrar pieza', 'url'=>array('create')),
	array('label'=>'Actualizar pieza', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar pieza', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar piezas', 'url'=>array('admin')),
);
?>

<h1>Detalle de pieza </h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		
		'repuesto',
		'descripcion',
		'idsubTipoRepuesto',
	),
)); ?>
