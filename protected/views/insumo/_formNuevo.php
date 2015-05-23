<?php
/* @var $this InsumoController */
/* @var $model Insumo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'insumo-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'Nuevo insumo*'); ?>
		<?php echo $form->textField($model,'insumo',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'insumo'); ?>
	</div>
	
	<div class="row">
		
		<?php echo $form->hiddenField($model,'tipoInsumo'); ?>
		<?php echo $form->error($model,'tipoInsumo'); ?>
		
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Agregar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
