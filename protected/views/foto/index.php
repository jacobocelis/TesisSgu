<?php
/* @var $this FotoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Fotos',
);

$this->menu=array(
	array('label'=>'Agregar Foto', 'url'=>array('create','id'=>$vehiculo->id)),
	array('label'=>'Volver al vehiculo', 'url'=>array('/vehiculo/view','id'=>$vehiculo->id)),
);
?>

<h1>Fotos del vehiculo # <?php echo $vehiculo->numeroUnidad; ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
<style>
	.view img{
		width: 100%;
	}
	.btn-right{
		clear: both;
		width: 100%;
		padding-top: 10px;
		text-align: right;
	}
</style>