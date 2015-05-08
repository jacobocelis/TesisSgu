<?php
/* @var $this ActividadrecursoController */
/* @var $model2 Actividadrecurso */
/* @var $form2 CActiveForm */
?>

<div class="form">

<?php $form2=$this->beginWidget('CActiveForm', array(
	'id'=>'actividadrecurso2-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> obligatorios.</p>


	<div class="row">
		<?php echo $form2->labelEx($model2,'cantidad'); ?>
		<?php echo $form2->textField($model2,'cantidad',array('style' => 'width:100px;')); ?>
		<?php echo $form2->dropDownList($model2,'idunidad',CHtml::listData(Unidad::model()->findAll(),'id','corto'),array('style' => 'width:100px;')); ?>
		<?php echo $form2->error($model2,'cantidad'); ?>
	</div>

	<div class="row">
		
		<?php echo $form2->hiddenField($model2,'idactividades'); ?>
		
	</div>

	<div class="row">
	
		<?php echo $form2->hiddenField($model2,'idinsumo'); ?>
		
	</div>

	<div class="row">
		
		<?php echo $form2->hiddenField($model2,'idrepuesto'); ?>
		
	</div>

	<div class="row">
		
		<?php echo $form2->hiddenField($model2,'idservicio'); ?>
		
	</div>

	<div class="row">
		
		<?php echo $form2->hiddenField($model2,'detalle',array('size'=>60,'maxlength'=>100)); ?>
	
	</div>

	<div class="row">
	
		<?php echo $form2->hiddenField($model2,'idactividadRecursoGrupo'); ?>
		
	</div>

	<div class="row">
		<?php echo $form2->labelEx($model2,'costoUnitario'); ?>
		<?php echo $form2->textField($model2,'costoUnitario',array('style' => 'width:100px;', 'value'=>$model2->costoUnitario<=0?'':$model2->costoUnitario)); ?>  Bs.
		<?php echo $form2->error($model2,'costoUnitario'); ?>
	</div>

	<div class="row">
		
		<?php echo $form2->hiddenField($model2,'costoTotal'); ?>
		
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model2->isNewRecord ? 'Agregar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
/*$("#garantia").hide();
if($("#Actividadrecurso_idrepuesto").val()!="")
$("#garantia").show();*/
$("#actividadrecurso2-form").submit(function(event){
	event.preventDefault();
	validar();
});
function validar(){
	var cantidad=$("#Actividadrecurso_cantidad").val();
	var costo=$("#Actividadrecurso_costoUnitario").val();
	var total=(parseFloat(cantidad) * parseFloat(costo));
	$("#Actividadrecurso_costoTotal").val(total);
}
</script>