<?php
/* @var $this RepuestoController */
/* @var $model Repuesto */
/* @var $form CActiveForm */
?>

<div id="nuevaRepuesto"class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'repuesto-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'repuesto'); ?>
		<?php echo $form->textField($model,'repuesto',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'repuesto'); ?>
	</div>
	
	<div class="row">

		<?php echo $form->hiddenField($model,'idsubTipoRepuesto'); ?>
	
	</div>
	
	<?php
		echo CHtml::link('Cancelar', "",array('title'=>'Cancelar',
        'style'=>'cursor: pointer;font-size:10px;float:right;',
        'onclick'=>"{cancelarRepuesto()}"));?>
		
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Registrar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<style>
#nuevaRepuesto{
	border: 1px solid #eee;
	padding:10px;
	width:90%;
}
form {
    margin: 0px 0px 5px;
}
</style>
<script>
function cancelarRepuesto(){
		$("#nuevoRepuesto").hide(500);
		$("#lista").attr('disabled', false);
		$("#restoFormRecurso").show(500);
}
</script>