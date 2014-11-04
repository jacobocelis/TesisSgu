<?php
/* @var $this ActividadesgrupoController */
/* @var $model Actividadesgrupo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'actividadesgrupo-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'actividad'); ?>
		<?php echo $form->textField($model,'actividad',array('size'=>60,'maxlength'=>80)); ?>
		<?php echo $form->error($model,'actividad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'frecuenciaKm'); ?>
		<?php echo $form->textField($model,'frecuenciaKm'); ?>
		<?php echo $form->error($model,'frecuenciaKm'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'frecuenciaMes'); ?>
		<?php echo $form->textField($model,'frecuenciaMes'); ?>
		<?php echo $form->error($model,'frecuenciaMes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'duracion'); ?>
		<?php echo $form->textField($model,'duracion'); ?>
		<?php echo $form->error($model,'duracion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'diasParo'); ?>
		<?php echo $form->textField($model,'diasParo'); ?>
		<?php echo $form->error($model,'diasParo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idplan'); ?>
		<?php echo $form->textField($model,'idplan'); ?>
		<?php echo $form->error($model,'idplan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idprioridad'); ?>
		<?php echo $form->textField($model,'idprioridad'); ?>
		<?php echo $form->error($model,'idprioridad'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->