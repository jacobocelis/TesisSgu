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
<?php echo $form->hiddenField($model,'fechaFalla'); ?>
<?php 
		$km=Kilometraje::model()->findAll(array(
			'condition'=>'t.idvehiculo ='.$model->idvehiculo.' order by t.id desc limit 1',
		));
		$modelo=new Kilometraje();
	?>
	
	
	<div class="row">
		
		<?php echo $form->hiddenField($model,'kmRealizada',array('value'=>$id?$km[0]["lectura"]:$model->kmRealizada,'style' => 'width:100px;text-align:right;')); ?>
		<?php echo $form->error($model,'kmRealizada'); ?>
	</div>
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'fechaRealizada'); ?>
		<?php echo $form->textField($model,'fechaRealizada',array('value'=>$id?date('d/m/Y'):$model->fechaRealizada,'readonly'=>'readonly','style' => 'width:100px;cursor:pointer;')); ?>
		<?php echo $form->error($model,'fechaRealizada'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'diasParo'); ?>
		<?php echo $form->textField($model,'diasParo',array('style' => 'width:30px;'));  echo $form->dropDownList($model,'idtiempo',CHtml::listData(Tiempo::model()->findAll(array("condition"=>"id <> 5 order by id=1 DESC")),'id','tiempo'),array('id'=>'tiempo','style' => 'width:90px;')); ?>
		<?php echo $form->error($model,'diasParo'); ?>
	</div>
	
	
	<?php echo $form->hiddenField($model,'idvehiculo'); ?>
	<?php echo $form->hiddenField($model,'idempleado'); ?>
	<?php echo $form->hiddenField($model,'idfalla'); ?>
	<?php echo $form->hiddenField($model,'idestatus'); ?>
	
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
	$("#Reportefalla_fechaRealizada").datepicker();
</script>
<script type="text/javascript">
$("#Kilometraje_lectura").click(function(){
	$("#Reportefalla_kmRealizada").val($("#Kilometraje_lectura").val());
});
</script>