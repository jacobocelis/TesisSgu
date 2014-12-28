<?php
/* @var $this ActividadmttoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Actividadmttos',
);

$this->menu=array(
	array('label'=>'Create Actividadmtto', 'url'=>array('create')),
	array('label'=>'Manage Actividadmtto', 'url'=>array('admin')),
);
?>

<h1>Actividadmttos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
