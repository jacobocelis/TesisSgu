<?php
/* @var $this FallacauchoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Fallacauchos',
);

$this->menu=array(
	array('label'=>'Create Fallacaucho', 'url'=>array('create')),
	array('label'=>'Manage Fallacaucho', 'url'=>array('admin')),
);
?>

<h1>Fallacauchos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
