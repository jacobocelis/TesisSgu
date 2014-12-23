<?php
/* @var $this ReportefallaController */
/* @var $model Reportefalla */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reportefalla-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'detalle'); ?>
		<?php echo $form->textField($model,'detalle',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'detalle'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fechaFalla'); ?>
		<?php echo $form->textField($model,'fechaFalla'); ?>
		<?php echo $form->error($model,'fechaFalla'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fechaRealizada'); ?>
		<?php echo $form->textField($model,'fechaRealizada'); ?>
		<?php echo $form->error($model,'fechaRealizada'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kmRealizada'); ?>
		<?php echo $form->textField($model,'kmRealizada'); ?>
		<?php echo $form->error($model,'kmRealizada'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'diasParo'); ?>
		<?php echo $form->textField($model,'diasParo'); ?>
		<?php echo $form->error($model,'diasParo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idtiempo'); ?>
		<?php echo $form->textField($model,'idtiempo'); ?>
		<?php echo $form->error($model,'idtiempo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idvehiculo'); ?>
		<?php echo $form->textField($model,'idvehiculo'); ?>
		<?php echo $form->error($model,'idvehiculo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idempleado'); ?>
		<?php echo $form->textField($model,'idempleado'); ?>
		<?php echo $form->error($model,'idempleado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idfalla'); ?>
		<?php echo $form->textField($model,'idfalla'); ?>
		<?php echo $form->error($model,'idfalla'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idestatus'); ?>
		<?php echo $form->textField($model,'idestatus'); ?>
		<?php echo $form->error($model,'idestatus'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->