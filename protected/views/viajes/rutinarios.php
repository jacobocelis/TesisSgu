<?php
/* @var $this ViajesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Viajes',
);

$this->menu=array(
	array('label'=>'<div id="menu"><strong>Viajes</strong></div>'),
	array('label'=>'Registrar viajes especiales', 'url'=>array('especiales')),
	array('label'=>'<div id="menu"><strong>Historial</strong></div>'),
	array('label'=>'Histórico de viajes', 'url'=>array('admin')),
	array('label'=>'Estadísticas de viajes', 'url'=>array('admin')),
);
?>
<div class='crugepanel user-assignments-detail'>
<h1>Registro de viajes rutinarios</h1>
<label >Seleccione la fecha:  </label><br><?php echo CHtml::textField('Fecha',date('d/m/Y'),array('id'=>'fecha','size'=>10,'readonly'=>'readonly','maxlength'=>8, 'style'=>'width:100px;cursor:pointer;'));?>
<br>
<strong>Opciones:</strong> 
<br>		
<?php
 echo CHtml::link('1. Registrar nuevo viaje<br>', "", 
 array(
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregarViajeRutinario(); }"));
		?>

		<div id='etiqueta' ><?php echo CHtml::link('2. Registrar viajes de última rutina', "",  
 array(
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{ultimosViajes(); }"));
	?>
	<span class="badge badge-important pull-right"><?php echo $total;?></span></div>
	<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'viajes',
				'summaryText'=>'',
				'selectableRows'=>1,
				'template'=>"{items}\n{summary}\n{pager}",
			    'enableSorting' => true,
				'emptyText'=>'no hay viajes registrados para ésta fecha',
                'dataProvider'=>$dataProvider,
				'htmlOptions'=>array('style'=>'font-size: 1.0em;'),
				'columns'=>array(
				array(
					'header'=>'Unidad',
					'name'=>'idvehiculo',
					'value'=>'str_pad((int) $data->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT)',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px;'),
				),
				array(
					'header'=>'Ruta realizada',
					'name'=>'idviaje',
					'value'=>'$data->idviaje0->idOrigen0->lugar.\' - \'.$data->idviaje0->idDestino0->lugar',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px;'),
				),

				array(
					'header'=>'Hora de salida',
					'name'=>'horaSalida',
					'value'=>'date("g:i a", strtotime($data->horaSalida));',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px;'),
				),
				array(
					'header'=>'Hora de llegada',
					'name'=>'horaLlegada',
					'value'=>'date("g:i a", strtotime($data->horaLlegada));',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px;'),
				),
				array(
					'header'=>'Distancia',
					'value'=>'$data->idviaje0->distanciaKm.\' Km \'',
					//'value'=>'date("g:i a", strtotime($data->horaLlegada));',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px;'),
				),
				array(
						'headerHtmlOptions'=>array('style'=>'text-align:center;width:10px;'),
						'htmlOptions'=>array('style'=>'text-align:center;width:30px;'),
						'header'=>'Modificar',
						'type'=>'raw',
						'value'=>'CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{editarViaje("\'.Yii::app()->createUrl("Viajes/update",array("id"=>$data["id"])).\'"); $("#modificar").dialog("open");}\'
                        )
                );',),
				array(
					'header'=>'Eliminar',
					'class'=>'CButtonColumn',
					 'template'=>'{delete}',
					     'buttons'=>array(
							'delete' => array(
								'url'=>'Yii::app()->createUrl("viajes/delete", array("id"=>$data->id))',
						),
					),
				),
			)
        ));
?>

</div>
<?php
/*ventana agregar recurso*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'viaje',
    'options'=>array(
        'title'=>'Registrar viaje realizado',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>390,
		'position'=>array(500,100),
		'resizable'=>false
    ),
));?>
<div class="divForForm"></div>
 
<?php $this->endWidget();?>
<?php
/*ventana agregar recurso*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'modificar',
    'options'=>array(
        'title'=>'modificar datos del viaje',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>390,
		'position'=>array(500,100),
		'resizable'=>false
    ),
));?>
<div class="divForForm"></div>
 
<?php $this->endWidget();?>
<style>
.badge {
    margin-left: 3px;
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
#menu {
    font-size: 15px;
}
#etiqueta{
	width: auto;
	float: left;
    height: 35px;
}
</style>
<style>
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
	        //minDate: '0d',
	    };
	    $.datepicker.setDefaults($.datepicker.regional['es']);
	});      		
	$("#fecha").datepicker({
		onSelect: function(selected){
			var fecha=$('#fecha').val();
			$.fn.yiiGridView.update('viajes',{data:"fecha="+fecha});
			var hoy="<?php echo date('d/m/Y');?>";
				if($('#fecha').val()==hoy)
			$('#etiqueta').show();
			else
				$('#etiqueta').hide();
		}
});
</script>
<script>
function agregarViajeRutinario(){
$('#viaje').dialog('open');
	var fecha=$('#fecha').val();
	var dir="<?php echo Yii::app()->baseUrl."/viajes/agregarViajeRutinario/"?>";
	jQuery.ajax({
                url: dir,
                'data':$(this).serialize()+"&fecha="+fecha,
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        $('#viaje div.divForForm').html(data.div);
                                        $('#viaje div.divForForm form').submit(agregarViajeRutinario);
                                }
                                else{
                                        $('#viaje div.divForForm').html(data.div);
                                        setTimeout("$('#viaje').dialog('close') ",1000);
                                        $.fn.yiiGridView.update('viajes');
                                }
                        },
                'cache':false});
    return false; 
}
function ultimosViajes(){
var total="<?php echo $total?>";
if(total>0){
if (confirm("¿Confirma que desea agregar los ultimos viajes registrados?")){
	var dir="<?php echo Yii::app()->baseUrl."/viajes/ultimosViajes/"?>";
	jQuery.ajax({
                url: dir,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'hecho'){
									 $.fn.yiiGridView.update('viajes');
									 $('#etiqueta').hide();
                                }
                        },
                'cache':false});
	}}
	else
		alert('aún no se han registrado viajes');
    return false; 
}
function editarViaje(id){
$('#modificar').dialog('open');
	 if (typeof(id)=='string')
                Uurl=id;
	jQuery.ajax({
                url: Uurl,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data)
                        {
                                if (data.status == 'failure')
                                {
                                        $('#modificar div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        $('#modificar div.divForForm form').submit(editarViaje); // updatePaymentComment
                                }
                                else
                                {
                                        $('#modificar div.divForForm').html(data.div);
                                        setTimeout("$('#modificar').dialog('close') ",1000);
										$.fn.yiiGridView.update('viajes');
                                }
                        } ,
                'cache':false});
    return false; 
}
</script>