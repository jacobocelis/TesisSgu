<?php 
	$this->breadcrumbs=array(
	'Mantenimiento correctivo'=>array('mttoCorrectivo/index'),
	$nom=>array($dir),
	'Detalle de orden',
);
$this->menu=array(
	array('label'=>'<div id="menu"><strong>Órdenes de mantenimiento</strong></div>'),
	array('label'=>'      Crear orden de mantenimiento', 'url'=>array('crearOrdenPreventiva')),
	array('label'=>'      Histórico de ordenes', 'url'=>array('historicoOrdenes')),
	array('label'=>'      Cerrar órdenes de mantenimiento', 'url'=>array('cerrarOrdenes')),
);
?>
<div class='crugepanel user-assignments-role-list'>
	<h1>Detalle de orden de mantenimiento correctivo</h1>
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
					'header'=>'C. operativo',
					'name'=>'cOperativo',
					'value'=>'$data->cOperativo0->nombre.\'  \'.$data->cOperativo0->apellido',
					'htmlOptions'=>array('style'=>'text-align:center;width:80px'),
				),
				array(
					'header'=>'C. de transporte',
					'name'=>'cTaller',
					'value'=>'$data->cTaller0->nombre.\'  \'.$data->cTaller0->apellido',
					'htmlOptions'=>array('style'=>'text-align:center;width:80px'),
				),
				array(
					'header'=>'Taller asignado',
					'name'=>'taller',
					'value'=>'$data->taller0->nombre',
					'htmlOptions'=>array('style'=>'text-align:center;width:80px'),
				),
				array(
					'header'=>'Cerrar órden',
					'value'=>'CHTML::checkBox("campo",0,array(\'id\'=>"campo$data->id",\'width\'=>4,\'maxlength\'=>2,\'onchange\'=>"return cerrar($data->id)"))',
					'type'=>'raw',
					'visible'=>$nom=='Cerrar órdenes'?true:false,
					'htmlOptions'=>array('style'=>'width: 50px;text-align: center'),
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
					'headerHtmlOptions'=>array('style'=>'width:7%;text-align:left;background:#F3FDA4'),
					'header'=>'Vehiculo',
					'value'=>'\'<strong>Unidad: </strong> #0\'.$data->numeroUnidad.\' \'.$data->idmodelo0->idmarca0->marca.\'  \'.$data->idmodelo0->modelo.\' \'.$data->anno.\' \'.$data->idcolor0->color',
					'htmlOptions'=>array('style'=>'text-align:left;width:100px;background:#F3FDA4'
				),
			),
		)
    ));
	for($j=0;$j<$idvehiculo[$i]["totAct"];$j++){
	$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'fallas',
				//'selectionChanged'=>'validar',
				'summaryText'=>'',
				'hideHeader'=>true,
			    'enableSorting' => true,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>0,
				'emptyText'=>'',
                'dataProvider'=>$actividades[$i][$j],
				'columns'=>array(
					array(
						'type'=>'raw',
						//'headerHtmlOptions'=>array('style'=>'width:10%;text-align:left;'),
						'header'=>'         Falla',
						'value'=>'\'<strong>Falla:</strong> \'.$data->idfalla0->falla',
						'htmlOptions'=>array('style'=>'text-align:left'),
					),
					array(
						'type'=>'raw',
						//'headerHtmlOptions'=>array('style'=>'text-align:right;'),
						'value'=>'$data->color($data->idestatus,$data->idestatus0->estatus).\'  \'.(date("d/m/Y",strtotime($data->fechaRealizada))=="31/12/1969"?"":date("d/m/Y",strtotime($data->fechaRealizada)))',
						'htmlOptions'=>array('style'=>'text-align:center;width:20%;margin-left:10px;'),
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
						'headerHtmlOptions'=>array('style'=>'width:35%;text-align:left;'),
						'header'=>'<PRE>Recursos',
						'value'=>'\'\'.(($data->idinsumo == null?\'\':$data->idinsumo0->insumo).\'\'.($data->idrepuesto == null?\'\':$data->idrepuesto0->repuesto).\'\'.($data->idservicio == null?\'\':$data->idservicio0->servicio)).\'\'',
						'htmlOptions'=>array('style'=>'text-align:left;width:150px'),
					),
					array(
					'headerHtmlOptions'=>array('style'=>'text-align:left;'),
					'header'=>'<PRE>Tipo',
					'value'=>'(($data->idinsumo == null?\'\':\'Insumo\').\'\'.($data->idrepuesto == null?\'\':\'Repuesto\').\'\'.($data->idservicio == null?\'\':\'Servicio\')).\' \'',
					'htmlOptions'=>array('style'=>'width:40px;'),
					//'footer'=>'',
				),
					array(
					'headerHtmlOptions'=>array('style'=>'text-align:left;'),
					'header'=>'<PRE>Cantidad',
					'value'=>'$data->cantidad',
					'htmlOptions'=>array('style'=>'width:40px;'),
					
					//'footer'=>'',
					),
					array(
					'headerHtmlOptions'=>array('style'=>'text-align:left;'),
					'header'=>'<PRE>Unidad',
					'value'=>'$data->idunidad0->unidad',
					'htmlOptions'=>array('style'=>'width:40px;'),
					//'footer'=>'',
					),
					array(
					'headerHtmlOptions'=>array('style'=>'text-align:left; width:50px;'),
					'header'=>'<PRE>Costo unitario',
					'value'=>'number_format($data->costoUnitario, 2,",",".").\' Bs.\'',
					'htmlOptions'=>array('style'=>'width:50px;'),
					//'footer'=>'',
					),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:right;'),
					'header'=>'<PRE>Total',
					'value'=>'$data->costoTotal',
					'value'=>'number_format($data->costoTotal, 2,",",".").\' Bs.\'',
					'htmlOptions'=>array('style'=>'width:50px;text-align:right;'),
					//'footer'=>'',
				),
			)
    ));
	}
}}
if(count($factura->getData())>0){
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'factura',
				'summaryText'=>'',
				'selectableRows'=>0,
			    'enableSorting' => false,
				'emptyText'=>'no hay una factura registrada',
                'dataProvider'=>$factura,
				'columns'=>array(
					array(
					'header'=>'Fecha de factura',
					'name'=>'fechaFactura',
					'type'=>'raw',
					'value'=>'date("d/m/Y",strtotime($data->fechaFactura))',
					'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
				),
				array(
					'header'=>'Código de factura',
					'name'=>'codigo',
					'type'=>'raw',
					//'value'=>'',
					'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
				),
				array(
					'header'=>'Proveedor',
					'name'=>'idproveedor',
					'type'=>'raw',
					'value'=>'$data->idproveedor0->nombre',
					'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
				),
				array(
					'headerHtmlOptions'=>array('style'=>'width:10px;text-align:center;'),
					'header'=>'Sub-Total',
					'name'=>'total',
					'type'=>'raw',
					'value'=>'number_format($data->total, 2,",",".").\' Bs.\'',
					'htmlOptions'=>array('style'=>'width:10px;text-align:center;'),
				),
				array(
					'headerHtmlOptions'=>array('style'=>'width:10px;text-align:center;'),
					'header'=>'IVA',
					'name'=>'iva',
					'type'=>'raw',
					'value'=>'number_format($data->iva, 2,",",".").\' Bs.\'',
					'htmlOptions'=>array('style'=>'width:10px;text-align:center;'),
				),
				array(
					'headerHtmlOptions'=>array('style'=>'width:10px;text-align:center;'),
					'header'=>'Total Facturado',
					'name'=>'totalFactura',
					'type'=>'raw',
					'value'=>'number_format($data->totalFactura, 2,",",".").\' Bs.\'',
					'htmlOptions'=>array('style'=>'width:10px;text-align:center;'),
				),
			)
    ));
}
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
h1 {
    font-size: 250%;
    line-height: 40px;
}
.grid-view .summary {
    margin: 2px 0px 0px;
    text-align: right;
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
function cerrar(orden){
	if(confirm('¿confirma que desea cerrar la orden?')){
	var dir="<?php echo Yii::app()->baseUrl."/mttoCorrectivo/estatusOrden"?>";
		x=7;
	jQuery.ajax({
                url: dir+"/"+x,
                'data':$(this).serialize()+ '&id=' + orden,
                'type':'post',
                'dataType':'json',
				'success':function(){
					window.location.replace("<?php echo Yii::app()->baseUrl."/mttoCorrectivo/index"?>");	
				},
                'cache':false});			
	}
	$.fn.yiiGridView.update('ordenes');
}

</script>