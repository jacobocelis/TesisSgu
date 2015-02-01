<?php
/* @var $this RotacioncauchosController */
/* @var $model Rotacioncauchos */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'rotacioncauchos-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<div class="row">
		
		<?php echo $form->hiddenField($model,'nombre',array('size'=>45,'maxlength'=>45)); ?>
	
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model,'descripcion',array('size'=>45,'maxlength'=>45)); ?>
	
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model,'costoTotal'); ?>
	
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fechaRealizada'); ?>
		<?php echo $form->textField($model,'fechaRealizada',array('value'=>$model->fechaRealizada=='0000-01-01'?date('d/m/Y'):date('d/m/Y',strtotime($model->fechaRealizada)),'readonly'=>'readonly','style' => 'width:100px;cursor:pointer;')); ?>
		
		<?php echo $form->error($model,'fechaRealizada'); ?>
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model,'idestatus'); ?>
	
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Registrar' : 'Registrar'); ?>
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
	        dateFormat: 'dd/mm/yy',
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
	$("#Rotacioncauchos_fechaRealizada").datepicker();
</script>