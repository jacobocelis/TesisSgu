<?php
/* @var $this PropiedadController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Propiedads',
);

$this->menu=array(
	array('label'=>'Create Propiedad', 'url'=>array('create')),
	array('label'=>'Manage Propiedad', 'url'=>array('admin')),
);
?>

<h1>Propiedads</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
