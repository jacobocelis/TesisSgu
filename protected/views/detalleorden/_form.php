<?php
/* @var $this DetalleordenController */
/* @var $model Detalleorden */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'detalleorden-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'idordenMtto'); ?>
		<?php echo $form->textField($model,'idordenMtto'); ?>
		<?php echo $form->error($model,'idordenMtto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idactividades'); ?>
		<?php echo $form->textField($model,'idactividades'); ?>
		<?php echo $form->error($model,'idactividades'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->