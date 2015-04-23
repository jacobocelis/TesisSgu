<?php
/* @var $this LugarController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Lugars',
);

$this->menu=array(
	array('label'=>'Create Lugar', 'url'=>array('create')),
	array('label'=>'Manage Lugar', 'url'=>array('admin')),
);
?>

<h1>Lugars</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
