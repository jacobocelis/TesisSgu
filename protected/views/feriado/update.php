<?php
/* @var $this FeriadoController */
/* @var $model Feriado */

$this->breadcrumbs=array(
	'Feriados'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Feriado', 'url'=>array('index')),
	array('label'=>'Create Feriado', 'url'=>array('create')),
	array('label'=>'View Feriado', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Feriado', 'url'=>array('admin')),
);
?>

<h1>Update Feriado <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>