<?php
/* @var $this FotoController */
/* @var $model Foto */

$this->breadcrumbs=array(
	'Fotos'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'Listar Fotos', 'url'=>array('index','id'=>$vehiculo->id)),
	array('label'=>'Administrar Fotos', 'url'=>array('admin')),
);
?>

<h1>Agregar una foto al vehiculo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>