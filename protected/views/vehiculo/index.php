<?php
/* @var $this VehiculoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Vehiculos',
);

$this->menu=array(
	array('label'=>'Registrar vehiculo', 'url'=>array('create')),
	array('label'=>'Grupos de vehiculos', 'url'=>array('/grupo/index')),
	array('label'=>'Administrar vehiculos', 'url'=>array('admin')),
);
?>
<div class='crugepanel user-assignments-detail'>
<h1>Vehiculos registrados</h1>
<?php /*$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); */?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'vehiculo-grid',
	'htmlOptions'=>array(
        //'style'=>'height:120%'
    ),
	'dataProvider'=>$dataProvider,
	//'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		'numeroUnidad',
		//'serialCarroceria',
		//'serialMotor',
		array(
			'header'=>'Marca',
			'name'=>'idmodelo',
			'value'=>'$data->idmodelo0->idmarca0->marca',
			'type'=>'text'
		),
		
		array(
			'header'=>'Modelo',
			'name'=>'idmodelo',
			'value'=>'$data->idmodelo0->modelo',
			'type'=>'text'
		),
		
		'placa',
		'anno',
		array(
			'header'=>'Puestos',
			'name'=>'nroPuestos',
		),
		'nroEjes',
		'capCarga',
		//'comentario',
		'cantidadRuedas',
		//'capTanque',
		
		array(
			'name'=>'idcombustible',
			'value'=>'$data->idcombustible0->combustible',
			'type'=>'text'
		),
		array(
			'name'=>'idcolor',
			'value'=>'$data->idcolor0->color',
			'type'=>'text'
		),
		array(
			'name'=>'idpropiedad',
			'value'=>'$data->idpropiedad0->propiedad',
			'type'=>'text'
		),
		
		//'fechaRegistro',
		
		array(
			'header'=>'Opciones',
			'class'=>'CButtonColumn',
			 'template'=>'{view}',
		),
	),
)); ?>
</div>
<style>
.crugepanel {
    background-color: #FFF;
    border: 1px dotted #AAA;
    border-radius: 1px;
    box-shadow: 3px 3px 5px #EEE;
    display: block;
    margin-top: 10px;
    padding: 10px;
}
.grid-view table.items th {
    text-align: center;
    background: none repeat scroll 0% 0% rgba(0, 138, 255, 0.15);
}
.grid-view table.items th a {
    color: #000!important;
    font-weight: bold;
    text-decoration: none;
}
.grid-view table.items td {
    font-size: 0.9em;
    border: 1px solid #5877C3;
    padding: 0.3em;
}
.grid-view table.items th, .grid-view table.items td {
    font-size: 0.9em;
    border: 1px solid #A8C5F0;
    padding: 0.3em;
}
</style>

