<?php
/* @var $this DetalleordenController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Detalleordens',
);

$this->menu=array(
	array('label'=>'Create Detalleorden', 'url'=>array('create')),
	array('label'=>'Manage Detalleorden', 'url'=>array('admin')),
);
?>

<h1>Detalleordens</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
