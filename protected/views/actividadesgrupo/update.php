<?php
/* @var $this ActividadesgrupoController */
/* @var $model Actividadesgrupo */

$this->breadcrumbs=array(
	'Actividadesgrupos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Actividadesgrupo', 'url'=>array('index')),
	array('label'=>'Create Actividadesgrupo', 'url'=>array('create')),
	array('label'=>'View Actividadesgrupo', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Actividadesgrupo', 'url'=>array('admin')),
);
?>

<h1>Update Actividadesgrupo <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>