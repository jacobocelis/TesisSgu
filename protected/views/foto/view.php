<?php
/* @var $this FotoController */
/* @var $model Foto */

$this->breadcrumbs=array(
	'Fotos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Foto', 'url'=>array('index')),
	array('label'=>'Create Foto', 'url'=>array('create')),
	array('label'=>'Update Foto', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Foto', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Foto', 'url'=>array('admin')),
);
?>

<h1>View Foto #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idvehiculo0.numeroUnidad',
		
		array('name'=>'imagen','value'=>CHtml::image('data:image/jpeg;base64,'.$model->imagen),'type'=>'raw'),
	),
)); ?>
<style>
	 img{
		width: 600px;
	}
</style>
