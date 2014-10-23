<?php
/* @var $this RepuestoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Partes y piezas',
);

$this->menu=array(
	array('label'=>'Registrar pieza', 'url'=>array('create')),
	array('label'=>'Asignación a grupos', 'url'=>array('asignarPiezaGrupo/AsignarPieza')),
	array('label'=>'piezas en grupos', 'url'=>array('detallePiezaGrupo/detallePieza')),
	array('label'=>'Administrar piezas', 'url'=>array('admin')),
);
?>
<h1>Partes y piezas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
