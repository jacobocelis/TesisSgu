<?php
/* @var $this ReportefallaController */
/* @var $model Reportefalla */

$this->breadcrumbs=array(
	'Reportefallas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Reportefalla', 'url'=>array('index')),
	array('label'=>'Create Reportefalla', 'url'=>array('create')),
	array('label'=>'View Reportefalla', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Reportefalla', 'url'=>array('admin')),
);
?>

<h1>Update Reportefalla <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>