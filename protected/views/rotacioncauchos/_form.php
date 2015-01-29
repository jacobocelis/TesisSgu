<?php
/* @var $this RotacioncauchosController */
/* @var $model Rotacioncauchos */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'rotacioncauchos-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'descripcion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'costoTotal'); ?>
		<?php echo $form->textField($model,'costoTotal'); ?>
		<?php echo $form->error($model,'costoTotal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fechaRealizada'); ?>
		<?php echo $form->textField($model,'fechaRealizada'); ?>
		<?php echo $form->error($model,'fechaRealizada'); ?>
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