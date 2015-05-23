<?php
/* @var $this TipoinsumoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tipoinsumos',
);

$this->menu=array(
	array('label'=>'Create Tipoinsumo', 'url'=>array('create')),
	array('label'=>'Manage Tipoinsumo', 'url'=>array('admin')),
);
?>

<h1>Tipoinsumos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
