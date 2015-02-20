<div id="scrollingDiv" class="btn" style="display:none">Crear órden de neumáticos</div>
<?php 
	$this->breadcrumbs=array(
	'Mantenimiento preventivo'=>array('mttoPreventivo/index'),
	'Crear orden preventiva',
);
$this->menu=array(
	array('label'=>'<div id="menu"><strong>Opciones de mantenimiento</strong></div>'),
	array('label'=>'      Registrar actividades de mantenimiento', 'url'=>array('planes')),
	array('label'=>'      Registrar matenimientos iniciales <span id="mi" class="badge badge-'.$color.' pull-right">'.$mi.'</span>', 'url'=>array('mttoPreventivo/iniciales/')),
	array('label'=>'      Ajuste de fechas en calendario', 'url'=>array('mttoPreventivo/calendario')),
	
	
	array('label'=>'<div id="menu"><strong>Órdenes de mantenimiento</strong></div>'),
	array('label'=>'      Crear orden de mantenimiento', 'url'=>array('mttoPreventivo/crearOrdenPreventiva')),
	array('label'=>'      Ver órdenes abiertas <span class="badge badge-'.$Colorabi.' pull-right">'.$abiertas.'</span>', 'url'=>array('mttoPreventivo/verOrdenes')),
	array('label'=>'      Órdenes listas para cerrar <span class="badge badge-'.$Colorli.' pull-right">'.$listas.'</span>', 'url'=>array('mttoPreventivo/cerrarOrdenes')),
	
	array('label'=>'<div id="menu"><strong>Gestión de coordinadores</strong></div>'),
	array('label'=>'      Coordinador operativo y de transporte', 'url'=>array('empleados/coordinadores')),
	
	
	array('label'=>'<div id="menu"><strong>Historial</strong></div>'),
	array('label'=>'      Histórico de mantenimientos', 'url'=>array('mttoPreventivo/historicoPreventivo')),
	array('label'=>'      Histórico de gastos', 'url'=>array('mttoPreventivo/historicoGastos')),
	array('label'=>'      Histórico de ordenes', 'url'=>array('mttoPreventivo/historicoOrdenes')),
);
?>
<div class='crugepanel user-assignments-role-list'>
	<h1>Seleccione las actividades a incluir en la orden de mantenimiento</h1>
	<?php //<p><b>Nota: </b><i>Sólo se mostrarán las actividades con menos de 5 dias restantes o que posean atraso</p></i>?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'actividades',
				'selectionChanged'=>'validar',
				'summaryText'=>'',
			    'enableSorting' => true,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>2,
				'emptyText'=>'No hay actividades a tiempo de mantenimiento',
                'dataProvider'=>$dataProvider,
				'rowCssClassExpression'=>'$this->dataProvider->data[$row]->diasRestantes($this->dataProvider->data[$row]->proximoFecha)<=5 || ($this->dataProvider->data[$row]->kmRestantes($this->dataProvider->data[$row]->idvehiculo,$this->dataProvider->data[$row]->proximoKm))<=50?"rojo":"even"',
				'ajaxUpdate'=>false,
				'columns'=>array(
				array(
					//'header'=>'Seleccione las actividades a incluir',
					'class'=>'CCheckBoxColumn',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'headerHtmlOptions'=>array('style'=>'width:7%'),
					'header'=>'Unidad',
					'name'=>'idplan',
					'value'=>'$data->idvehiculo0->numeroUnidad',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:10px'),
				),
				array(
					'header'=>'Actividad',
					'name'=>'idactividadMtto',
					'value'=>'$data->idactividadMtto0->actividad',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px'),
				),
				
				/*array(
					'header'=>'Fecha de próximo mantenimiento',
					'name'=>'proximoFecha',
					'htmlOptions'=>array('style'=>'width:100px;text-align:center;'),
				),*/
				
				array(
					'header'=>'Prioridad',
					'name'=>'idprioridad',
					'value'=>'$data->idprioridad0->prioridad',
					'htmlOptions'=>array('style'=>'width:70px;text-align:center;'),
				),
				array(
					'type'=>'raw',
					'header'=>'Atraso',
					'name'=>'atraso',
					'value'=>'\'<b><span style="color:red">\'.$data->atraso($data->proximoFecha).\'</span></b><br><b><span style="color:red">\'.$data->atrasoKm($data->idvehiculo,$data->proximoKm).\'</span></b>\'',
					'htmlOptions'=>array('style'=>'width:60px;text-align:center;'),
				),
				array(
					'type'=>'raw',
					'header'=>'Kms restantes',
					'name'=>'frecuenciaKm',
					'value'=>'$data->kmRestantes($data->idvehiculo,$data->proximoKm)<=50?\'<strong><span style="color:red">\'.$data->kmRestantes($data->idvehiculo,$data->proximoKm).\'</span></strong>\':$data->kmRestantes($data->idvehiculo,$data->proximoKm)',
					'htmlOptions'=>array('style'=>'width:110px;text-align:center;'),
				),
				
				array(
					'type'=>'raw',
					'header'=>'Días restantes',
					'name'=>'proximoKm',
					'value'=>'$data->diasRestantes($data->proximoFecha).$this->grid->Controller->createWidget("zii.widgets.jui.CJuiProgressBar",array(
								"value"=>intval($data->porcentaje($data->ultimoFecha,$data->proximoFecha)),
								"htmlOptions"=>array(
								"style"=>"width:80%; height:20px; float:right;background:#".$data->obtColor($data->diasRestantes($data->proximoFecha)))))->run()',
					'htmlOptions'=>array('style'=>'width:110px;text-align:center;'),
				),
				
			)
        ));
		?>
		</div>
