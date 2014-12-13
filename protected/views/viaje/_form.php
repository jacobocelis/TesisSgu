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

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'distanciaKm'); ?>
		<?php echo $form->textField($model,'distanciaKm'); ?>
		<?php echo $form->error($model,'distanciaKm'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idOrigen'); ?>
		<?php echo $form->textField($model,'idOrigen'); ?>
		<?php echo $form->error($model,'idOrigen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idDestino'); ?>
		<?php echo $form->textField($model,'idDestino'); ?>
		<?php echo $form->error($model,'idDestino'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idtipo'); ?>
		<?php echo $form->textField($model,'idtipo'); ?>
		<?php echo $form->error($model,'idtipo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'viaje'); ?>
		<?php echo $form->textField($model,'viaje',array('size'=>60,'maxlength'=>80)); ?>
		<?php echo $form->error($model,'viaje'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->