<?php
/* @var $this GrupoController */
/* @var $model Grupo */

$this->breadcrumbs=array(
	'Grupos'=>array('index'),
	'Admnistrar',
);

$this->menu=array(
	array('label'=>'Ver grupos registrados', 'url'=>array('index')),
	array('label'=>'Crear nuevo grupo', 'url'=>array('create')),
);

?>

<h1>Administrar grupos</h1>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'grupo-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'grupo',
		'descripcion',
	
		array(
			'name'=>'idtipo',
			'value'=>'$data->idtipo0->tipo','type'=>'text',
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
