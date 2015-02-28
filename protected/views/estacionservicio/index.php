<?php
/* @var $this EstacionservicioController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Estacionservicios',
);

$this->menu=array(
	array('label'=>'Create Estacionservicio', 'url'=>array('create')),
	array('label'=>'Manage Estacionservicio', 'url'=>array('admin')),
);
?>

<h1>Estacionservicios</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
