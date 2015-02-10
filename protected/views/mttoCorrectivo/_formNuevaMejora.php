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
<div id="verde">
<strong>Complete los datos para registrar una mejora:</strong>
	<div class="row">
		<?php echo $form->labelEx($model,'Mejora'); ?>
		<?php echo $form->textArea($model,'falla',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'falla'); ?>
	</div>
	<div class="row">
		
		<?php echo $form->hiddenField($model,'tipo',array('value'=>1)); ?>
		
	</div>
	<?php
		echo CHtml::link('Cancelar', "",array('title'=>'Cancelar',
        'style'=>'cursor: pointer;font-size:10px;float:right;',
        'onclick'=>"{cancelar()}"));?>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Agregar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
</div><!-- form -->
<script>
function cancelar(){
	$('#nuevaFalla').hide();
	$('#detalle').show();
	$('#boton').show();
	$('#registrarFalla').show();
}
</script>
<style>
#verde{
	background: #D9EDFF;
	width:320px;
	padding: 5px;
	border-radius: 2px;
}
</style>