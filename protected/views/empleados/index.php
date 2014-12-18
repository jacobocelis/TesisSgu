<?php
/* @var $this EmpleadosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Historicoempleadoses',
);

$this->menu=array(
	array('label'=>'Create Historicoempleados', 'url'=>array('create')),
	array('label'=>'Manage Historicoempleados', 'url'=>array('admin')),
);
?>

<h1>Historicoempleadoses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
