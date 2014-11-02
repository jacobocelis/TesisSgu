<?php
/* @var $this CantidadController */
/* @var $model Cantidad */
/* @var $form CActiveForm */
$repuesto=new Repuesto();
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	//'id'=>'cantidad-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
		<?php echo $form->labelEx($repuesto,'repuesto'); ?>
		<?php echo $form->textField($repuesto,'repuesto',array('size'=>60,'maxlength'=>100,'readonly'=>true,'value'=>$rep)); ?>
		<?php echo $form->error($repuesto,'repuesto'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'detallePieza'); ?>
		<?php echo $form->textField($model,'detallePieza',array('size'=>60,'maxlength'=>100,'readonly'=>true)); ?>
		<?php echo $form->error($model,'detallePieza'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'codigoPiezaEnUso'); ?>
		<?php echo $form->textField($model,'codigoPiezaEnUso',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'codigoPiezaEnUso'); ?>
	</div>



	<div class="row">
		<?php echo $form->labelEx($model,'fechaIncorporacion'); ?>
		<?php echo $form->textField($model,'fechaIncorporacion'); ?>
		<?php echo $form->error($model,'fechaIncorporacion'); ?>
	</div>

	<div class="row">
	
		<?php echo $form->hiddenField($model,'idCaracteristicaVeh'); ?>
		<?php echo $form->error($model,'idCaracteristicaVeh'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Agregar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
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
	        showMonthAfterYear: false,
	        yearSuffix: '',
	        
	    };
	    $.datepicker.setDefaults($.datepicker.regional['es']);
	});      		

	$("#Cantidad_fechaIncorporacion").datepicker({
		onSelect: function(selected) {
			$("#findate").datepicker("option","minDate", selected+" +1d");
		}
	});
	$("#findate").datepicker();
</script>