<?php
/* @var $this DetalleeventocaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Detalleeventocas',
);

$this->menu=array(
	array('label'=>'Create Detalleeventoca', 'url'=>array('create')),
	array('label'=>'Manage Detalleeventoca', 'url'=>array('admin')),
);
?>

<h1>Detalleeventocas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
