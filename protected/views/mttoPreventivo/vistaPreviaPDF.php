<?php 
	$this->breadcrumbs=array(
	'Mantenimiento preventivo'=>array('mttoPreventivo/index'),
	'Detalle de orden',
);
$this->menu=array(
	array('label'=>'<div id="menu"><strong>Órdenes de mantenimiento</strong></div>'),
	array('label'=>'      Crear orden de mantenimiento', 'url'=>array('crearOrdenPreventiva')),
	array('label'=>'      Histórico de ordenes', 'url'=>array('historicoOrdenes')),
);
?>

<div class='crugepanel user-assignments-role-list'>
	<h1>SIRCA</h1>
	<p>Empresa rental de la UNET</p>
	<p>RIF:G-200007525-2</p>
	<p>Gerencia de negocios Dpto. de transporte</p>
	<h1>Solicitud de servicio preventivo</h1>
<?php

$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'factura',
				'summaryText'=>'',
			   // 'enableSorting' => false,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>0,
				'emptyText'=>'',
                'dataProvider'=>$orden,
				//'htmlOptions'=>array('style'=>'cursor:pointer'),
				'columns'=>array(
				array(
					'headerHtmlOptions'=>array('style'=>'width:7%'),
					'header'=>'Orden #',
					//'name'=>'id',
					'value'=>'str_pad((int) $data->id,6,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:150px'),
				),
				array(
					'header'=>'Fecha y hora',
					//'name'=>'fecha',
					'value'=>'date("d/m/Y h:i A",strtotime($data->fecha))',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px'),
				),
				array(
					'header'=>'Estado',
					//'name'=>'idestatus',
					'value'=>'$data->idestatus0->estatus',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px'),
				),
				array(
					'header'=>'Responsable',
					
					'value'=>'$data->responsable',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:150px'),
				),

			)
        ));
		?>
		</div>
		<div class='crugepanel user-assignments-role-list'>
<?php
for($i=0;$i<$totalVeh;$i++){
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'vehiculos',
				'hideHeader'=>true,
				//'selectionChanged'=>'validar',
				'summaryText'=>'',
			    'enableSorting' => true,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>0,
				'emptyText'=>'No hay ordenes listas para cerrar',
                'dataProvider'=>$vehiculos[$i],
				'columns'=>array(
				array(
					'type'=>'raw',
					'headerHtmlOptions'=>array('style'=>'width:100%;text-align:left;background:#F3FDA4'),
					'header'=>'Vehiculo',
					'value'=>'\'<strong>Unidad: </strong> #0\'.$data->numeroUnidad.\' \'.$data->idmodelo0->idmarca0->marca.\'  \'.$data->idmodelo0->modelo.\' \'.$data->anno.\' \'.$data->idcolor0->color',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:left;background:#F3FDA4'
				),
			),
		)
    ));
	for($j=0;$j<$idvehiculo[$i]["totAct"];$j++){
	$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'actividades',
				//'selectionChanged'=>'validar',
				'summaryText'=>'',
				'hideHeader'=>true,
			    'enableSorting' => true,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>0,
				'emptyText'=>'No hay ordenes listas para cerrar',
                'dataProvider'=>$actividades[$i][$j],
				'columns'=>array(
					array(
						'type'=>'raw',
						//'headerHtmlOptions'=>array('style'=>'width:80%;text-align:left;'),
						'header'=>'         Actividad',
						'value'=>'\'<strong>Actividad:</strong> \'.Plangrupo::model()->parte($data->idplan0->idplanGrupo).\' : \'.$data->idactividadMtto0->actividad',
						'htmlOptions'=>array('style'=>'text-align:left'),
					),
				)
    ));
	if(count($recursos[$i][$j]->getData())>0){
	$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'recursos',
				//'selectionChanged'=>'validar',
				'summaryText'=>'',
			    'enableSorting' => true,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>0,
				'emptyText'=>'Esta actividad no tiene recursos asociados',
                'dataProvider'=>$recursos[$i][$j],
				'columns'=>array(
					array(
						'headerHtmlOptions'=>array('style'=>'width:80%;text-align:left;'),
						'header'=>'<PRE>Recursos',
						'value'=>'\'\'.(($data->idinsumo == null?\'\':$data->idinsumo0->insumo).\'\'.($data->idrepuesto == null?\'\':$data->idrepuesto0->repuesto).\'\'.($data->idservicio == null?\'\':$data->idservicio0->servicio)).\'\'.$data->detalle',
						'htmlOptions'=>array('style'=>'text-align:left;width:200px'),
					),
					array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;'),
					'header'=>'<PRE>Cantidad',
					'value'=>'$data->cantidad',
					'htmlOptions'=>array('style'=>'width:50px;text-align:center;'),
					
					//'footer'=>'',
				),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;'),
					'header'=>'<PRE>Unidad',
					'value'=>'$data->idunidad0->unidad',
					'htmlOptions'=>array('style'=>'width:50px;text-align:center;'),
					
					//'footer'=>'',
				),
			)
    ));
	}
}}
?>
		
