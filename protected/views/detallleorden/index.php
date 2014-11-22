<?php
/* @var $this DetallleordenController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Detallleordens',
);

$this->menu=array(
	array('label'=>'Create Detallleorden', 'url'=>array('create')),
	array('label'=>'Manage Detallleorden', 'url'=>array('admin')),
);
?>

<h1>Detallleordens</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
