<?php
/* @var $this ActividadesgrupoController */
/* @var $model Actividadesgrupo */

$this->breadcrumbs=array(
	'Actividadesgrupos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Actividadesgrupo', 'url'=>array('index')),
	array('label'=>'Create Actividadesgrupo', 'url'=>array('create')),
	array('label'=>'Update Actividadesgrupo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Actividadesgrupo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Actividadesgrupo', 'url'=>array('admin')),
);
?>

<h1>View Actividadesgrupo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'actividad',
		'frecuenciaKm',
		'frecuenciaMes',
		'duracion',
		'diasParo',
		'idplan',
		'idprioridad',
	),
)); ?>
