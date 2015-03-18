<?php
/* @var $this BitacoraController */
/* @var $model Bitacora */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'bitacora-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha'); ?>
		<?php echo $form->textField($model,'fecha'); ?>
		<?php echo $form->error($model,'fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'evento'); ?>
		<?php echo $form->textField($model,'evento',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'evento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tabla'); ?>
		<?php echo $form->textField($model,'tabla',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'tabla'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idusuario'); ?>
		<?php echo $form->textField($model,'idusuario'); ?>
		<?php echo $form->error($model,'idusuario'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->