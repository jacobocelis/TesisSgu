<?php
/* @var $this HistoricoedosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Historicoedoses',
);

$this->menu=array(
	array('label'=>'Create Historicoedos', 'url'=>array('create')),
	array('label'=>'Manage Historicoedos', 'url'=>array('admin')),
);
?>

<h1>Historicoedoses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
