<?php
/* @var $this DetalleeventocaController */
/* @var $model Detalleeventoca */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'detalleeventoca-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

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
		<?php echo $form->labelEx($model,'comentario'); ?>
		<?php echo $form->textField($model,'comentario',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'comentario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idhistoricoCaucho'); ?>
		<?php echo $form->textField($model,'idhistoricoCaucho'); ?>
		<?php echo $form->error($model,'idhistoricoCaucho'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idfallaCaucho'); ?>
		<?php echo $form->textField($model,'idfallaCaucho'); ?>
		<?php echo $form->error($model,'idfallaCaucho'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idaccionCauho'); ?>
		<?php echo $form->textField($model,'idaccionCauho'); ?>
		<?php echo $form->error($model,'idaccionCauho'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idestatus'); ?>
		<?php echo $form->textField($model,'idestatus'); ?>
		<?php echo $form->error($model,'idestatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idempleado'); ?>
		<?php echo $form->textField($model,'idempleado'); ?>
		<?php echo $form->error($model,'idempleado'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->