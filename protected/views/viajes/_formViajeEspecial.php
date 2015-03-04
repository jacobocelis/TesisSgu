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
<h1>Registro de viajes especiales</h1>
	<p class="note">Campos con  <span class="required">*</span> son obligatorios.</p>
	<div class="row">
		<?php echo $form->labelEx($model,'fecha'); ?>
		<?php echo $form->textField($model,'fecha',array('id'=>'fecha','size'=>10,'readonly'=>'readonly','value'=>date('d/m/Y'),'maxlength'=>8, 'style'=>'width:100px;cursor:pointer;')); ?>
	<?php echo $form->error($model,'fecha'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'idvehiculo'); ?>
		<?php echo $form->dropDownList($model,'idvehiculo',CHtml::listData(Vehiculo::model()->findAll(),'id','numeroUnidad'),array('prompt'=>'Seleccione: ','style' => 'width:110px;','onchange'=>'obtenerConductor(this.value);')); ?>
		<?php echo $form->error($model,'idvehiculo'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'idconductor'); ?>
		<?php echo $form->dropDownList($model,'idconductor',array(),array('style' => 'width:170px;')); ?>
		<?php echo $form->error($model,'idconductor'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'idviaje'); ?>
		<?php echo $form->dropDownList($model,'idviaje',CHtml::listData(Viaje::model()->findAll('idtipo=2  or idtipo=3'),'id','viaje')); echo CHtml::link('(+)', "",array('title'=>'Registrar ruta',
        'style'=>'cursor: pointer;font-size:15px',
        'onclick'=>"{
		AgregarRutaNueva(1);}"));?>
		<?php echo $form->error($model,'idviaje');?>
	</div>
	
	<div id="registrar"></div>
	
	<div id="salida" class="row">
		<?php echo $form->labelEx($model,'horaSalida'); ?>
		<?php echo $form->textField($model,'horaSalida',array('readonly'=>'readonly',"onblur"=>"validarHora()",'style' => 'width:80px;cursor:pointer;')); ?>
		<?php echo $form->error($model,'horaSalida'); ?>
	</div>

	<div id="llegada" class="row">
		<?php echo $form->labelEx($model,'horaLlegada'); ?>
		<?php echo $form->textField($model,'horaLlegada',array('readonly'=>'readonly','style' => 'width:80px;cursor:pointer;')); ?>
		<?php echo $form->error($model,'horaLlegada'); ?>
	</div>

	<div id="pasajeros" class="row">
		<?php echo $form->labelEx($model,'nroPersonas'); ?>
		<?php echo $form->textField($model,'nroPersonas',array('size'=>3,'maxlength'=>3,'style' => 'width:40px;')); ?>
		<?php echo $form->error($model,'nroPersonas'); ?>
	</div>
	
	<div id="boton" class="row buttons">
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
    width: 600px;
}
</style>
<script>
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
                closeText: 'Cerrar',
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
	$("#fecha").datepicker({
		onSelect: function(selected){

		}
});
</script>
<script>
$('#registrar').hide();
AgregarRutaNueva(0);
function AgregarRutaNueva(tip){
if(tip){
$('#registrar').show();
	$('#salida').hide();
	$('#llegada').hide();
	$('#pasajeros').hide();
	$('#boton').hide();
}
	var dir="<?php echo Yii::app()->baseUrl;?>"+"/viajes/agregarRutaNueva/1";
	jQuery.ajax({
                url: dir,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
								
                                if (data.status == 'failure'){
										//if($('#registrar').html()!="")
											//$('#registrar').html("");
										//else
											$('#registrar').html(data.div);
                                        $('#registrar  form').submit(AgregarRutaNueva);
                                }
                                else{
                                        $('#registrar form').html(data.div);
										
                                        setTimeout("$('#registrar').hide(); ",0);
										$('#salida').show();
										$('#llegada').show();
										$('#pasajeros').show();
										$('#boton').show();
										//window.setTimeout('location.reload()');
										actualizarListaViajes();
                          
                                }
                        },
                'cache':false});
				//$('#registrar').show();
    return false; 
}
function actualizarListaViajes(){
var dir="<?php echo Yii::app()->baseUrl;?>"+"/viajes/validarRuta/0";
	$.ajax({  		
          url: dir,
        })
  	.done(function(result) {    	
    	     $('#Historicoviajes_idviaje').html(result);
  	});

}
</script>
