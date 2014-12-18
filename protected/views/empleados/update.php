<?php
/* @var $this EmpleadosController */
/* @var $model Historicoempleados */

$this->breadcrumbs=array(
	'Historicoempleadoses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Historicoempleados', 'url'=>array('index')),
	array('label'=>'Create Historicoempleados', 'url'=>array('create')),
	array('label'=>'View Historicoempleados', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Historicoempleados', 'url'=>array('admin')),
);
?>

<h1>Update Historicoempleados <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>