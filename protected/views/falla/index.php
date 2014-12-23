<?php
/* @var $this FallaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Fallas',
);

$this->menu=array(
	array('label'=>'Create Falla', 'url'=>array('create')),
	array('label'=>'Manage Falla', 'url'=>array('admin')),
);
?>

<h1>Fallas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
