<?php
/* @var $this InsumoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Insumos',
);

$this->menu=array(
	array('label'=>'Create Insumo', 'url'=>array('create')),
	array('label'=>'Manage Insumo', 'url'=>array('admin')),
);
?>

<h1>Insumos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
