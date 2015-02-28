<?php
/* @var $this CombustController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Combusts',
);

$this->menu=array(
	array('label'=>'Create Combust', 'url'=>array('create')),
	array('label'=>'Manage Combust', 'url'=>array('admin')),
);
?>

<h1>Combusts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
