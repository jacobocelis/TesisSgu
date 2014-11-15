<?php
/* @var $this ActividadesgrupoController */
/* @var $model Actividadesgrupo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'actividadesgrupo-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>

	<?php //echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'actividad'); ?>
		<?php echo $form->textField($model,'actividad',array('size'=>60,'maxlength'=>80)); ?>
		<?php echo $form->error($model,'actividad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'frecuenciaKm'); ?>
		<?php echo $form->textField($model,'frecuenciaKm',array('style' => 'width:60px;'));?> Km
		<?php echo $form->error($model,'frecuenciaKm'); ?>
	
	
		<?php echo $form->labelEx($model,'frecuenciaMes'); ?>
		<?php echo $form->textField($model,'frecuenciaMes',array('style' => 'width:50px;')); ?>
		<?php echo $form->dropDownList($model,'idtiempof',CHtml::listData(Tiempo::model()->findAll(array("condition"=>"id <> 5 and id <> 2")),'id','tiempo'),array('id'=>'tiempo','style' => 'width:90px;')); ?>
		<?php echo $form->error($model,'frecuenciaMes'); ?>
	</div>
	
	
	

	<div class="row">
		<?php //echo $form->labelEx($model,'frecuencia'); ?>
		<?php echo $form->hiddenField($model,'frecuencia',array('size'=>45,'maxlength'=>45)); ?>
		<?php //echo $form->error($model,'frecuencia'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'duracion'); ?>
		<?php echo $form->textField($model,'duracion',array('style' => 'width:60px;')); ?>
		<?php echo $form->dropDownList($model,'idtiempod',CHtml::listData(Tiempo::model()->findAll(array("condition"=>"id = 2 or id = 5 or id = 1 order by id DESC")),'id','tiempo'),array('style' => 'width:90px;')); ?>
		<?php echo $form->error($model,'duracion'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'diasParo'); ?>
		<?php //echo $form->textField($model,'diasParo'); ?>
		<?php //echo $form->error($model,'diasParo'); ?>
	</div>

	<div class="row">
		
		<?php echo $form->hiddenField($model,'idplan'); ?>
	
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idprioridad'); ?>
		<?php echo $form->dropDownList($model,'idprioridad',CHtml::listData(Prioridad::model()->findAll(),'id','prioridad'),array('id'=>'prioridad','style' => 'width:100px;')); ?>
		<?php echo $form->error($model,'idprioridad'); ?>
	</div>

	<div class="row buttons">
		<?php 
		echo CHtml::submitButton($model->isNewRecord ? 'Registrar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
$("#actividadesgrupo-form").submit(function(event){
event.preventDefault();
agregar();
});
function agregar(){
	$('#Actividadesgrupo_frecuencia').val("Cada "+$('#Actividadesgrupo_frecuenciaKm').val()+" Km");

return true
}
</script>
