<?php
/* @var $this CantidadController */
/* @var $model Cantidad */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cantidad-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'codigoPiezaEnUso'); ?>
		<?php echo $form->textField($model,'codigoPiezaEnUso',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'codigoPiezaEnUso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'detallePieza'); ?>
		<?php echo $form->textField($model,'detallePieza',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'detallePieza'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fechaIncorporacion'); ?>
		<?php echo $form->textField($model,'fechaIncorporacion'); ?>
		<?php echo $form->error($model,'fechaIncorporacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idCaracteristicaVeh'); ?>
		<?php echo $form->textField($model,'idCaracteristicaVeh'); ?>
		<?php echo $form->error($model,'idCaracteristicaVeh'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->