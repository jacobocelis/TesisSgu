<?php
/* @var $this ActividadesgrupoController */
/* @var $model Actividadesgrupo */

$this->breadcrumbs=array(
	'Actividadesgrupos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Actividadesgrupo', 'url'=>array('index')),
	array('label'=>'Manage Actividadesgrupo', 'url'=>array('admin')),
);
?>

<h1>Create Actividadesgrupo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>