<?php
/* @var $this ReportefallaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Reportefallas',
);

$this->menu=array(
	array('label'=>'Create Reportefalla', 'url'=>array('create')),
	array('label'=>'Manage Reportefalla', 'url'=>array('admin')),
);
?>

<h1>Reportefallas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
