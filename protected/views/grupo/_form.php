<?php
/* @var $this GrupoController */
/* @var $model Grupo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'grupo-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>	



	<div class="row">
		<?php echo $form->labelEx($model,'grupo'); ?>
		<?php echo $form->textField($model,'grupo',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'grupo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'descripcion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idtipo'); ?>
		<?php echo $form->dropDownList($model,'idtipo',CHtml::listData(Tipo::model()->findAll(),'id','tipo')); ?>
		<?php echo CHtml::link('<img src='.Yii::app()->baseUrl.'/imagenes/agregar.png alt="algo"/>',"",array('title'=>'Registrar un tipo de vehiculo',
        'style'=>'cursor: pointer;',
        'onclick'=>"{
		tipo()}"));?>
		<?php echo $form->error($model,'idtipo'); ?>
		
	</div>
	
	<div id="nuevoTipo" style="max-width:300px"></div>

	<div id="resto" class="row buttons">
	<br>
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar cambios'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
function tipo(){
	$('#tipin').dialog('open');
	$("#lista").attr('disabled', true);
	$("#nuevoTipo").show(500);
	$("#resto").hide(500);
	jQuery.ajax({
                url: "<?php echo Yii::app()->baseUrl;?>"+"/Tipo/nuevoTipo",
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if(data.status == 'failure'){
                                        $('#nuevoTipo ').html(data.div);
                                   
										//$('#Repuesto_idsubTipoRepuesto').val($('#Subtiporepuesto_subTipo option:selected').val());
										$('#nuevoTipo  form').submit(tipo);
                                }
                                else{
                                        $('#nuevoTipo').html(data.div);
										actualizarLista("<?php echo Yii::app()->baseUrl;?>/tipo/ActualizarListaTipo",'#Grupo_idtipo');
										$("#nuevoTipo").hide(500);
										
										$("#resto").show(500);
										//$("#lista").attr('disabled', false);
										//validarRepuestoNuevo($('#Subtiporepuesto_subTipo option:selected').val());
                                }
                },
                'cache':false});
    return false; 
}

</script>

