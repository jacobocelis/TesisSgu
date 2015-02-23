<?php
/* @var $this FallaController */
/* @var $model Falla */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mejora-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'Mejora'); ?>
		<?php echo $form->textArea($model,'falla',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'falla'); ?>
	</div>
	<div class="row">
		
		<?php echo $form->hiddenField($model,'tipo',array('value'=>1)); ?>
		
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Agregar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
function cancelar(){
	$('#nuevaFalla').hide();
	$('#detalle').show();
	$('#boton').show();
	$('#registrarFalla').show();
}
</script>