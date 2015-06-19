<?php
/* @var $this FeriadoController */
/* @var $model Feriado */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'feriado-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Registrar día feriado</p>

	<div class="row">
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'descripcion'); ?>

		<?php echo $form->labelEx($model,'fechaInicio'); ?>
		<?php echo $form->textField($model,'fechaInicio',array('size'=>10,'readonly'=>'readonly','maxlength'=>8, 'style'=>'width:80px;cursor:pointer;')); ?>
		<?php echo $form->error($model,'fechaInicio'); ?>

		<?php echo $form->labelEx($model,'fechaFin'); ?>
		<?php echo $form->textField($model,'fechaFin',array('size'=>10,'readonly'=>'readonly','maxlength'=>8, 'style'=>'width:80px;cursor:pointer;')); ?>
		<?php echo $form->error($model,'fechaFin'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Registrar' : 'Actualizar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
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
	        //maxDate: '0d',
	        //minDate: '0d',
	    };
	    $.datepicker.setDefaults($.datepicker.regional['es']);
	});      		

	$("#Feriado_fechaInicio").datepicker({
		onSelect: function(data){
			$("#Feriado_fechaFin").datepicker();
			$("#Feriado_fechaFin").datepicker("option","minDate", data);
		}
});
</script>