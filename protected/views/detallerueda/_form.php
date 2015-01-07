<?php
/* @var $this DetalleruedaController */
/* @var $model Detallerueda */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'detallerueda-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'idposicionRueda'); ?>
		<?php echo $form->textField($model,'idposicionRueda'); ?>
		<?php echo $form->error($model,'idposicionRueda'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'iddetalleEje'); ?>
		<?php echo $form->textField($model,'iddetalleEje'); ?>
		<?php echo $form->error($model,'iddetalleEje'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idcaucho'); ?>
		<?php echo $form->textField($model,'idcaucho'); ?>
		<?php echo $form->error($model,'idcaucho'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->