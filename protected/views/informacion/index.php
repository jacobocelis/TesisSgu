<?php
/* @var $this InformacionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Informacions',
);

$this->menu=array(
	array('label'=>'Create Informacion', 'url'=>array('create')),
	array('label'=>'Manage Informacion', 'url'=>array('admin')),
);
?>

<h1>Informacions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
