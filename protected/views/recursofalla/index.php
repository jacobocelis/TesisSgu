<?php
/* @var $this RecursofallaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Recursofallas',
);

$this->menu=array(
	array('label'=>'Create Recursofalla', 'url'=>array('create')),
	array('label'=>'Manage Recursofalla', 'url'=>array('admin')),
);
?>

<h1>Recursofallas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
