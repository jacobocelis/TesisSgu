<?php
/* @var $this PosicionruedaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Posicionruedas',
);

$this->menu=array(
	array('label'=>'Create Posicionrueda', 'url'=>array('create')),
	array('label'=>'Manage Posicionrueda', 'url'=>array('admin')),
);
?>

<h1>Posicionruedas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
