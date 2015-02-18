<?php
/* @var $this InsumoController */
/* @var $model Insumo */
/* @var $form CActiveForm */
?>

<div id="nuevaInsumo"class="form">

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
	<?php
		echo CHtml::link('Cancelar', "",array('title'=>'Cancelar',
        'style'=>'cursor: pointer;font-size:10px;float:right;',
        'onclick'=>"{cancelarInsumo()}"));?>
	<div class="row">
		
		<?php echo $form->hiddenField($model,'tipoInsumo'); ?>
		<?php echo $form->error($model,'tipoInsumo'); ?>
		
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Agregar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<style>
#nuevaInsumo{
	border: 1px solid #eee;
	padding:10px;
	width:90%;
}
form {
    margin: 0px 0px 5px;
}
</style>
<script>
function cancelarInsumo(){
		$("#nuevoInsumo").hide(500);
		$("#lista").attr('disabled', false);
		$("#restoFormRecurso").show(500);
}
</script>