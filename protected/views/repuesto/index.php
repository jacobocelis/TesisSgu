<?php
/* @var $this RepuestoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Repuestos',
);

$this->menu=array(
	array('label'=>'Registrar repuesto', 'url'=>array('create')),
	array('label'=>'Asignación a grupos', 'url'=>array('asignarPiezaGrupo/AsignarPieza')),
	array('label'=>'Repuestos en grupos', 'url'=>array('detallePiezaGrupo/detallePieza')),
	array('label'=>'Administrar repuestos', 'url'=>array('admin')),
);
?>
<h1>Repuestos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
