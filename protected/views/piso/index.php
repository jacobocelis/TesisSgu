<?php
/* @var $this PisoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pisos',
);

$this->menu=array(
	array('label'=>'Create Piso', 'url'=>array('create')),
	array('label'=>'Manage Piso', 'url'=>array('admin')),
);
?>

<h1>Pisos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
