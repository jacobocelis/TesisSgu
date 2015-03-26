<?php
/* @var $this VehiculoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Vehiculos'=>array('/vehiculo/index'),
	'Histórico'
);

$this->menu=array(
	array('label'=>'<div id="menu"><strong>Vehiculos</strong></div>' , 'visible'=>'1'),
	array('label'=>'Vehiculos registrados', 'url'=>array('vehiculo/index')),
	array('label'=>'Registrar vehiculo', 'url'=>array('vehiculo/create')),
	array('label'=>'Histórico de vehiculos', 'url'=>array('vehiculo/historico')),
	//array('label'=>'Administrar vehiculos', 'url'=>array('admin')),
	array('label'=>'<div id="menu"><strong>Grupos</strong></div>' , 'visible'=>'1'),
	array('label'=>'Ver grupos', 'url'=>array('grupo/index')),
	array('label'=>'Crear grupo', 'url'=>array('grupo/create')),
);
?>
	
<div class='crugepanel user-assignments-detail'>
<h1>Histórico de vehiculos</h1>
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
		array(
			'header'=>'# unidad',
			'name'=>'numeroUnidad',
			'value'=>'\' <b>\'.$data->numeroUnidad.\' </b>\'',
			'type'=>'raw',
			'htmlOptions'=>array('style'=>'text-align:center'),	
		),
		
		//'numeroUnidad',
		//'serialCarroceria',
		//'serialMotor',
		array(
			'header'=>'Marca',
			'name'=>'idmodelo',
			'value'=>'$data->idmodelo0->idmarca0->marca',
			'type'=>'text',
			'htmlOptions'=>array('style'=>'text-align:center'),	
		),
		
		array(
			'header'=>'Modelo',
			'name'=>'idmodelo',
			'value'=>'$data->idmodelo0->modelo',
			'htmlOptions'=>array('style'=>'text-align:center'),	
		),
		
		'placa',
		'anno',
		array(
			'header'=>'Puestos',
			'name'=>'nroPuestos',
			'htmlOptions'=>array('style'=>'text-align:center'),	
		),
		//'nroEjes',
		//'capCarga',
		//'comentario',
		//'cantidadRuedas',
		//'capTanque',
		
		array(
			'name'=>'idcombustible',
			'value'=>'$data->idcombustible0->combustible',
			'htmlOptions'=>array('style'=>'text-align:center'),	
		),
		array(
			'name'=>'fechaRegistro',
			//'value'=>'$data->idcombustible0->combustible',
			'htmlOptions'=>array('style'=>'text-align:center'),	
		),
		array(
			'name'=>'idcolor',
			'value'=>'$data->idcolor0->color',
			'htmlOptions'=>array('style'=>'text-align:center'),	
		),
		array(
			'name'=>'idpropiedad',
			'value'=>'$data->idpropiedad0->propiedad',
			'htmlOptions'=>array('style'=>'text-align:center'),	
		),
		array(
			'header'=>'estado',
			'value'=>'$data->getEstado($data->id)',
			'htmlOptions'=>array('style'=>'text-align:center'),	
			'type'=>'raw'
		),
		/*array(
			'name'=>'motivo',
			'value'=>'$data->Historicoedoses->motivo',
			'htmlOptions'=>array('style'=>'text-align:center'),	
		),*/
		//'fechaRegistro',
		
			array(
						'headerHtmlOptions'=>array('style'=>'text-align:center;width:50px;'),
						'htmlOptions'=>array('style'=>'text-align:center;'),
						'header'=>'Detalle',
						'type'=>'raw',
						'value'=>'CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/ver.png",
                                          "Ver detalle",array("title"=>"Ver")),
										  
                        Yii::app()->createUrl("vehiculo/detalleHistorico", array("id"=>$data->id)),
                        array(
								
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                
                        )
                );',),
	),
)); ?>
</div>
<style>
#menu{
	font-size:15px;

}
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

