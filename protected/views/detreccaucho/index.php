<?php
/* @var $this DetreccauchoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Detreccauchos',
);

$this->menu=array(
	array('label'=>'Create Detreccaucho', 'url'=>array('create')),
	array('label'=>'Manage Detreccaucho', 'url'=>array('admin')),
);
?>

<h1>Detreccauchos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
