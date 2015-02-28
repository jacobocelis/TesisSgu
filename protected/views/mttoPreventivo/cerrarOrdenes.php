<?php 
	$this->breadcrumbs=array(
	'Mantenimiento preventivo'=>array('mttoPreventivo/index'),
	'Cerrar órdenes',
);
$this->menu=array(
	array('label'=>'<div id="menu"><strong>Opciones de mantenimiento</strong></div>'),
	array('label'=>'      Registrar actividades de mantenimiento', 'url'=>array('planes')),
	array('label'=>'      Registrar matenimientos iniciales <span id="mi" class="badge badge-'.$color.' pull-right">'.$mi.'</span>', 'url'=>array('mttoPreventivo/iniciales/')),
	array('label'=>'      Ajuste de fechas en calendario', 'url'=>array('mttoPreventivo/calendario')),
	
	
	array('label'=>'<div id="menu"><strong>Órdenes de mantenimiento</strong></div>'),
	array('label'=>'      Crear orden de mantenimiento', 'url'=>array('crearOrdenPreventiva')),
	array('label'=>'      Ver órdenes abiertas <span class="badge badge-'.$Colorabi.' pull-right">'.$abiertas.'</span>', 'url'=>array('verOrdenes')),
	array('label'=>'      Órdenes listas para cerrar <span id="listas" class="badge badge-'.$Colorli.' pull-right">'.$listas.'</span>', 'url'=>array('mttoPreventivo/cerrarOrdenes')),
	
	array('label'=>'<div id="menu"><strong>Gestión de coordinadores</strong></div>'),
	array('label'=>'      Coordinador operativo y de transporte', 'url'=>array('empleados/coordinadores')),
	
	
	array('label'=>'<div id="menu"><strong>Historial</strong></div>'),
	array('label'=>'      Histórico de mantenimientos', 'url'=>array('historicoPreventivo')),
	array('label'=>'      Histórico de gastos', 'url'=>array('historicoGastos')),
	array('label'=>'      Histórico de ordenes', 'url'=>array('historicoOrdenes')),
);
?>

<div class='crugepanel user-assignments-role-list'>
	<h1>Cerrar órdenes de mantenimiento</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'ordenes',
				//'selectionChanged'=>'validar',
				'summaryText'=>'',
			    'enableSorting' => true,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>1,
				'emptyText'=>'No hay ordenes listas para cerrar',
                'dataProvider'=>$dataProvider,
				'htmlOptions'=>array('style'=>'cursor:pointer'),
				'columns'=>array(
				array(
					'headerHtmlOptions'=>array('style'=>'width:7%'),
					'header'=>'Orden #',
					'name'=>'id',
					'value'=>'str_pad((int) $data->id,6,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px'),
				),
				
				array(
					'header'=>'Fecha y hora de creada',
					'name'=>'fecha',
					'value'=>'date("d/m/Y h:i A",strtotime($data->fecha))',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px'),
				),
				array( 
					"type"=>"raw",
					'header'=>'Estado',
					'name'=>'idestatus',
					'value'=>'$data->color($data->idestatus,$data->idestatus0->estatus)',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px'),
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
						'headerHtmlOptions'=>array('style'=>'text-align:center;width:50px;'),
						'htmlOptions'=>array('style'=>'text-align:center;'),
						'header'=>'Ver orden',
						'type'=>'raw',
						'value'=>'CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/ver.png",
                                          "Ver detalle",array("title"=>"Ver")),
										  
                        Yii::app()->createUrl("mttoPreventivo/vistaPrevia", array("id"=>$data->id,"nom"=>"Cerrar órdenes","dir"=>"mttoPreventivo/cerrarOrdenes")),
                        array(	
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                        )
                );',),
				array(
						'headerHtmlOptions'=>array('style'=>'text-align:left;width:20px;text-align:center;'),
						'htmlOptions'=>array('style'=>'text-align:center;width:30px;'),
						'header'=>'Actualizar',
						'type'=>'raw',
						'value'=>'CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
										  
                        Yii::app()->createUrl("mttoPreventivo/mttopRealizados", array("id"=>$data->id,"nom"=>"Cerrar órdenes","dir"=>"mttoPreventivo/cerrarOrdenes")),
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                        )
                );',),
				array(
					'header'=>'Cerrar órden',
					'value'=>'CHTML::checkBox("campo",0,array(\'id\'=>"campo$data->id",\'width\'=>4,\'maxlength\'=>2,\'onchange\'=>"return validar($data->id)"))',
					'type'=>'raw',
					'htmlOptions'=>array('style'=>'width: 50px;text-align: center'),
				),
			)
        ));
		?>
		
</div>
<style>
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

function actualizarSpan(){
	var dir="<?php echo Yii::app()->baseUrl;?>"+"/mttoPreventivo/actualizarSpanListas";
	$.ajax({
		url: dir,
		'data':$(this).serialize(),
        'dataType':'json',
         'success':function( result ) {
    	     $('#listas').removeClass($('#listas').attr('class')).addClass('badge badge-'+result.color+' pull-right');
			 $('#listas').text(result.total);
			 
		},});
}
function validar(){		
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
		$.fn.yiiGridView.update('ordenes');
		actualizarSpan();
	}
	
}

</script>