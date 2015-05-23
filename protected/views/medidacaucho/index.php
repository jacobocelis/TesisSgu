<?php
/* @var $this MedidacauchoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Medidacauchos',
);

$this->menu=array(
	array('label'=>'Create Medidacaucho', 'url'=>array('create')),
	array('label'=>'Manage Medidacaucho', 'url'=>array('admin')),
);
?>

<h1>Medidacauchos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
