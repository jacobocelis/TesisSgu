<?php
/* @var $this EmpleadoController */
/* @var $model Empleado */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'empleado-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
<div id="verde">
	<p class="note">Campos con <span class="required">*</span> obligatorios.</p>


	<div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'apellido'); ?>
		<?php echo $form->textField($model,'apellido',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'apellido'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cedula'); ?>
		<?php echo $form->textField($model,'cedula',array('size'=>10,'maxlength'=>10,'style' => 'width:80px;')); ?>
		<?php echo $form->error($model,'cedula'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idtipoEmpleado'); ?>
		<?php echo $form->dropDownList($model,'idtipoEmpleado',CHtml::listData(Tipoempleado::model()->findAll($tipo),'id','tipo'),array('style'=>'')); ?>
		<?php echo $form->error($model,'idtipoEmpleado'); ?>
	</div>
<?php
		echo CHtml::link('Cancelar', "",array('title'=>'Cancelar',
        'style'=>'cursor: pointer;font-size:10px;float:right;',
        'onclick'=>"{cancelar()}"));?>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Registrar' : 'Guardar'); ?>
	</div>
</div>
<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
function cancelar(){
	$('#registrar').hide();
	$('#registrarRuta').show();
	$('#unidad').show();
	$('#boton').show();
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