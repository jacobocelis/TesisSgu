<?php
/* @var $this PropiedadController */
/* @var $model Propiedad */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'propiedad-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	
	<div class="row">
		<?php echo $form->labelEx($model,'propiedad'); ?>
		<?php echo $form->textField($model,'propiedad',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'propiedad'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Agregar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->