<?php
/* @var $this ViajesController */
/* @var $model Historicoviajes */
/* @var $form CActiveForm */
?>

<div id="azul"class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'historicoviajes-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
 
<h1>Registro de viajes rutinarios</h1>

	<p class="note">Campos con  <span class="required">*</span> son obligatorios.</p>
	
	<div class="row">
		<?php echo $form->labelEx($model,'Fecha * ',array("style"=>"width:110px")); ?>
		<?php echo $form->textField($model,'fechaSalida',array('readonly'=>'readonly','style' =>'width:80px;cursor:pointer','value'=>date('d/m/Y'))); ?>
		<?php echo $form->error($model,'fechaSalida'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'horaSalida',array("style"=>"width:110px")); ?>
		<?php echo $form->textField($model,'horaSalida',array('readonly'=>'readonly','style' =>'width:60px;cursor:pointer')); ?>
		<?php echo $form->error($model,'horaSalida'); ?>
	</div>

	<div class="row">
	
		<?php echo $form->hiddenField($model,'fechaLlegada',array('readonly'=>'readonly','style' =>'width:80px;cursor:pointer')); ?>
	
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'idvehiculo',array("style"=>"width:110px")); ?>
		<?php echo $form->dropDownList($model,'idvehiculo',CHtml::listData(Vehiculo::model()->findAll(),'id','numeroUnidad'),array('prompt'=>'Seleccione: ','onchange'=>'obtenerPuestos(this.value);','style' => 'width:110px;')); ?>
		<?php echo $form->error($model,'idvehiculo'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'idconductor',array("style"=>"width:110px")); ?>
		<?php echo $form->dropDownList($model,'idconductor',array(),array('style' => 'width:170px;')); ?>
		<?php echo $form->error($model,'idconductor'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'idviaje',array("style"=>"width:110px")); ?>
		<?php echo $form->dropDownList($model,'idviaje',CHtml::listData(Viaje::model()->findAll('idtipo=1'),'id','viaje'),array('style'=>'')); 	echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Nueva ruta")), "",array('title'=>'Registrar ruta',
        'style'=>'cursor: pointer;',
        'onclick'=>"{
		AgregarRutaNueva(1);}"));?>
		<?php echo $form->error($model,'idviaje');?>
	</div>
	
 	<div class="row">
		<?php echo $form->labelEx($model,'horaLlegada',array("style"=>"width:110px")); ?>
		<?php echo $form->textField($model,'horaLlegada',array('readonly'=>'readonly','style' =>'width:60px;cursor:pointer')); ?>
		<?php echo $form->error($model,'horaLlegada'); ?>
	</div>

	<div class="row">
		
		<?php echo $form->hiddenField($model,'nroPersonas'); ?>
	
	</div>	


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Registrar' : 'Actualizar'); 
		?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<style>
#azul {
    background: none repeat scroll 0% 0% #F9FDFD;
    padding: 5px;
    border: 1px solid #94A8FF;
    margin-top: 5px;
    
}
</style>
<script>
$( "#historicoviajes-form" ).submit(function( event ) {
$( "#Historicoviajes_fechaLlegada").val($( "#Historicoviajes_fechaSalida").val())
event.preventDefault();
});

function obtenerPuestos(id){
	obtenerConductor(id);
var dir="<?php echo Yii::app()->baseUrl;?>"+"/viajes/puestos/"+id;
	$.ajax({  		
          url: dir,
		  'dataType':'json',
		  'success':function(data){
			//$('#Historicoviajes_nroPersonas').val(result.puestos);
			//$('#Historicoviajes_idconductor').html(result.lista);		  
		  }
        })
  	.done(function( result ) {
	
    	     $('#Historicoviajes_nroPersonas').val(result.puestos);
			 //$('#Historicoviajes_idconductor').html(result.lista);
  	});
}
function obtenerConductor(id){
	if(id=="")
		id=0;
	var dir="<?php echo Yii::app()->baseUrl;?>"+"/mttoCorrectivo/AjaxObtenerConductor/";
	$.ajax({  		
          url: dir+id,
        })
  	.done(function(result) {    	
    	     $('#Historicoviajes_idconductor').html(result);
  	});	
}
</script>
<script>
$(function($){
	    $.datepicker.regional['es'] = {
	        closeText: 'Aceptar',
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
	$("#Historicoviajes_fechaSalida").datepicker({
		onSelect: function(selected){
			var fecha=$('#Historicoviajes_fechaSalida').val();
			$('#Historicoviajes_fecha').val($('#Historicoviajes_fechaSalida').val());
			$.fn.yiiGridView.update('viajes',{data:"fecha="+fecha});
			var hoy="<?php echo date('d/m/Y');?>";
				if($('#Historicoviajes_fechaSalida').val()==hoy)
			$('#etiqueta').show();
			else
				$('#etiqueta').hide();
		}
});

function validarHora(){
	if($('#Historicoviajes_horaSalida').val()!="")
	$("#Historicoviajes_horaLlegada").timepicker();

}
(function($) {
        $.timepicker.regional['es'] = {
                timeOnlyTitle: 'Elegir una hora',
                timeText: 'Hora',
                hourText: 'Horas',
                minuteText: 'Minutos',
                secondText: 'Segundos',
                millisecText: 'Milisegundos',
                timezoneText: 'Huso horario',
                currentText: 'Ahora',
                closeText: 'Aceptar',
                timeFormat: 'hh:mm tt',
                amNames: ['am', 'AM', 'A'],
                pmNames: ['pm', 'PM', 'P'],
        };
        $.timepicker.setDefaults($.timepicker.regional['es']);
})(jQuery);
$("#Historicoviajes_horaSalida").timepicker({
		onSelect: function(data){
			validarHora();
			$("#Historicoviajes_horaLlegada").timepicker("option","minTime", data);
		}
});
</script>
<script>
$( "#target" ).submit(function( event ) {
alert( "Handler for .submit() called." );
event.preventDefault();
});

$('#registrar').hide();
//AgregarRutaNueva(0);
function AgregarRutaNueva(tip){
$('#nuevoDestino').dialog('open');
if(tip){
	//$('#registrar').show();
	//$('#salida').hide();
	//$('#llegada').hide();
	//$('#pasajeros').hide();
	//$('#boton').hide();
	//$('#registrarRuta').hide();
}
	var dir="<?php echo Yii::app()->baseUrl;?>"+"/viajes/agregarRutaNueva/0";
	jQuery.ajax({
                url: dir,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
								
                                if (data.status == 'failure'){
										
										$('#nuevoDestino div.divForForm').html(data.div);
                                        $('#nuevoDestino div.divForForm  form').submit(AgregarRutaNueva);
                                }
                                else{
                                        $('#nuevoDestino div.divForForm form').html(data.div);
										$('#nuevoDestino').dialog('close');
                                        //setTimeout("$('#registrar').hide(); ",0);
										//$('#salida').show();
										//$('#llegada').show();
										//$('#boton').show();
										//$('#registrarRuta').show();
										//window.setTimeout('location.reload()');
										actualizarListaViajes();
                                }
                        },
                'cache':false});
				//$('#registrar').show();
    return false; 
}
function actualizarListaViajes(){
var dir="<?php echo Yii::app()->baseUrl;?>"+"/viajes/validarRutaNormal";
	$.ajax({  		
          url: dir,
        })
  	.done(function(result) {    	
    	     $('#Historicoviajes_idviaje').html(result);
  	});
}

</script>

