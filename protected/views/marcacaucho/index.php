<?php
/* @var $this MarcacauchoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Marcacauchos',
);

$this->menu=array(
	array('label'=>'Create Marcacaucho', 'url'=>array('create')),
	array('label'=>'Manage Marcacaucho', 'url'=>array('admin')),
);
?>

<h1>Marcacauchos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
