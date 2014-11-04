<?php
/* @var $this ActividadesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Actividades',
);

$this->menu=array(
	array('label'=>'Create Actividades', 'url'=>array('create')),
	array('label'=>'Manage Actividades', 'url'=>array('admin')),
);
?>

<h1>Actividades</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
