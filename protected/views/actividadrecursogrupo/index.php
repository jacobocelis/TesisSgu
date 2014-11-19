<?php
/* @var $this ActividadrecursogrupoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Actividadrecursogrupos',
);

$this->menu=array(
	array('label'=>'Create Actividadrecursogrupo', 'url'=>array('create')),
	array('label'=>'Manage Actividadrecursogrupo', 'url'=>array('admin')),
);
?>

<h1>Actividadrecursogrupos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
