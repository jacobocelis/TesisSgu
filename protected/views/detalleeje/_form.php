<?php
/* @var $this DetalleejeController */
/* @var $model Detalleeje */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'detalleeje-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nroRuedas'); ?>
		<?php echo $form->textField($model,'nroRuedas'); ?>
		<?php echo $form->error($model,'nroRuedas'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idchasis'); ?>
		<?php echo $form->textField($model,'idchasis'); ?>
		<?php echo $form->error($model,'idchasis'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idposicionEje'); ?>
		<?php echo $form->textField($model,'idposicionEje'); ?>
		<?php echo $form->error($model,'idposicionEje'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre'); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->