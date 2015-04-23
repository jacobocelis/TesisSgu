<?php
/* @var $this CauchoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cauchos',
);

$this->menu=array(
	array('label'=>'Create Caucho', 'url'=>array('create')),
	array('label'=>'Manage Caucho', 'url'=>array('admin')),
);
?>

<h1>Cauchos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
