<?php
/* @var $this TipoinsumoController */
/* @var $model Tipoinsumo */

$this->breadcrumbs=array(
	'Tipoinsumos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Tipoinsumo', 'url'=>array('index')),
	array('label'=>'Create Tipoinsumo', 'url'=>array('create')),
	array('label'=>'View Tipoinsumo', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Tipoinsumo', 'url'=>array('admin')),
);
?>

<h1>Update Tipoinsumo <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>