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
	<?php echo $form->labelEx($tipoInsumo,'tipo'); ?>
		<?php echo $form->dropDownList($tipoInsumo,'tipo',CHtml::listData(Tipoinsumo::model()->findAll(),'id','tipo'),array(
			'style' => 'width:150px;','onchange'=>'validarInsumo(this.value);')); ?><br>
		<?php //echo $form->error($tipoInsumo,'idOrigen'); ?>
		
		<?php echo $form->labelEx($model,'idinsumo'); ?>
		<?php echo $form->dropDownList($model,'idinsumo',CHtml::listData(Insumo::model()->findAll('1 order by insumo asc'),'id','insumo'),array('style' => 'width:300px;')); echo CHtml::link('(+)', "", array('title'=>'Agregar un nuevo insumo','style'=>'cursor: pointer; text-decoration: underline;','onclick'=>"{nuevoInsumo(); }"));?>
		<?php echo $form->error($model,'idinsumo'); ?>
		
	</div>
	
	<div id="nuevoInsumo"></div>

	<div id="servicio"class="row">
	
		<?php echo $form->labelEx($model,'idservicio'); ?>
		<?php echo $form->dropDownList($model,'idservicio',CHtml::listData(Servicio::model()->findAll('1 order by servicio asc'),'id','servicio'),array('style' => 'width:300px;')); echo CHtml::link('(+)', "", array('title'=>'Agregar un nuevo servicio','style'=>'cursor: pointer; text-decoration: underline;','onclick'=>"{nuevoServicio(); }"));?>
		<?php echo $form->error($model,'idservicio'); ?>
		
	</div>

	<div id="nuevoServicio"></div>
	
	<div id="repuesto"class="row">
		
		<?php echo $form->labelEx($tipoRepuesto,'subTipo'); ?>
		<?php echo $form->dropDownList($tipoRepuesto,'subTipo',CHtml::listData(Subtiporepuesto::model()->findAll(),'id','subTipo'),array(
			'style' => 'width:200px;','onchange'=>'validarRepuesto(this.value);')); ?><br>
		<?php //echo $form->error($tipoRepuesto,'idOrigen'); ?>
		
		<?php echo $form->labelEx($model,'idrepuesto'); ?>
		<?php echo $form->dropDownList($model,'idrepuesto',CHtml::listData(Repuesto::model()->findAll(),'id','repuesto'),array('style' => 'width:200px;')); echo CHtml::link('(+)', "", array('title'=>'Agregar un nuevo repuesto','style'=>'cursor: pointer; text-decoration: underline;','onclick'=>"{nuevoRepuesto(); }"));?>
		<?php echo $form->error($model,'idrepuesto'); ?>
	</div>
	
	<div id="nuevoRepuesto"></div>
	
	<div id="restoFormRecurso">
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
		<?php echo $form->labelEx($model,'detalle'); ?>
		<?php echo $form->textArea($model,'detalle',array('size'=>60,'maxlength'=>100, 'style' =>'width: 380px; height: 25px;')); ?>
		<?php echo $form->error($model,'detalle'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Agregar' : 'Guardar'); ?>
	</div>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
var iden=$('#Actividadrecursogrupo_idinsumo option:selected').val();
validarInsumo(iden);

var idrep=$('#Actividadrecursogrupo_idrepuesto option:selected').val();
validarRepuesto(idrep);

$("#actividadrecursogrupo-form").submit(function(event){
	event.preventDefault();
	validar();
});
function validar(){
	if($("#lista").val()==1){
		$("#Actividadrecursogrupo_idservicio option:selected").val('');
		$("#Actividadrecursogrupo_idrepuesto option:selected").val('');
	}
		if($("#lista").val()==2){
		$("#Actividadrecursogrupo_idservicio option:selected").val('');
		$("#Actividadrecursogrupo_idinsumo option:selected").val('');
	}
		if($("#lista").val()==3){
		$("#Actividadrecursogrupo_idinsumo option:selected").val('');
		$("#Actividadrecursogrupo_idrepuesto option:selected").val('');
	}
	return true;
}
function validarInsumoNuevo(id){
var dir="<?php echo Yii::app()->baseUrl;?>"+"/mttoPreventivo/ActualizarInsumos/"+id;
$.ajax({  		
          url: dir,
        })
  	.done(function( result ) {    	
    	     $('#Actividadrecursogrupo_idinsumo').html(result);
  	});
}
function validarInsumo(id){
var dir="<?php echo Yii::app()->baseUrl;?>"+"/mttoPreventivo/insumos/"+id;
$.ajax({  		
          url: dir,
        })
  	.done(function( result ) {    	
    	     $('#Actividadrecursogrupo_idinsumo').html(result);
  	});
}
function validarRepuestoNuevo(id){
var dir="<?php echo Yii::app()->baseUrl;?>"+"/mttoPreventivo/ActualizarRepuesto/"+id;
$.ajax({  		
          url: dir,
        })
  	.done(function( result ) {    	
    	     $('#Actividadrecursogrupo_idrepuesto').html(result);
  	});
}
function validarServicioNuevo(){
var dir="<?php echo Yii::app()->baseUrl;?>"+"/mttoPreventivo/ActualizarServicio";
$.ajax({  		
          url: dir,
        })
  	.done(function( result ) {    	
    	     $('#Actividadrecursogrupo_idservicio').html(result);
  	});
}
function validarRepuesto(id){
var dir="<?php echo Yii::app()->baseUrl;?>"+"/mttoPreventivo/repuesto/"+id;
$.ajax({  		
          url: dir,
        })
  	.done(function( result ) {    	
    	     $('#Actividadrecursogrupo_idrepuesto').html(result);
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

$("#Tipoinsumo_tipo").change(function() {
	$('#Insumo_tipoInsumo').val($('#Tipoinsumo_tipo').val());
});
$("#Subtiporepuesto_subTipo").change(function() {
	$("#Repuesto_idsubTipoRepuesto").val($("#Subtiporepuesto_subTipo option:selected").val());
});
/*$("#servicio").change(function() {
	$("#Actividadrecursogrupo_recurso").val($("#Actividadrecursogrupo_idprovServ option:selected").text());
});*/
</script>