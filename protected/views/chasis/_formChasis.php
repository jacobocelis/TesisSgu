<?php
/* @var $this ChasisController */
/* @var $model Chasis */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'chasis-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> obligatorios.</p>
	
	<div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nroEjes'); ?>
		<?php echo $form->textField($model,'nroEjes',array('size'=>2,'maxlength'=>2,'style'=>'width:40px;')); ?>
		<?php echo $form->error($model,'nroEjes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cantidadNormales'); ?>
		<?php echo $form->textField($model,'cantidadNormales',array('size'=>3,'maxlength'=>3,'style'=>'width:40px;')); ?>
		<?php echo $form->error($model,'cantidadNormales'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cantidadRepuesto'); ?>
		<?php echo $form->textField($model,'cantidadRepuesto',array('size'=>2,'maxlength'=>2,'style'=>'width:40px;')); ?>
		<?php echo $form->error($model,'cantidadRepuesto'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Registrar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->