</div>
<style>
strong {
    font-weight: bold;
    font-size: 115%;
}
pre {
    display: block;
    padding: 5.5px;
    margin: 0px 0px 10px;
    font-size: 13px;
    line-height: 20px;
    word-break: break-all;
    word-wrap: break-word;
    white-space: pre-wrap;
    background-color: #F5F5F5;
    border: 1px solid rgba(0, 0, 0, 0.15);
    border-radius: 4px;
}
.grid-view {
    padding: 0px 0px;
}
#menu{
	font-size:15px;
}
.grid-view table.items tr.selected {
    background: none repeat scroll 0% 0% rgba(0, 249, 3, 0.3);
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
p{
	text-align:center;
}
h1 {
    font-size: 150%;
    line-height: 40px;
	text-align:center;
}
.grid-view table.items th {
	color: rgba(0, 0, 0, 1);
    text-align: center;
    background: none repeat scroll 0% 0% rgba(0, 138, 255, 0.15);
}
.grid-view table.items th a {
    color: #000;
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
<style>
.ui-progressbar .ui-widget-header {
	background: #FFF;
}
.ui-widget-header {
    border: 1px solid #AAA;
    background-image: url("<?php echo Yii::app()->request->baseUrl;?>/imagenes/imagen.png");
    color: #222;
    font-weight: bold;
}
.ui-progressbar {
    border: 0px none;
    border-radius: 0px;
    clear: both;
	margin-bottom: 0px;
}
.progress, .ui-progressbar {
    height: 10px;
}
.ui-corner-all, .ui-corner-bottom, .ui-corner-right, .ui-corner-br {
    border-bottom-right-radius: 0px;
}
.ui-corner-all, .ui-corner-bottom, .ui-corner-left, .ui-corner-bl {
    border-bottom-left-radius: 0px;
}
.ui-corner-all, .ui-corner-top, .ui-corner-right, .ui-corner-tr {
    border-top-right-radius: 0px;
}
.ui-corner-all, .ui-corner-top, .ui-corner-left, .ui-corner-tl {
    border-top-left-radius: 0px;
}
</style>
<script>
$('#formulario').hide();
function validar(){
var idAct = $.fn.yiiGridView.getSelection('actividades');
	if(idAct=="")
		$('#formulario').hide(500);
	else
		$('#formulario').show(500);
		
jQuery.ajax({
                url: "crearOrden",
                'data':$(this).serialize()+ '&idAct=' + idAct,
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        $('#formulario').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        $('#formulario form').submit(validar); // 
                                }
                                else{
                                        $('#formulario').html(data.div);
                                }
                        } ,
                'cache':false});
	

		return false; 
}
function validar(orden){
	if(confirm('¿confirma que desea cerrar la orden?')){
	var dir="<?php echo Yii::app()->baseUrl."/mttoPreventivo/estatusOrden"?>";
		x=7;
	jQuery.ajax({
                url: dir+"/"+x,
                'data':$(this).serialize()+ '&id=' + orden,
                'type':'post',
                'dataType':'json',
                'cache':false});			
	}
	$.fn.yiiGridView.update('ordenes');
}

</script>