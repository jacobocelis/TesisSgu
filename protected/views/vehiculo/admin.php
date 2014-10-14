<?php
/* @var $this VehiculoController */
/* @var $model Vehiculo */

$this->breadcrumbs=array(
	'Vehiculos'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar vehiculos', 'url'=>array('index')),
	array('label'=>'Registrar vehiculo', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#vehiculo-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar vehiculos</h1>

<p>
Puede hacer búsquedas mediante un operador de comparación (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) el operador debe ir al comienzo de cada uno de sus valores de búsqueda para especificar cómo se debe hacer la comparación.
</p>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'vehiculo-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		
		'numeroUnidad',
		'serialCarroceria',
		'serialMotor',
		'placa',
		'anno',
		/*
		'nroPuestos',
		'nroEjes',
		'capCarga',
		'comentario',
		'cantidadRuedas',
		'capTanque',
		'idmodelo',
		'idgrupo',
		'idcombustible',
		'idcolor',
		'idpropiedad',
		'fechaRegistro',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
