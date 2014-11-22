<?php
/* @var $this DetallegastoController */
/* @var $model Detallegasto */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'detallegasto-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'material'); ?>
		<?php echo $form->textField($model,'material',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'material'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'costoUnitario'); ?>
		<?php echo $form->textField($model,'costoUnitario'); ?>
		<?php echo $form->error($model,'costoUnitario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cantidad'); ?>
		<?php echo $form->textField($model,'cantidad'); ?>
		<?php echo $form->error($model,'cantidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'total'); ?>
		<?php echo $form->textField($model,'total'); ?>
		<?php echo $form->error($model,'total'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'iddetalleAct'); ?>
		<?php echo $form->textField($model,'iddetalleAct'); ?>
		<?php echo $form->error($model,'iddetalleAct'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->