<?php
/* @var $this FacturaController */
/* @var $model Factura */
/* @var $form CActiveForm */
?>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'iva-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'iva'); ?>
		<?php echo $form->textField($model,'iva'); ?>
		<?php echo $form->error($model,'iva'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Actualizar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

