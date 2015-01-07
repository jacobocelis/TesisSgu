<?php
/* @var $this PosicionejeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Posicionejes',
);

$this->menu=array(
	array('label'=>'Create Posicioneje', 'url'=>array('create')),
	array('label'=>'Manage Posicioneje', 'url'=>array('admin')),
);
?>

<h1>Posicionejes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
