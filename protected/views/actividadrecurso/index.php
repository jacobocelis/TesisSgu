<?php
/* @var $this ActividadrecursoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Actividadrecursos',
);

$this->menu=array(
	array('label'=>'Create Actividadrecurso', 'url'=>array('create')),
	array('label'=>'Manage Actividadrecurso', 'url'=>array('admin')),
);
?>

<h1>Actividadrecursos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
