<?php
/* @var $this AsigchasisController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Asigchasises',
);

$this->menu=array(
	array('label'=>'Create Asigchasis', 'url'=>array('create')),
	array('label'=>'Manage Asigchasis', 'url'=>array('admin')),
);
?>

<h1>Asigchasises</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
