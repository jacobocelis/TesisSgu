<?php
/* @var $this RecursocauchoController */
/* @var $model Recursocaucho */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'recursocaucho-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
<div id="verde">
<strong>Complete los datos para registrar un recurso:</strong>

	<div class="row">
		<?php echo $form->labelEx($model,'recurso'); ?>
		<?php echo $form->textField($model,'recurso',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'recurso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'descripcion'); ?>
	</div>
<?php
		echo CHtml::link('Cancelar', "",array('title'=>'Cancelar',
        'style'=>'cursor: pointer;font-size:10px;float:right;',
        'onclick'=>"{cancelar()}"));?>
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Agregar' : 'Guardar'); ?>
</div>
<?php $this->endWidget(); ?>

</div><!-- form -->
<script>

function cancelar(){
	$('#regis').show();
	$('#nuevo').hide();
	$('#cantidad').show();
	$('#buton').show();
}
</script>
<style>
#verde{
	background: #D9EDFF;
	width:320px;
	padding: 5px;
	 border: 1px solid #94A8FF;
}
</style>