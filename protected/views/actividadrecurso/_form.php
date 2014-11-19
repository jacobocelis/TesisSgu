<?php
/* @var $this ActividadrecursoController */
/* @var $model Actividadrecurso */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'actividadrecurso-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cantidad'); ?>
		<?php echo $form->textField($model,'cantidad'); ?>
		<?php echo $form->error($model,'cantidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idactividades'); ?>
		<?php echo $form->textField($model,'idactividades'); ?>
		<?php echo $form->error($model,'idactividades'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idinsumo'); ?>
		<?php echo $form->textField($model,'idinsumo'); ?>
		<?php echo $form->error($model,'idinsumo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idprovServ'); ?>
		<?php echo $form->textField($model,'idprovServ'); ?>
		<?php echo $form->error($model,'idprovServ'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idrepuesto'); ?>
		<?php echo $form->textField($model,'idrepuesto'); ?>
		<?php echo $form->error($model,'idrepuesto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idunidad'); ?>
		<?php echo $form->textField($model,'idunidad'); ?>
		<?php echo $form->error($model,'idunidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'detalle'); ?>
		<?php echo $form->textField($model,'detalle',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'detalle'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->