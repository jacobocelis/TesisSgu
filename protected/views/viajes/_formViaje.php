<?php
/* @var $this ViajeController */
/* @var $model Viaje */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'viaje-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
<div id="verde">
<strong>Complete los datos para registrar una ruta:</strong>

	<div class="row">
		<?php echo $form->labelEx($model,'idOrigen'); ?>
		<?php echo $form->dropDownList($model,'idOrigen',CHtml::listData(Lugar::model()->findAll(),'id','lugar'),array(
			'style' => 'width:150px;','prompt'=>'Seleccione: ','onchange'=>'validarLugar(this.value);')); ?>
		<?php echo $form->error($model,'idOrigen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idDestino'); ?>
		<?php echo $form->dropDownList($model,'idDestino',array(),array('prompt'=>'-','style' => 'width:150px;')); ?>
		<?php echo $form->error($model,'idDestino'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'distanciaKm'); ?>
		<?php echo $form->textField($model,'distanciaKm',array('style' => 'width:50px;')); ?>
		<?php echo $form->error($model,'distanciaKm'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'idtipo'); ?>
		<?php echo $form->dropDownList($model,'idtipo',CHtml::listData(Tipoviaje::model()->findAll($tipo),'id','tipo'),array('style' => 'width:50px;')); ?>
		<?php echo $form->error($model,'idtipo'); ?>
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model,'viaje',array('size'=>60,'maxlength'=>80)); ?>
	</div>
	<?php
		echo CHtml::link('Cancelar', "",array('title'=>'Cancelar',
        'style'=>'cursor: pointer;font-size:10px;float:right;',
        'onclick'=>"{cancelar()}"));?>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Agregar' : 'Save'); ?>
	</div>
</div>
<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
function validarLugar(id){
var dir="<?php echo Yii::app()->baseUrl;?>"+"/viajes/validarRuta/"+id;
	$.ajax({  		
          url: dir,
        })
  	.done(function( result ) {    	
    	     $('#Viaje_idDestino').html(result);
  	});
}
$("#viaje-form").submit(function(event){
	event.preventDefault();
	$('#Viaje_viaje').val($('#Viaje_idOrigen option:selected').text()+" -> "+$('#Viaje_idDestino option:selected').text());
});
function cancelar(){
	$('#registrar').hide();
	$('#salida').show();
	$('#llegada').show();
	$('#pasajeros').show();
	$('#boton').show();
	$('#registrarRuta').show();
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