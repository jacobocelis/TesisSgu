<?php
/* @var $this CauchoController */
/* @var $model Caucho */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'caucho-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'idmedidaCaucho'); ?>
		<?php echo $form->textField($model,'idmedidaCaucho'); ?>
		<?php echo $form->error($model,'idmedidaCaucho'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idrin'); ?>
		<?php echo $form->textField($model,'idrin'); ?>
		<?php echo $form->error($model,'idrin'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idpiso'); ?>
		<?php echo $form->textField($model,'idpiso'); ?>
		<?php echo $form->error($model,'idpiso'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->