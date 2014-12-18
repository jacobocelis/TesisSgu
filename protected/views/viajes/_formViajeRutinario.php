<?php
/* @var $this ViajesController */
/* @var $model Historicoviajes */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'historicoviajes-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
 
	<p class="note">Campos con  <span class="required">*</span> son obligatorios.</p>
	
		<?php echo $form->hiddenField($model,'fecha',array('value'=>$fecha)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'idvehiculo'); ?>
		<?php echo $form->dropDownList($model,'idvehiculo',CHtml::listData(Vehiculo::model()->findAll(),'id','numeroUnidad'),array('prompt'=>'Seleccione: ','onchange'=>'obtenerPuestos(this.value);','style' => 'width:110px;')); ?>
		<?php echo $form->error($model,'idvehiculo'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'idviaje'); ?>
		<?php echo $form->dropDownList($model,'idviaje',CHtml::listData(Viaje::model()->findAll('idtipo=1'),'id','viaje'),array('style'=>'margin-bottom: 2px;')); ?>
		<?php echo $form->error($model,'idviaje');?>
	</div>
	<div id="registrarRuta">
	<?php echo CHtml::link('Registrar ruta', "",array('title'=>'Registrar ruta',
        'style'=>'cursor: pointer;font-size:13px;margin-left:240px;',
        'onclick'=>"{
		AgregarRutaNueva(1);}"));?>
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

	<div class="row">
		
		<?php echo $form->hiddenField($model,'nroPersonas'); ?>
	
	</div>	

		<?php 
		$models = Empleado::model()->findAll();
		$data = array();
		foreach ($models as $mode)
			$data[$mode->id] = $mode->nombre . ' '. $mode->apellido;  
	?>
	<div class="row">
		<?php echo $form->labelEx($model,'idconductor'); ?>
		<?php echo $form->dropDownList($model,'idconductor',$data,array('style' => 'width:170px;')); ?>
		<?php echo $form->error($model,'idconductor'); ?>
	</div>
	<div id="boton" class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Registrar' : 'Actualizar'); 
		?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
function obtenerPuestos(id){
var dir="<?php echo Yii::app()->baseUrl;?>"+"/viajes/puestos/"+id;
	$.ajax({  		
          url: dir,
        })
  	.done(function( result ) {    
    	     $('#Historicoviajes_nroPersonas').val(result);
  	});
}
</script>
<script>

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
$('#registrar').hide();
AgregarRutaNueva(0);
function AgregarRutaNueva(tip){
if(tip){
$('#registrar').show();
	$('#salida').hide();
	$('#llegada').hide();
	$('#pasajeros').hide();
	$('#boton').hide();
	$('#registrarRuta').hide();
}
	var dir="<?php echo Yii::app()->baseUrl;?>"+"/viajes/agregarRutaNueva/0";
	jQuery.ajax({
                url: dir,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
								
                                if (data.status == 'failure'){
										
											$('#registrar').html(data.div);
                                        $('#registrar  form').submit(AgregarRutaNueva);
                                }
                                else{
                                        $('#registrar form').html(data.div);
										
                                        setTimeout("$('#registrar').hide(); ",0);
										$('#salida').show();
										$('#llegada').show();
										$('#boton').show();
										$('#registrarRuta').show();
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

