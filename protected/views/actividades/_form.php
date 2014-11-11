<?php
/* @var $this ActividadesController */
/* @var $model Actividades */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'actividades-form',
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
		<?php echo $form->labelEx($model,'ultimoKm'); ?>
		<?php echo $form->textField($model,'ultimoKm'); ?>
		<?php echo $form->error($model,'ultimoKm'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ultimoFecha'); ?>
		<?php echo $form->textField($model,'ultimoFecha'); ?>
		<?php echo $form->error($model,'ultimoFecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ultimo'); ?>
		<?php echo $form->textField($model,'ultimo',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'ultimo'); ?>
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
		<?php echo $form->labelEx($model,'frecuencia'); ?>
		<?php echo $form->textField($model,'frecuencia',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'frecuencia'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'proximoKm'); ?>
		<?php echo $form->textField($model,'proximoKm'); ?>
		<?php echo $form->error($model,'proximoKm'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'proximoFecha'); ?>
		<?php echo $form->textField($model,'proximoFecha'); ?>
		<?php echo $form->error($model,'proximoFecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'proximo'); ?>
		<?php echo $form->textField($model,'proximo',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'proximo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'atraso'); ?>
		<?php echo $form->textField($model,'atraso'); ?>
		<?php echo $form->error($model,'atraso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idprioridad'); ?>
		<?php echo $form->textField($model,'idprioridad'); ?>
		<?php echo $form->error($model,'idprioridad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idplan'); ?>
		<?php echo $form->textField($model,'idplan'); ?>
		<?php echo $form->error($model,'idplan'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->