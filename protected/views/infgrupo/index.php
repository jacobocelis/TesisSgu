<?php
/* @var $this InfgrupoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Infgrupos',
);

$this->menu=array(
	array('label'=>'Create Infgrupo', 'url'=>array('create')),
	array('label'=>'Manage Infgrupo', 'url'=>array('admin')),
);
?>

<h1>Infgrupos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
