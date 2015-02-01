<?php
/* @var $this DetreccauchoController */
/* @var $model Detreccaucho */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'detreccaucho-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'cantidad'); ?>
		<?php echo $form->textField($model,'cantidad'); ?>
		<?php echo $form->error($model,'cantidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'costoUnitario'); ?>
		<?php echo $form->textField($model,'costoUnitario'); ?>
		<?php echo $form->error($model,'costoUnitario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'costoTotal'); ?>
		<?php echo $form->textField($model,'costoTotal'); ?>
		<?php echo $form->error($model,'costoTotal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idrecursoCaucho'); ?>
		<?php echo $form->textField($model,'idrecursoCaucho'); ?>
		<?php echo $form->error($model,'idrecursoCaucho'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'iddetalleEventoCa'); ?>
		<?php echo $form->textField($model,'iddetalleEventoCa'); ?>
		<?php echo $form->error($model,'iddetalleEventoCa'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idunidad'); ?>
		<?php echo $form->textField($model,'idunidad'); ?>
		<?php echo $form->error($model,'idunidad'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->