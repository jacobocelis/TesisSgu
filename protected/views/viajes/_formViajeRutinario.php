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
		<?php echo $form->dropDownList($model,'idvehiculo',CHtml::listData(Vehiculo::model()->findAll(),'id','numeroUnidad'),array('style' => 'width:70px;')); ?>
		<?php echo $form->error($model,'idvehiculo'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'idviaje'); ?>
		<?php echo $form->dropDownList($model,'idviaje',CHtml::listData(Viaje::model()->findAll('idtipo=1'),'id','viaje')); ?>
		<?php echo $form->error($model,'idviaje');?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'horaSalida'); ?>
		<?php echo $form->textField($model,'horaSalida',array('readonly'=>'readonly',"onblur"=>"validarHora()",'style' => 'width:80px;cursor:pointer;')); ?>
		<?php echo $form->error($model,'horaSalida'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'horaLlegada'); ?>
		<?php echo $form->textField($model,'horaLlegada',array('readonly'=>'readonly','style' => 'width:80px;cursor:pointer;')); ?>
		<?php echo $form->error($model,'horaLlegada'); ?>
	</div>

	<div class="row">
		
		<?php echo $form->hiddenField($model,'nroPersonas',array('value'=>0)); ?>
	
	</div>	


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Registrar' : 'Actualizar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
$('#Historicoviajes_horaLlegada').attr('disabled', true);
function validarHora(){
	if($('#Historicoviajes_horaSalida').val()=="")
		$('#Historicoviajes_horaLlegada').attr('disabled', true);
	else	
		$('#Historicoviajes_horaLlegada').attr('disabled', false);
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
$("#Historicoviajes_horaLlegada").timepicker();
</script>

