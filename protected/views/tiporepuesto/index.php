<?php
/* @var $this TiporepuestoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tiporepuestos',
);

$this->menu=array(
	array('label'=>'Create Tiporepuesto', 'url'=>array('create')),
	array('label'=>'Manage Tiporepuesto', 'url'=>array('admin')),
);
?>

<h1>Tiporepuestos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
