<?php
/* @var $this CauchorepController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cauchoreps',
);

$this->menu=array(
	array('label'=>'Create Cauchorep', 'url'=>array('create')),
	array('label'=>'Manage Cauchorep', 'url'=>array('admin')),
);
?>

<h1>Cauchoreps</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
