<?php
/* @var $this RecursocauchoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Recursocauchos',
);

$this->menu=array(
	array('label'=>'Create Recursocaucho', 'url'=>array('create')),
	array('label'=>'Manage Recursocaucho', 'url'=>array('admin')),
);
?>

<h1>Recursocauchos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
