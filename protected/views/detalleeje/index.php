<?php
/* @var $this DetalleejeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Detalleejes',
);

$this->menu=array(
	array('label'=>'Create Detalleeje', 'url'=>array('create')),
	array('label'=>'Manage Detalleeje', 'url'=>array('admin')),
);
?>

<h1>Detalleejes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
