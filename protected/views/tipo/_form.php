<?php
/* @var $this TipoController */
/* @var $model Tipo */
/* @var $form CActiveForm */
?>

<div class="nuevo">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tipo-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Nuevo tipo* '); ?>
		<?php echo $form->textField($model,'tipo',array('size'=>60,'maxlength'=>80)); ?>
		<?php echo $form->error($model,'tipo'); ?>
	</div>
	<?php
		echo CHtml::link('Cancelar', "",array('title'=>'Cancelar',
        'style'=>'cursor: pointer;font-size:10px;float:right;',
        'onclick'=>"{cancelar()}"));?>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Registrar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<style>

.nuevo {
    margin: 0px 0px 5px;
	border: 1px solid #eee;
	padding:10px;
	width:90%;
}
</style>
<script>
function cancelar(){
		$("#nuevoTipo").hide(500);
		
		$("#resto").show(500);
}
</script>