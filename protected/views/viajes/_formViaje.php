<?php
/* @var $this ViajeController */
/* @var $model Viaje */
/* @var $form CActiveForm */
?>

<div class="form">
<?php $estado = new Estados;?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'viaje-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
<div id="verde">
<strong></strong>

	<div class="row">
		<?php echo $form->labelEx($model,'idOrigen',array('style'=>'width:80px')); ?>
		<?php echo $form->dropDownList($model,'idOrigen',CHtml::listData(Lugar::model()->findAll('primario=1'),'id','lugar'),array(
			'style' => 'width:150px;','prompt'=>'Seleccione: ','onchange'=>"{
				validarLugar($('#Viaje_idOrigen option:selected').val());}",)); ?>
		<?php echo $form->error($model,'idOrigen'); ?>
	</div>
	<div class="row" id="_estado" style="display:none">
		<?php echo $form->labelEx($estado,'estado',array('style'=>'width:80px')); ?>
		<?php echo $form->dropDownList($estado,'estado',CHtml::listData(Estados::model()->findAll(array('order' => 'estado ASC')), 'id', 'estado'),
		array(
			'onchange'=>"{
				validarLugar($('#Viaje_idOrigen option:selected').val());}",
			'prompt'=>'Seleccione: ')
		); ?>
		<?php echo $form->error($estado,'estado'); ?>
	</div>
	<div class="row" id="dest" style="display:none">
		<?php echo $form->labelEx($model,'idDestino',array('style'=>'width:80px')); ?>
		<?php echo $form->dropDownList($model,'idDestino',array(),array('prompt'=>'-','style' => 'width:150px;'));  	echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Nuevo destino")), "",array('title'=>'',
        'id'=>'link',
        'style'=>'cursor: pointer;',
        'onclick'=>"{
		destino();}")); ?>
		<?php echo $form->error($model,'idDestino'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'distanciaKm',array('style'=>'width:80px')); ?>
		<?php echo $form->textField($model,'distanciaKm',array('style' => 'width:50px;')); ?><i> *Total Kms ida y regreso al origen</i>
		<?php echo $form->error($model,'distanciaKm'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'idtipo',array('style'=>'width:80px')); ?>
		<?php echo $form->dropDownList($model,'idtipo',CHtml::listData(Tipoviaje::model()->findAll($tipo),'id','tipo'),array('style' => 'width:50px;')); ?>
		<?php echo $form->error($model,'idtipo'); ?>
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model,'viaje',array('size'=>60,'maxlength'=>80)); ?>
	</div>
 
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Agregar' : 'Save'); ?>
	</div>
</div>
<?php $this->endWidget(); ?>

</div>
<script>
$( "#Viaje_idOrigen" ).change(function() {
	if($("#Estados_estado").val()=="")
		$("#link").hide();
	else
		$("#link").show();
  if($("#Viaje_idOrigen").val()!=""){
  	$("#dest").show();
  	$("#_estado").show();
  }
  		
  	else{
		$("#dest").hide();
		$("#_estado").hide();
  	}
  		
});
$( "#Estados_estado" ).change(function() {
  if($(this).val()==""){
 	$("#link").hide();
  }
  		
  	else{
 		$("#link").show();
  	}
  		
});
function destino(){
$('#destino').dialog('open');
	 var dir="<?php echo Yii::app()->baseUrl."/Lugar/agregar/"?>"+$("#Estados_estado option:selected").val();
	jQuery.ajax({
                url: dir,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data)
                 {
                                if (data.status == 'failure')
                                {
                                        $('#destino div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        $('#destino div.divForForm form').submit(destino); // updatePaymentComment
                                }
                                else
                                {
                                        $('#destino div.divForForm').html(data.div);
                                        setTimeout("$('#destino').dialog('close') ",1000);
                                        actualizarLista();
										
                                }
                } ,
                'cache':false});
    return false; 
}
function actualizarLista(){

var dir="<?php echo Yii::app()->baseUrl;?>"+"/viajes/actualizarListaLugar";
	$.ajax({  		
          url: dir,
        })
  	.done(function(result) {    	
    	     $('#Viaje_idDestino').html(result);
  	});
	
}
function validarLugar(id){
var dir="<?php echo Yii::app()->baseUrl;?>"+"/viajes/validarRuta/"+id+"?estado="+$("#Estados_estado option:selected").val();
	$.ajax({  		
          url: dir,
        })
  	.done(function(result){    	
    	     $('#Viaje_idDestino').html(result);
  	});
}
$("#viaje-form").submit(function(event){
	event.preventDefault();
	$('#Viaje_viaje').val($('#Viaje_idOrigen option:selected').text()+" -> "+$('#Viaje_idDestino option:selected').text());
});

</script>
<style>
#verde{
	background: #F9FDFD; 
	padding: 5px;
	border: 1px solid #94A8FF;	
}
div.form .tooltip {
    display: none;
    background-color: #EFFDFF;
    border: 1px solid #79B4DC;
    padding: 10px;
    width: 300px;
}

</style>