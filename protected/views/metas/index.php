<?php
/* @var $this MetasController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Metases',
);

$this->menu=array(
	array('label'=>'Create Metas', 'url'=>array('create')),
	array('label'=>'Manage Metas', 'url'=>array('admin')),
);
?>

<h1>Metases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
