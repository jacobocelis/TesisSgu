<?php
/* @var $this RecursofallaController */
/* @var $model Recursofalla */

$this->breadcrumbs=array(
	'Recursofallas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Recursofalla', 'url'=>array('index')),
	array('label'=>'Create Recursofalla', 'url'=>array('create')),
	array('label'=>'View Recursofalla', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Recursofalla', 'url'=>array('admin')),
);
?>

<h1>Update Recursofalla <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>