<?php
/* @var $this InfgrupoController */
/* @var $model Infgrupo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'infgrupo-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Los campos con <span class="required">*</span>son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'informacion'); ?>
		<?php echo $form->textField($model,'informacion',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'informacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idgrupo'); ?>
		<?php echo $form->textField($model,'idgrupo'); ?>
		<?php echo $form->error($model,'idgrupo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'agregar' : 'guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->