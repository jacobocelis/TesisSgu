<?php
/* @var $this LugarController */
/* @var $model Lugar */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'lugar-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> obligatorios.</p>

	 

	<div class="row">
		<?php echo $form->labelEx($model,'lugar'); ?>
		<?php echo $form->textField($model,'lugar',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'lugar'); ?>
	</div>

	<div class="row">
		
		<?php echo $form->hiddenField($model,'idestados',array('style'=>'width:180px;')); ?>
		
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'primario'); ?>
		<?php echo $form->dropDownList($model,'primario',array(1=>"Sí",0=>"No"),array('style' => 'width:100px;')); ?>
		<?php echo $form->error($model,'primario'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Agregar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->