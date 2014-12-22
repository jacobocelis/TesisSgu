<?php
/* @var $this OrdenmttoController */
/* @var $model Ordenmtto */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ordenmtto-form',
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
		<?php echo $form->labelEx($model,'tipo'); ?>
		<?php echo $form->textField($model,'tipo'); ?>
		<?php echo $form->error($model,'tipo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idestatus'); ?>
		<?php echo $form->textField($model,'idestatus'); ?>
		<?php echo $form->error($model,'idestatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'taller'); ?>
		<?php echo $form->textField($model,'taller'); ?>
		<?php echo $form->error($model,'taller'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cOperativo'); ?>
		<?php echo $form->textField($model,'cOperativo'); ?>
		<?php echo $form->error($model,'cOperativo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cTaller'); ?>
		<?php echo $form->textField($model,'cTaller'); ?>
		<?php echo $form->error($model,'cTaller'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->