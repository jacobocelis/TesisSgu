<?php
/* @var $this NeumaticosController */
/* @var $model Historicocaucho */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'historicocaucho-form',
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
		<?php echo $form->labelEx($model,'serial'); ?>
		<?php echo $form->textField($model,'serial',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'serial'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idestatusCaucho'); ?>
		<?php echo $form->textField($model,'idestatusCaucho'); ?>
		<?php echo $form->error($model,'idestatusCaucho'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idcaucho'); ?>
		<?php echo $form->textField($model,'idcaucho'); ?>
		<?php echo $form->error($model,'idcaucho'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idmarcaCaucho'); ?>
		<?php echo $form->textField($model,'idmarcaCaucho'); ?>
		<?php echo $form->error($model,'idmarcaCaucho'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idvehiculo'); ?>
		<?php echo $form->textField($model,'idvehiculo'); ?>
		<?php echo $form->error($model,'idvehiculo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'iddetalleRueda'); ?>
		<?php echo $form->textField($model,'iddetalleRueda'); ?>
		<?php echo $form->error($model,'iddetalleRueda'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idasigChasis'); ?>
		<?php echo $form->textField($model,'idasigChasis'); ?>
		<?php echo $form->error($model,'idasigChasis'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->