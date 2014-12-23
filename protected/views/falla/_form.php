<?php
/* @var $this FallaController */
/* @var $model Falla */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'falla-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'falla'); ?>
		<?php echo $form->textField($model,'falla',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'falla'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idtipoFalla'); ?>
		<?php echo $form->textField($model,'idtipoFalla'); ?>
		<?php echo $form->error($model,'idtipoFalla'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->