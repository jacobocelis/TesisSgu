<?php
/* @var $this SubtiporepuestoController */
/* @var $model Subtiporepuesto */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'subtiporepuesto-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>



	<div class="row">
		
		<?php echo $form->hiddenField($model,'idTipoRepuesto'); ?>
		
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'subTipo'); ?>
		<?php echo $form->textField($model,'subTipo',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'subTipo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Agregar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->