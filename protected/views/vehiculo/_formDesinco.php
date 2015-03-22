<?php
/* @var $this HistoricoedosController */
/* @var $model Historicoedos */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'historicoedos-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> obligatorios.</p>

	<div class="row">
		
		<?php echo $form->hiddenField($model,'idestado',array('value'=>4)); ?>
		
	</div>

	<div class="row">
		
		<?php echo $form->hiddenField($model,'idvehiculo',array('value'=>$vehiculo)); ?>
		
	</div>

	<div class="row">
		
		<?php echo $form->hiddenField($model,'fecha',array('value'=>date('Y-m-d'))); ?>
		
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'motivo'); ?>
		<?php echo $form->textArea($model,'motivo',array('size'=>60,'maxlength'=>200,'style'=>'width:300px')); ?>
		<?php echo $form->error($model,'motivo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Desincorporar' : 'Save', array('confirm'=>'¿Está completamente seguro de realizar ésta acción?')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->