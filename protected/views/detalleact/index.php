<?php
/* @var $this DetalleactController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Detalleacts',
);

$this->menu=array(
	array('label'=>'Create Detalleact', 'url'=>array('create')),
	array('label'=>'Manage Detalleact', 'url'=>array('admin')),
);
?>

<h1>Detalleacts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
