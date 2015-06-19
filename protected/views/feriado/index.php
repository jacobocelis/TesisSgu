<?php
/* @var $this FeriadoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Feriados',
);

$this->menu=array(
	array('label'=>'Create Feriado', 'url'=>array('create')),
	array('label'=>'Manage Feriado', 'url'=>array('admin')),
);
?>

<h1>Feriados</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
