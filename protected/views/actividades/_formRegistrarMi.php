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
	
	<?php 
		$km=Kilometraje::model()->findAll(array(
			'condition'=>'t.idvehiculo ='.$model->idvehiculo.' order by t.id desc limit 1',
		));
		$modelo=new Kilometraje();
	?>
	<div class="row">
		
		<label>Última lectura del odómetro: </label><?php echo $form->textField($modelo,'lectura',array('value'=>number_format($km[0]["lectura"], 0,",","") ,'readonly'=>'readonly','style' => 'width:100px;cursor:pointer;text-align:right')); ?> Km 
		
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'ultimoKm'); ?>
		<?php echo $form->textField($model,'ultimoKm',array('value'=>$id?'':$model->ultimoKm,'style' => 'width:100px;text-align:right')); ?>  Km
		<?php echo $form->error($model,'ultimoKm'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ultimoFecha'); ?>
		<?php echo $form->textField($model,'ultimoFecha',array('value'=>$id?'':$model->ultimoFecha,'readonly'=>'readonly','style' => 'width:100px;cursor:pointer;')); ?>
		<?php echo $form->error($model,'ultimoFecha'); ?>
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
		
		<?php echo $form->hiddenField($model,'idvehiculo'); ?>
		
	</div>

	<div class="row">
		
		<?php echo $form->hiddenField($model,'idtiempod'); ?>
		
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model,'idtiempof'); ?>
	</div>
	<div class="row">
		
		<?php echo $form->hiddenField($model,'idactividadesGrupo'); ?>
		<?php echo $form->hiddenField($model,'idestatus',array('value'=>$idestatus?2:$idestatus)); ?>
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
	        //minDate: '0d',
	    };
	    $.datepicker.setDefaults($.datepicker.regional['es']);
	});      		

	$("#Actividades_ultimoFecha").datepicker();
</script>
<script type="text/javascript">
$("#Kilometraje_lectura").click(function(){
	$("#Actividades_ultimoKm").val($("#Kilometraje_lectura").val());
});
</script>