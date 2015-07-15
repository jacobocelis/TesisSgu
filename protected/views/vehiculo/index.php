<?php
/* @var $this VehiculoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Vehiculos',
);

$this->menu=array(
	array('label'=>'<div id="menu"><strong>Vehiculos</strong></div>' , 'visible'=>'1'),
	array('label'=>'      Vehiculos registrados', 'url'=>array('vehiculo/index')),
	array('label'=>'      Registrar vehiculo', 'url'=>array('vehiculo/create')),
	array('label'=>'      Histórico de vehiculos', 'url'=>array('vehiculo/historico')),
	//array('label'=>'Administrar vehiculos', 'url'=>array('admin')),
	array('label'=>'<div id="menu"><strong>Grupos</strong></div>' , 'visible'=>'1'),
	array('label'=>'      Ver grupos', 'url'=>array('grupo/index')),
	array('label'=>'      Crear grupo', 'url'=>array('grupo/create')),

	array('label'=>'<div id="menu"><strong>Administrar datos maestros</strong></div>' , 'visible'=>Yii::app()->user->checkAccess('action_vehiculo_parametros')),
	array('label'=>'      Vehiculos', 'url'=>array('vehiculo/parametros') , 'visible'=>Yii::app()->user->checkAccess('action_vehiculo_parametros')),
	array('label'=>'      Grupos', 'url'=>array('grupo/parametros') , 'visible'=>Yii::app()->user->checkAccess('action_grupo_parametros')));
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
	//'dataProvider'=>$dataProvider,
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'header'=>'# unidad',
			'name'=>'numeroUnidad',
			'value'=>'\' <b>\'.str_pad((int) $data->numeroUnidad,2,"0",STR_PAD_LEFT).\' </b>\'',
			'type'=>'raw',
			'htmlOptions'=>array('style'=>'text-align:center;width:60px'),	
			//'filter'=>CHtml::listData(vehiculo::model()->findAll(), 'id', 'numeroUnidad'),   
			//'filterHtmlOptions'=>array('style'=>'text-align: center;','width'=>'80px','empty'=>''),
		),
		
		//'numeroUnidad',
		//'serialCarroceria',
		//'serialMotor',
		
		array(
			'header'=>'Placa',
			'name'=>'placa',
			//'value'=>'$data->idmodelo0->idmarca0->marca',
			'type'=>'text',
			'htmlOptions'=>array('style'=>'text-align:center;width:80px'),	
		),
		array(
			'header'=>'Año',
			'name'=>'anno',
			//'value'=>'$data->idmodelo0->idmarca0->marca',
			'type'=>'text',
			'htmlOptions'=>array('style'=>'text-align:center;width:80px'),	
		),

		array(
			'header'=>'Puestos',
			'name'=>'nroPuestos',
			'htmlOptions'=>array('style'=>'text-align:center;width:30px'),	
		),
		/*array(
			'header'=>'Marca',
			'name'=>'idmodelo',
			'value'=>'$data->idmodelo0->idmarca0->marca',
			'type'=>'text',
			'htmlOptions'=>array('style'=>'text-align:center'),	
		),*/
		
		array(
			'type'=>'raw',
			'header'=>'Modelo',
			'name'=>'idmodelo',
			'value'=>'$data->idmodelo0->idmarca0->marca." ".$data->idmodelo0->modelo',
			'filter'=>CHtml::listData(Modelo::model()->findAll(), 'id', 'modelo'),
			'htmlOptions'=>array('style'=>'text-align:center;width:120px'),	
		),
		array(
			'type'=>'raw',
			'name'=>'idcombustible',
			'value'=>'$data->idcombustible0->combustible',
			'filter'=>CHtml::listData(Tipocombustible::model()->findAll(), 'id', 'combustible'),
			'htmlOptions'=>array('style'=>'text-align:center'),	
		),
		array(
			'type'=>'raw',
			'name'=>'idcolor',
			'value'=>'$data->idcolor0->color',
			'filter'=>CHtml::listData(Color::model()->findAll(), 'id', 'color'),
			'htmlOptions'=>array('style'=>'text-align:center'),	
		),
		array(
			'type'=>'raw',
			'name'=>'idpropiedad',
			'value'=>'$data->idpropiedad0->propiedad',
			'filter'=>CHtml::listData(Propiedad::model()->findAll(), 'id', 'propiedad'),
			'htmlOptions'=>array('style'=>'text-align:center'),	
		),
		/*array(
			'header'=>'estado',
			'value'=>'$data->getEstado($data->id)',
			'htmlOptions'=>array('style'=>'text-align:center'),	
			'type'=>'raw'
		),*/
		 array( 
			  'name'=>'tipo',
			  'type'=>'raw',
			  'header'=>'Tipo',     
			  'value' => '$data->idgrupo0->idtipo0->tipo', 
              'htmlOptions'=>array('style'=>'text-align: center;'),   
			  
              'filter'=>CHtml::listData(Tipo::model()->findAll(), 'id', 'tipo'),   
			  'filterHtmlOptions'=>array('style'=>'text-align: center;'),
			),
        array( 
			  'name'=>'estatus',
			  'headerHtmlOptions'=>array('style'=>'text-align: center;'),
			  'type'=>'raw',
			  'header'=>'Estado',     
			  'value' => '$data->getEstado($data->id)', 
              'htmlOptions'=>array('style'=>'text-align: center;'),
              'filter'=>CHtml::listData(Estado::model()->findAll('id<>4'), 'id', 'estado'),   
			  'filterHtmlOptions'=>array('style'=>'text-align: center;'),
			),
		//'fechaRegistro',
		
		array(
			'header'=>'Detalle',
			'class'=>'CButtonColumn',
			 'template'=>'{view}',
		),
	),
)); ?>
</div>
 

<script>
$('[name="estatus"]').attr('placeholder','Seleccione');
</script>