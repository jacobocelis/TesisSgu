<?php
/* @var $this ActividadrecursoController */
/* @var $model Actividadrecurso */

$this->breadcrumbs=array(
	'Actividadrecursos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Actividadrecurso', 'url'=>array('index')),
	array('label'=>'Create Actividadrecurso', 'url'=>array('create')),
	array('label'=>'Update Actividadrecurso', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Actividadrecurso', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Actividadrecurso', 'url'=>array('admin')),
);
?>

<h1>View Actividadrecurso #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'cantidad',
		'idactividades',
		'idinsumo',
		'idprovServ',
		'idrepuesto',
		'idunidad',
		'detalle',
	),
)); ?>
