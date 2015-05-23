<?php
/* @var $this FallacauchoController */
/* @var $model Fallacaucho */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'fallacaucho-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>



	<div class="row">
		<?php echo $form->labelEx($model,'falla'); ?>
		<?php echo $form->textField($model,'falla',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'falla'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Registrar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->