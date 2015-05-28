<?php
/* @var $this ActividadrecursoController */
/* @var $model Recursofalla */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'recursofalla-form',
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
		<?php echo $form->dropDownList($model,'idinsumo',CHtml::listData(Insumo::model()->findAll(),'id','insumo'),array('id'=>"_idinsumo",'style' => 'width:300px;'));
				echo CHtml::link('<img src='.Yii::app()->baseUrl.'/imagenes/agregar.png alt="Agregar"/>', "", array('title'=>'Agregar un nuevo insumo','style'=>'cursor: pointer; text-decoration: underline;','onclick'=>"{nuevoInsumo(); }"));		?>
		<?php echo $form->error($model,'idinsumo'); ?>
	</div>
	
	<div id="nuevoInsumo"></div>
	
	<div id="servicio"class="row">
		<?php echo $form->labelEx($model,'idservicio'); ?>
		<?php echo $form->dropDownList($model,'idservicio',CHtml::listData(Servicio::model()->findAll(),'id','servicio'),array('id'=>"_idservicio",'style' => 'width:300px;'));
			echo CHtml::link('<img src='.Yii::app()->baseUrl.'/imagenes/agregar.png alt="Agregar"/>', "", array('title'=>'Agregar un nuevo servicio','style'=>'cursor: pointer; text-decoration: underline;','onclick'=>"{nuevoServicio(); }"));		?>
		<?php echo $form->error($model,'idservicio'); ?>
	</div>

		<div id="nuevoServicio"></div>
		
		<div id="repuesto"class="row">
		
		<?php echo $form->labelEx($tipoRepuesto,'subTipo'); ?>
		<?php echo $form->dropDownList($tipoRepuesto,'subTipo',CHtml::listData(Subtiporepuesto::model()->findAll(),'id','subTipo'),array(
			'style' => 'width:200px;','onchange'=>'validarRepuesto(this.value);')); ?><br>
		<?php //echo $form->error($tipoRepuesto,'idOrigen'); ?>
		
		<?php echo $form->labelEx($model,'idrepuesto'); ?>
		<?php echo $form->dropDownList($model,'idrepuesto',CHtml::listData(Repuesto::model()->findAll(),'id','repuesto'),array('id'=>"_idrepuesto",'style' => 'width:200px;')); 
		echo CHtml::link('<img src='.Yii::app()->baseUrl.'/imagenes/agregar.png alt="Agregar"/>', "", array('title'=>'Agregar un nuevo repuesto','style'=>'cursor: pointer; text-decoration: underline;','onclick'=>"{nuevoRepuesto(); }"));?>
		<?php echo $form->error($model,'idrepuesto'); ?>
	</div>
	
	<div id="nuevoRepuesto"></div>
	
	<div id="restoFormRecurso">
	<div class="row">
		<?php echo $form->labelEx($model,'cantidad'); ?>
		<?php echo $form->textField($model,'cantidad',array("id"=>"_cantidad",'style' => 'width:50px;')); ?>
		<?php echo $form->dropDownList($model,'idunidad',CHtml::listData(Unidad::model()->findAll(),'id','corto'),array('style' => 'width:100px;')); ?>
		<?php echo $form->error($model,'cantidad'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'costoUnitario'); ?>
		<?php echo $form->textField($model,'costoUnitario',array("id"=>"_costoUnitario",'style' => 'width:100px;','value'=>$model->costoUnitario<=0?'':$model->costoUnitario)); ?> Bs. 
		<?php echo $form->error($model,'costoUnitario'); ?>
	</div>
	<div class="row">
		
		<?php echo $form->hiddenField($model,'idreporteFalla',array('value'=>$id)); ?>
		
	</div>

	

	<div class="row">
		
		<?php echo $form->hiddenField($model,'costoTotal',array('id'=>'_costoTotal')); ?>
		
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Agregar' : 'Guardar'); ?>
	</div>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
$("#panelBuscar").show();
$( "#buscador" ).focusout(function() {
    $( "#buscador" ).val('');
  });

$("#recursofalla-form").submit(function(event){
	event.preventDefault();
	total();
});
function total(){
	var cantidad=$("#_cantidad").val();
	var costo=$("#_costoUnitario").val();
	var total=(parseFloat(cantidad) * parseFloat(costo));
	$("#_costoTotal").val(total);

}
</script>
<script>
var iden=$('#Tipoinsumo_tipo option:selected').val();
validarInsumo(iden);
var idrep=$('#Subtiporepuesto_subTipo option:selected').val();
validarRepuesto(idrep);
$("#recursofalla-form").submit(function(event){
	event.preventDefault();
	validar();
});
function validar(){
	if($("#lista").val()==1){
		$("#_idservicio option:selected").val('');
		$("#_idrepuesto option:selected").val('');
	}
		if($("#lista").val()==2){
		$("#_idservicio option:selected").val('');
		$("#_idinsumo option:selected").val('');
	}
		if($("#lista").val()==3){
		$("#_idinsumo option:selected").val('');
		$("#_idrepuesto option:selected").val('');
	}
	return true;
}
function validarInsumo(id){
var dir="<?php echo Yii::app()->baseUrl;?>"+"/mttoPreventivo/insumos/"+id;
$.ajax({  		
          url: dir,
        })
  	.done(function( result ) {    	
    	     $('#_idinsumo').html(result);
  	});
}
function validarRepuesto(id){
var dir="<?php echo Yii::app()->baseUrl;?>"+"/mttoPreventivo/repuesto/"+id;
$.ajax({  		
          url: dir,
        })
  	.done(function( result ) {    	
    	     $('#_idrepuesto').html(result);
  	});
}
function validarInsumoNuevo(id){
var dir="<?php echo Yii::app()->baseUrl;?>"+"/mttoPreventivo/ActualizarInsumos/"+id;
$.ajax({  		
          url: dir,
        })
  	.done(function( result ) {    	
    	     $('#_idinsumo').html(result);
  	});
}
function validarRepuestoNuevo(id){
var dir="<?php echo Yii::app()->baseUrl;?>"+"/mttoPreventivo/ActualizarRepuesto/"+id;
$.ajax({  		
          url: dir,
        })
  	.done(function( result ) {    	
    	     $('#_idrepuesto').html(result);
  	});
}
function validarServicioNuevo(){
var dir="<?php echo Yii::app()->baseUrl;?>"+"/mttoPreventivo/ActualizarServicio";
$.ajax({  		
          url: dir,
        })
  	.done(function( result ) {    	
    	     $('#_idservicio').html(result);
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