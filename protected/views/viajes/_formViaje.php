<?php
/* @var $this ViajeController */
/* @var $model Viaje */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'viaje-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
<div id="verde">
<strong>Complete los datos para registrar una ruta:</strong>
	<div class="row">
		<?php echo $form->labelEx($model,'distanciaKm'); ?>
		<?php echo $form->textField($model,'distanciaKm',array('style' => 'width:50px;')); ?>
		<?php echo $form->error($model,'distanciaKm'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'idOrigen'); ?>
		<?php echo $form->dropDownList($model,'idOrigen',CHtml::listData(Lugar::model()->findAll(),'id','lugar'),array('style' => 'width:150px;')); ?>
		<?php echo $form->error($model,'idOrigen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idDestino'); ?>
		<?php echo $form->dropDownList($model,'idDestino',CHtml::listData(Lugar::model()->findAll(),'id','lugar'),array('style' => 'width:150px;')); ?>
		<?php echo $form->error($model,'idDestino'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idtipo'); ?>
		<?php echo $form->dropDownList($model,'idtipo',CHtml::listData(Tipoviaje::model()->findAll('id=2 or id=3'),'id','tipo'),array('style' => 'width:50px;')); ?>
		<?php echo $form->error($model,'idtipo'); ?>
	</div>

	<div class="row">
		
		<?php echo $form->textField($model,'viaje',array('size'=>60,'maxlength'=>80)); ?>
		
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Agregar' : 'Save'); ?>
	</div>
</div>
<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
$("#viaje-form").submit(function(event){
	event.preventDefault();
	$('#Viaje_viaje').val($('#Viaje_idOrigen option:selected').text()+" - "+$('#Viaje_idDestino option:selected').text());
});
</script>
<style>

#verde{
	background: #D9EDFF;
	width:300px;
	padding: 5px;
	border-radius: 2px;
}
</style>