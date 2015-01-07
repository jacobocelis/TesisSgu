<?php
/* @var $this DetalleruedaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Detalleruedas',
);

$this->menu=array(
	array('label'=>'Create Detallerueda', 'url'=>array('create')),
	array('label'=>'Manage Detallerueda', 'url'=>array('admin')),
);
?>

<h1>Detalleruedas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
