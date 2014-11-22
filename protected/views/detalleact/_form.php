<?php
/* @var $this DetalleactController */
/* @var $model Detalleact */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'detalleact-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'idfactura'); ?>
		<?php echo $form->textField($model,'idfactura'); ?>
		<?php echo $form->error($model,'idfactura'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'iddetallleOrden'); ?>
		<?php echo $form->textField($model,'iddetallleOrden'); ?>
		<?php echo $form->error($model,'iddetallleOrden'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->