<?php 
	/*$this->renderPartial('_formCrearOrden',array('model'=>$modeloOrdenMtto));*/?>
	
<?php
/*ventana agregar recurso*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'formulario',
    'options'=>array(
        'title'=>'Crear orden de neumáticos',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>490,
        //'height'=>360,
		'position'=>array(null,100),
		'resizable'=>false,
		'close'=>'js:function(){ $("#scrollingDiv").show(300); }',
    ),
));?>
<div class="divForForm"></div>
<?php $this->endWidget();?>

<style>
.rojo{
background: none repeat scroll 0% 0% #FFD6D6;
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
#scrollingDiv{
	position: fixed;
}
.btn {
	-moz-box-shadow:inset 0px 1px 0px 0px #54a3f7;
	-webkit-box-shadow:inset 0px 1px 0px 0px #54a3f7;
	box-shadow:inset 0px 1px 0px 0px #54a3f7;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #007dc1), color-stop(1, #0061a7));
	background:-moz-linear-gradient(top, #007dc1 5%, #0061a7 100%);
	background:-webkit-linear-gradient(top, #007dc1 5%, #0061a7 100%);
	background:-o-linear-gradient(top, #007dc1 5%, #0061a7 100%);
	background:-ms-linear-gradient(top, #007dc1 5%, #0061a7 100%);
	background:linear-gradient(to bottom, #007dc1 5%, #0061a7 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#007dc1', endColorstr='#0061a7',GradientType=0);
	background-color:#007dc1;
	-moz-border-radius:3px;
	-webkit-border-radius:3px;
	border-radius:3px;
	border:1px solid #124d77;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Verdana;
	font-size:13px;
	font-weight:bold;
	padding:6px 4px;
	text-decoration:none;
	text-shadow:0px 1px 0px #154682;
}
.btn:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #0061a7), color-stop(1, #007dc1));
	background:-moz-linear-gradient(top, #0061a7 5%, #007dc1 100%);
	background:-webkit-linear-gradient(top, #0061a7 5%, #007dc1 100%);
	background:-o-linear-gradient(top, #0061a7 5%, #007dc1 100%);
	background:-ms-linear-gradient(top, #0061a7 5%, #007dc1 100%);
	background:linear-gradient(to bottom, #0061a7 5%, #007dc1 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#0061a7', endColorstr='#007dc1',GradientType=0);
	background-color:#0061a7;
	color: #fff;
}
.ui-progressbar .ui-widget-header {
	background: #FFF;
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
var ancho=$(window).width()-($(window).width()*0.20);
$('#scrollingDiv').css({
  'right':ancho,
  'bottom': '50px'
 });
 
 $( "#scrollingDiv" ).click(function() {
	$('#scrollingDiv').hide(300);
	$("#formulario").dialog('open');
});

$('#formulario').hide();
function validar(){
var idAct = $.fn.yiiGridView.getSelection('actividades');
	if(idAct=="")
		$('#scrollingDiv').hide(300);//$('#formulario').hide();
	else
		$('#scrollingDiv').show(300);//$('#formulario').show();
		
jQuery.ajax({
                url: "crearOrden",
                'data':$(this).serialize()+ '&idAct=' + idAct,
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        $('#formulario div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        $('#formulario div.divForForm form').submit(validar); // 
                                }
                                else{
                                        $('#formulario').html(data.div);
										setTimeout("$('#formulario').dialog('close') ",1);
										$('#scrollingDiv').hide();
										window.setTimeout('location.reload()', 1);
										
                                }
                        } ,
                'cache':false});
	

		return false; 
}

</script>