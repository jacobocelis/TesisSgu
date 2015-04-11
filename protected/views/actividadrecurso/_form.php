<?php
/* @var $this ActividadrecursoController */
/* @var $model Actividadrecurso */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'actividadrecurso-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> obligatorios.</p>


	<div class="row">
		<?php echo $form->labelEx($model,'cantidad'); ?>
		<?php echo $form->textField($model,'cantidad',array('style' => 'width:100px;')); ?>
		<?php echo $form->dropDownList($model,'idunidad',CHtml::listData(Unidad::model()->findAll(),'id','corto'),array('style' => 'width:100px;')); ?>
		<?php echo $form->error($model,'cantidad'); ?>
	</div>

	<div class="row">
		
		<?php echo $form->hiddenField($model,'idactividades'); ?>
		
	</div>

	<div class="row">
	
		<?php echo $form->hiddenField($model,'idinsumo'); ?>
		
	</div>

	<div class="row">
		
		<?php echo $form->hiddenField($model,'idrepuesto'); ?>
		
	</div>

	<div class="row">
		
		<?php echo $form->hiddenField($model,'idservicio'); ?>
		
	</div>

	<div class="row">
		
		<?php echo $form->hiddenField($model,'detalle',array('size'=>60,'maxlength'=>100)); ?>
	
	</div>

	<div class="row">
	
		<?php echo $form->hiddenField($model,'idactividadRecursoGrupo'); ?>
		
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'costoUnitario'); ?>
		<?php echo $form->textField($model,'costoUnitario',array('style' => 'width:100px;', 'value'=>$model->costoUnitario<=0?'':$model->costoUnitario)); ?>  Bs.
		<?php echo $form->error($model,'costoUnitario'); ?>
	</div>

	<div class="row">
		
		<?php echo $form->hiddenField($model,'costoTotal'); ?>
		
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Agregar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
/*$("#garantia").hide();
if($("#Actividadrecurso_idrepuesto").val()!="")
$("#garantia").show();*/
$("#actividadrecurso-form").submit(function(event){
	event.preventDefault();
	validar();
});
function validar(){
	var cantidad=$("#Actividadrecurso_cantidad").val();
	var costo=$("#Actividadrecurso_costoUnitario").val();
	var total=(parseFloat(cantidad) * parseFloat(costo));
	$("#Actividadrecurso_costoTotal").val(total);
}
function nuevoSerial(){
	alert()
}
</script>