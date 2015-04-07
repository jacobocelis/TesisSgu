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

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'fechaSalida'); ?>
		<?php echo $form->textField($model,'fechaSalida'); ?>
		<?php echo $form->error($model,'fechaSalida'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'horaSalida'); ?>
		<?php echo $form->textField($model,'horaSalida'); ?>
		<?php echo $form->error($model,'horaSalida'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fechaLlegada'); ?>
		<?php echo $form->textField($model,'fechaLlegada'); ?>
		<?php echo $form->error($model,'fechaLlegada'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'horaLlegada'); ?>
		<?php echo $form->textField($model,'horaLlegada'); ?>
		<?php echo $form->error($model,'horaLlegada'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nroPersonas'); ?>
		<?php echo $form->textField($model,'nroPersonas'); ?>
		<?php echo $form->error($model,'nroPersonas'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ultimaRutina'); ?>
		<?php echo $form->textField($model,'ultimaRutina'); ?>
		<?php echo $form->error($model,'ultimaRutina'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idviaje'); ?>
		<?php echo $form->textField($model,'idviaje'); ?>
		<?php echo $form->error($model,'idviaje'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idvehiculo'); ?>
		<?php echo $form->textField($model,'idvehiculo'); ?>
		<?php echo $form->error($model,'idvehiculo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idconductor'); ?>
		<?php echo $form->textField($model,'idconductor'); ?>
		<?php echo $form->error($model,'idconductor'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->