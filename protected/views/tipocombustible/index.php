<?php
/* @var $this TipocombustibleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tipocombustibles',
);

$this->menu=array(
	array('label'=>'Create Tipocombustible', 'url'=>array('create')),
	array('label'=>'Manage Tipocombustible', 'url'=>array('admin')),
);
?>

<h1>Tipocombustibles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
