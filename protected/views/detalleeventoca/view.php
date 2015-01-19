<?php
/* @var $this DetalleeventocaController */
/* @var $model Detalleeventoca */

$this->breadcrumbs=array(
	'Detalleeventocas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Detalleeventoca', 'url'=>array('index')),
	array('label'=>'Create Detalleeventoca', 'url'=>array('create')),
	array('label'=>'Update Detalleeventoca', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Detalleeventoca', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Detalleeventoca', 'url'=>array('admin')),
);
?>

<h1>View Detalleeventoca #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fechaFalla',
		'fechaRealizada',
		'comentario',
		'idhistoricoCaucho',
		'idfallaCaucho',
		'idaccionCauho',
		'idestatus',
		'idempleado',
	),
)); ?>
