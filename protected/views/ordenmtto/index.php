<?php
/* @var $this OrdenmttoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ordenmttos',
);

$this->menu=array(
	array('label'=>'Create Ordenmtto', 'url'=>array('create')),
	array('label'=>'Manage Ordenmtto', 'url'=>array('admin')),
);
?>

<h1>Ordenmttos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
