<?php
/* @var $this ChasisController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Chasises',
);

$this->menu=array(
	array('label'=>'Create Chasis', 'url'=>array('create')),
	array('label'=>'Manage Chasis', 'url'=>array('admin')),
);
?>

<h1>Chasises</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
