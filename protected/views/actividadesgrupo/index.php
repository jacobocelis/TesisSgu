<?php
/* @var $this ActividadesgrupoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Actividadesgrupos',
);

$this->menu=array(
	array('label'=>'Create Actividadesgrupo', 'url'=>array('create')),
	array('label'=>'Manage Actividadesgrupo', 'url'=>array('admin')),
);
?>

<h1>Actividadesgrupos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
