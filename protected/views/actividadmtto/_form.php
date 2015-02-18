<?php
/* @var $this ActividadmttoController */
/* @var $model Actividadmtto */
/* @var $form CActiveForm */
?>

<div id="nueva"class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'actividadmtto-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'actividad'); ?>
		<?php echo $form->textField($model,'actividad',array('size'=>60,'maxlength'=>100,'style'=>'width:290px;')); ?>
		<?php echo $form->error($model,'actividad'); ?>
	</div>

		<?php
		echo CHtml::link('Cancelar', "",array('title'=>'Cancelar',
        'style'=>'cursor: pointer;font-size:10px;float:right;',
        'onclick'=>"{cancelar()}"));?>
		
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Agregar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<style>
#nueva{
	border: 1px solid #eee;
	padding:10px;
	width:90%;
}
form {
    margin: 0px 0px 5px;
}
</style>
<script>
function cancelar(){
	$("#nuevaAct").hide(500);
	$("#restante").show(500);
}
</script>