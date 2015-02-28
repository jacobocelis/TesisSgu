<?php
/* @var $this CombustibleController */
/* @var $model Historicocombustible */

$this->breadcrumbs=array(
	'Combustible'=>array('index'),
	'Histórico',
);

$this->menu=array(

	array('label'=>'<div id="menu"><strong>Combustible</strong></div>'),
	array('label'=>'      Registrar reposición', 'url'=>array('registrarReposicion')),
	
	
	array('label'=>'<div id="menu"><strong>Historial</strong></div>'),
	array('label'=>'      Histórico de reposiciónes', 'url'=>array('combustible/historicoReposicion')),
	array('label'=>'      Histórico de gastos', 'url'=>array('historicoGastos')),
	array('label'=>'<div id="menu"><strong>Parámetros</strong></div>'),
	array('label'=>'      Administración de parámetros', 'url'=>array('parametros')),
	
);
?>
<div class='crugepanel user-assignments-detail'>
<h1>Histórico de reposiciones</h1>
<div id="filtro" style="width:20%">
<i>Por # de unidad: </i>

		<?php $model=new Vehiculo;	
		echo CHtml::dropDownList('vehiculo',$model,CHtml::listData(Vehiculo::model()->findAll(),'id','numeroUnidad'),
              array('empty' => 'Todos',
                   'style'=>"width:80px;")); 
        ?>
</div>
<div id="fechas" style="float:left;">
<i>Por período: </i>
		<?php echo CHtml::textField('Fechaini', '',array('style'=>'width:80px;cursor:pointer;','size'=>"10","readonly"=>'readonly','placeholder'=>"Inicio",'id'=>'inicio')); ?>
		<?php echo CHtml::textField('Fechafin', '',array('style'=>'width:80px;cursor:pointer;',"readonly"=>'readonly','disabled'=>'disabled','id'=>'fin','placeholder'=>"Fin")); 
		echo CHtml::submitButton('Buscar',array("id"=>"boton","onclick"=>"FiltrarFecha()","style"=>"float:right;margin-top:2px;margin-left:10px;")); ?>
</div>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'historico',
				'summaryText'=>'',
				'selectableRows'=>1,
				'template'=>"{items}\n{summary}\n{pager}",
				'emptyText'=>'no se han registrado reposiciones',
                'dataProvider'=>$dataProvider,
				'htmlOptions'=>array('style'=>'font-size: 1.0em;'),
				'columns'=>array(
				array(
					'header'=>'Unidad',
					'name'=>'idvehiculo',
					'value'=>'str_pad((int) $data->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:40px'),
				),
				array(
					'header'=>'Litros',
					'name'=>'litros',
					//'value'=>'$data->idfalla0->falla',
					'htmlOptions'=>array('style'=>'text-align:center;width:25px'),
				),
				array(
					'type'=>'raw',
					'header'=>'Combustible',
					'name'=>'idcombust',
					'value'=>'$data->idcombust0->tipo',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px'),
				),
				array(
					'header'=>'Conductor',
					'name'=>'idempleado',
					'value'=>'$data->idconductor0->nombre.\' \'.$data->idconductor0->apellido',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px'),
				),
				array(
					'header'=>'Estación',
					'name'=>'idestacionServicio',
					'value'=>'$data->idestacionServicio0->nombre',
					'htmlOptions'=>array('style'=>'text-align:center;width:60px'),
				),
				array(
					'type'=>'raw',
					'header'=>'Fecha reposición',
					'name'=>'fecha',
					'value'=>'date("d/m/Y h:m A",strtotime($data->fecha))',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px'),
				),
			)
        ));
?>
<?php
/*ventana agregar actividad*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'nuevaPos',
    'options'=>array(
 
        'autoOpen'=>false,
        'modal'=>true, 
    ),
));?>
<?php $this->endWidget();?>
</div>
<style>
#menu {
    font-size: 15px;
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
.rojo{
background: none repeat scroll 0% 0% #FFD6D6;
}
#lista{
	width:50px;
}
#verde{
	color: #0FA526;
	font-weight: bold;
}
.grid-view table.items th {
    text-align: center;
    background: none repeat scroll 0% 0% rgba(0, 138, 255, 0.15);
	color: #000;
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
<script>
$(function($){
	    $.datepicker.regional['es'] = {
	        closeText: 'Cerrar',
	        prevText: 'Anterior',
	        nextText: 'Siguiente',
	        currentText: 'Hoy',
	        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
	        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
	        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
	        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
	        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
	        weekHeader: 'Sm',
	        dateFormat: 'dd/mm/yy',
	        firstDay: 1,
	        isRTL: false,
			changeMonth: true,
            changeYear: true,
	        showMonthAfterYear: false,
	        yearSuffix: '',
	        maxDate: '0d',
	        //minDate: '-30d',
	    };
	    $.datepicker.setDefaults($.datepicker.regional['es']);
		});  
		
		$("#inicio").datepicker({
			onSelect: function(selected) {
				$("#fin").datepicker("option","minDate", selected+" +1d");
				if($("#inicio").val().length==0)
					
					$('#fin').attr("disabled", true);
				else
					$('#fin').attr("disabled", false);
			}
		});
		$("#fin").datepicker({
			onSelect: function(selected) {
				
			}
		});
		
function FiltrarFecha(){
	var hoy="<?php echo date("d/m/Y")?>";
	if($("#fin").val().length==0 && $("#inicio").val().length>0)
		$("#fin").val(hoy);
	$.fn.yiiGridView.update('historico',{ data : "fechaIni="+$("#inicio").val()+"&fechaFin="+$("#fin").val()+"&vehiculo="+$("#vehiculo").val()});
}
</script>