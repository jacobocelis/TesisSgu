<?php
/* @var $this RinController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Rins',
);

$this->menu=array(
	array('label'=>'Create Rin', 'url'=>array('create')),
	array('label'=>'Manage Rin', 'url'=>array('admin')),
);
?>

<h1>Rins</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
