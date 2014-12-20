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
		<?php echo $form->labelEx($model,'Tipo de recurso: '); ?>
		<select id="lista" >
			<option value="1">Insumo</option>
			<option value="2">Repuesto</option>
			<option value="3">Servicio</option>
		</select>
	</div>
	<div id="insumo" class="row">
	<?php echo $form->labelEx($tipoInsumo,'tipo'); ?>
		<?php echo $form->dropDownList($tipoInsumo,'tipo',CHtml::listData(Tipoinsumo::model()->findAll(),'id','tipo'),array(
			'style' => 'width:150px;','onchange'=>'validarInsumo(this.value);')); ?><br>
		<?php //echo $form->error($tipoInsumo,'idOrigen'); ?>
		
		<?php echo $form->labelEx($model,'idinsumo'); ?>
		<?php echo $form->dropDownList($model,'idinsumo',CHtml::listData(Insumo::model()->findAll(),'id','insumo'),array('style' => 'width:300px;')); ?>
		<?php echo $form->error($model,'idinsumo'); ?>
	</div>

	<div id="servicio"class="row">
		<?php echo $form->labelEx($model,'idservicio'); ?>
		<?php echo $form->dropDownList($model,'idservicio',CHtml::listData(Servicio::model()->findAll(),'id','servicio'),array('style' => 'width:300px;')); ?>
		<?php echo $form->error($model,'idservicio'); ?>
	</div>

		<div id="repuesto"class="row">
		
		<?php echo $form->labelEx($tipoRepuesto,'subTipo'); ?>
		<?php echo $form->dropDownList($tipoRepuesto,'subTipo',CHtml::listData(Subtiporepuesto::model()->findAll(),'id','subTipo'),array(
			'style' => 'width:200px;','onchange'=>'validarRepuesto(this.value);')); ?><br>
		<?php //echo $form->error($tipoRepuesto,'idOrigen'); ?>
		
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
		<?php echo $form->labelEx($model,'detalle'); ?>
		<?php echo $form->textArea($model,'detalle',array('size'=>60,'maxlength'=>100, 'style' =>'width: 298px; height: 55px;')); ?>
		<?php echo $form->error($model,'detalle'); ?>
	</div>
	<div class="row">
		
		<?php echo $form->hiddenField($model,'idactividades',array('value'=>$id)); ?>
		
	</div>
	<div class="row">
		
		<?php echo $form->hiddenField($model,'detalle',array('size'=>60,'maxlength'=>100)); ?>
	
	</div>

	<div class="row">
	
		<?php echo $form->hiddenField($model,'idactividadRecursoGrupo'); ?>
		
	</div>

	<div class="row">
	
		<?php echo $form->hiddenField($model,'costoUnitario',array('style' => 'width:100px;')); ?> 
		
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
var iden=$('#Actividadrecurso_idinsumo option:selected').val();
validarInsumo(iden);
var idrep=$('#Actividadrecurso_idrepuesto option:selected').val();
validarRepuesto(idrep);
$("#actividadrecurso-form").submit(function(event){
	event.preventDefault();
	validar();
});
function validar(){
	
	if($("#lista").val()==1){
		$("#Actividadrecurso_idservicio option:selected").val('');
		$("#Actividadrecurso_idrepuesto option:selected").val('');
	}
		if($("#lista").val()==2){
		$("#Actividadrecurso_idservicio option:selected").val('');
		$("#Actividadrecurso_idinsumo option:selected").val('');
	}
		if($("#lista").val()==3){
		$("#Actividadrecurso_idinsumo option:selected").val('');
		$("#Actividadrecurso_idrepuesto option:selected").val('');
	}
	return true;
}

function validarInsumo(id){
var dir="<?php echo Yii::app()->baseUrl;?>"+"/mttoPreventivo/insumos/"+id;
$.ajax({  		
          url: dir,
        })
  	.done(function( result ) {    	
    	     $('#Actividadrecurso_idinsumo').html(result);
  	});
}
function validarRepuesto(id){
var dir="<?php echo Yii::app()->baseUrl;?>"+"/mttoPreventivo/repuesto/"+id;
$.ajax({  		
          url: dir,
        })
  	.done(function( result ) {    	
    	     $('#Actividadrecurso_idrepuesto').html(result);
  	});
}

$("#servicio").hide();
$("#repuesto").hide();
//$("#Actividadrecursogrupo_recurso").val($("#Actividadrecursogrupo_idinsumo option:selected").text());
$("#lista").change(function() {
	if($("#lista").val()==1){
		$("#servicio").hide();
		$("#repuesto").hide();
		$("#insumo").show();
	} 
	if($("#lista").val()==2){
		$("#insumo").hide();
		$("#servicio").hide();
		$("#repuesto").show();
	} 
	if($("#lista").val()==3){
		$("#insumo").hide();
		$("#servicio").show();
		$("#repuesto").hide();
		//$("#Actividadrecursogrupo_recurso").val($("#Actividadrecursogrupo_idprovServ option:selected").text());
	} 
});
/*
$("#insumo").change(function() {
	$("#Actividadrecursogrupo_recurso").val($("#Actividadrecursogrupo_idinsumo option:selected").text());
});
$("#repuesto").change(function() {
	$("#Actividadrecursogrupo_recurso").val($("#Actividadrecursogrupo_idrepuesto option:selected").text());
});
$("#servicio").change(function() {
	$("#Actividadrecursogrupo_recurso").val($("#Actividadrecursogrupo_idprovServ option:selected").text());
});*/
</script>