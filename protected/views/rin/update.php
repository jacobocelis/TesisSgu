<?php
/* @var $this RinController */
/* @var $model Rin */

$this->breadcrumbs=array(
	'Rins'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Rin', 'url'=>array('index')),
	array('label'=>'Create Rin', 'url'=>array('create')),
	array('label'=>'View Rin', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Rin', 'url'=>array('admin')),
);
?>

<h1>Update Rin <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>