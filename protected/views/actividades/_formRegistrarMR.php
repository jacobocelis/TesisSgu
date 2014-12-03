<?php
/* @var $this ActividadesController */
/* @var $model Actividades */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'actividades-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> obligatorios.</p>


		<?php echo $form->hiddenField($model,'ultimoKm'); ?> 



		<?php echo $form->hiddenField($model,'ultimoFecha'); ?>
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'kmRealizada'); ?>
		<?php echo $form->textField($model,'kmRealizada',array('value'=>$id?'':$model->kmRealizada,'style' => 'width:100px;')); ?> Km
		<?php echo $form->error($model,'kmRealizada'); ?>
	</div>
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'fechaRealizada'); ?>
		<?php echo $form->textField($model,'fechaRealizada',array('value'=>$id?'':$model->fechaRealizada,'readonly'=>'readonly','style' => 'width:100px;')); ?>
		<?php echo $form->error($model,'fechaRealizada'); ?>
	</div>

	
	
	<div class="row">
		<?php echo $form->hiddenField($model,'frecuenciaKm'); ?>
	</div>
	<div class="row">
		<?php echo $form->hiddenField($model,'frecuenciaMes'); ?>
	</div>
	<div class="row">
		
		<?php echo $form->hiddenField($model,'proximoKm'); ?>
		
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model,'proximoFecha'); ?>
	</div>

	<div class="row">
		
		<?php echo $form->hiddenField($model,'duracion'); ?>
	</div>
	<div class="row">
		
		<?php echo $form->hiddenField($model,'atraso'); ?>
		
	</div>
	<div class="row">
		<?php echo $form->hiddenField($model,'idprioridad'); ?>
	</div>
	<div class="row">
		
		<?php echo $form->hiddenField($model,'idplan'); ?>
		
	</div>

	<div class="row">
		
		<?php echo $form->hiddenField($model,'idtiempod'); ?>
		
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model,'idtiempof'); ?>
	</div>
	<div class="row">
		
		<?php echo $form->hiddenField($model,'idactividadesGrupo'); ?>
		<?php echo $form->hiddenField($model,'idestatus'); ?>
		<?php echo $form->hiddenField($model,'idactividadMtto'); ?>
		<?php echo $form->hiddenField($model,'procedimiento'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Registrar' : 'Actualizar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
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
	        dateFormat: 'yy-mm-dd',
	        firstDay: 1,
	        isRTL: false,
			changeMonth: true,
            changeYear: true,
	        showMonthAfterYear: false,
	        yearSuffix: '',
	        maxDate: '0d',
	        minDate: '-30d',
	    };
	    $.datepicker.setDefaults($.datepicker.regional['es']);
	});      		
	$("#Actividades_fechaRealizada").datepicker();
</script>