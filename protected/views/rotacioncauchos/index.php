<?php
/* @var $this RotacioncauchosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Rotacioncauchoses',
);

$this->menu=array(
	array('label'=>'Create Rotacioncauchos', 'url'=>array('create')),
	array('label'=>'Manage Rotacioncauchos', 'url'=>array('admin')),
);
?>

<h1>Rotacioncauchoses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
