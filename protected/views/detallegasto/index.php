<?php
/* @var $this DetallegastoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Detallegastos',
);

$this->menu=array(
	array('label'=>'Create Detallegasto', 'url'=>array('create')),
	array('label'=>'Manage Detallegasto', 'url'=>array('admin')),
);
?>

<h1>Detallegastos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
