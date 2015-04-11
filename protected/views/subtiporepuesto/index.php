<?php
/* @var $this SubtiporepuestoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Subtiporepuestos',
);

$this->menu=array(
	array('label'=>'Create Subtiporepuesto', 'url'=>array('create')),
	array('label'=>'Manage Subtiporepuesto', 'url'=>array('admin')),
);
?>

<h1>Subtiporepuestos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
