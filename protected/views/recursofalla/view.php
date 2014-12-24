<?php
/* @var $this RecursofallaController */
/* @var $model Recursofalla */

$this->breadcrumbs=array(
	'Recursofallas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Recursofalla', 'url'=>array('index')),
	array('label'=>'Create Recursofalla', 'url'=>array('create')),
	array('label'=>'Update Recursofalla', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Recursofalla', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Recursofalla', 'url'=>array('admin')),
);
?>

<h1>View Recursofalla #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'cantidad',
		'costoUnitario',
		'costoTotal',
		'idinsumo',
		'idservicio',
		'idrepuesto',
		'idreporteFalla',
		'idunidad',
		'garantia',
		'idtiempo',
	),
)); ?>
