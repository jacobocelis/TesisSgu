<?php
/* @var $this PosicionejeController */
/* @var $model Posicioneje */

$this->breadcrumbs=array(
	'Posicionejes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Posicioneje', 'url'=>array('index')),
	array('label'=>'Create Posicioneje', 'url'=>array('create')),
	array('label'=>'View Posicioneje', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Posicioneje', 'url'=>array('admin')),
);
?>

<h1>Update Posicioneje <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>