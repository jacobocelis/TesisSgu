<?php
/* @var $this ActividadrecursogrupoController */
/* @var $model Actividadrecursogrupo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'actividadrecursogrupo-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>

	<div class="row">
		<?php echo $form->hiddenField($model,'idactividadesGrupo',array('value'=>$id)); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'Tipo de recurso: '); ?>
		<select id="lista" >
			<option value="1">Insumo</option>
			<option value="2">Repuesto</option>
			<option value="3">Servicio</option>
		</select>
	</div>
	
	<div id="insumo" class="row">
		<?php echo $form->labelEx($model,'idinsumo'); ?>
		<?php echo $form->dropDownList($model,'idinsumo',CHtml::listData(Insumo::model()->findAll(),'id','insumo'),array('style' => 'width:300px;')); ?>
		<?php echo $form->error($model,'idinsumo'); ?>
	</div>

	<div id="servicio"class="row">
		<?php echo $form->labelEx($model,'idprovServ'); ?>
		<?php echo $form->dropDownList($model,'idprovServ',CHtml::listData(Provserv::model()->findAll(),'id','idservicio'),array('style' => 'width:300px;')); ?>
		<?php echo $form->error($model,'idprovServ'); ?>
	</div>

	<div id="repuesto"class="row">
		<?php echo $form->labelEx($model,'idrepuesto'); ?>
		<?php echo $form->dropDownList($model,'idrepuesto',CHtml::listData(Repuesto::model()->findAll(),'id','repuesto'),array('style' => 'width:200px;')); ?>
		<?php echo $form->error($model,'idrepuesto'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'cantidad'); ?>
		<?php echo $form->textField($model,'cantidad',array('style' => 'width:50px;')); ?>
		<?php echo $form->dropDownList($model,'idunidad',CHtml::listData(Unidad::model()->findAll(),'id','corto'),array('style' => 'width:100px;')); ?>
		<?php echo $form->error($model,'cantidad'); ?>
	</div>
	<div class="row">
		
		<?php echo $form->error($model,'idunidad'); ?>
	</div>
	
	<div class="row">
		
		<?php echo $form->hiddenField($model,'recurso',array('size'=>60,'maxlength'=>100)); ?>
		
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'detalle'); ?>
		<?php echo $form->textArea($model,'detalle',array('size'=>60,'maxlength'=>100, 'style' =>'width: 298px; height: 55px;')); ?>
		<?php echo $form->error($model,'detalle'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Agregar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
$("#servicio").hide();
$("#repuesto").hide();
$("#Actividadrecursogrupo_recurso").val($("#Actividadrecursogrupo_idinsumo option:selected").text());
$("#lista").change(function() {
	if($("#lista").val()==1){
		$("#insumo").show();
		$("#servicio").hide();
		$("#repuesto").hide();
		$("#Actividadrecursogrupo_recurso").val($("#Actividadrecursogrupo_idinsumo option:selected").text());
		//alert($('#Actividadrecursogrupo_idinsumo').is(':visible'));
	} 
	if($("#lista").val()==2){
		$("#insumo").hide();
		$("#servicio").hide();
		$("#repuesto").show();
		$("#Actividadrecursogrupo_recurso").val($("#Actividadrecursogrupo_idrepuesto option:selected").text());
	} 
	if($("#lista").val()==3){
		$("#insumo").hide();
		$("#servicio").show();
		$("#repuesto").hide();
		$("#Actividadrecursogrupo_recurso").val($("#Actividadrecursogrupo_idprovServ option:selected").text());
	} 
});
$("#insumo").change(function() {
	$("#Actividadrecursogrupo_recurso").val($("#Actividadrecursogrupo_idinsumo option:selected").text());
});
$("#repuesto").change(function() {
	$("#Actividadrecursogrupo_recurso").val($("#Actividadrecursogrupo_idrepuesto option:selected").text());
});
$("#servicio").change(function() {
	$("#Actividadrecursogrupo_recurso").val($("#Actividadrecursogrupo_idprovServ option:selected").text());
});
</script>