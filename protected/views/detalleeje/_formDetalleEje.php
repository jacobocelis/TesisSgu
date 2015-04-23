<?php
/* @var $this DetalleejeController */
/* @var $model Detalleeje */
/* @var $form CActiveForm */
?>

<div id="azul"class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'detalleeje-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> obligatorios.</p>
	<div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('maxlength'=>8,'style'=>'width:100px;')); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'idposicionEje'); ?>
		<?php echo $form->dropDownList($model,'idposicionEje',CHtml::listData(Posicioneje::model()->findAll(),'id','posicionEje'),array('style' => 'width:200px;'));  echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Nueva posición eje")), "",array('title'=>'Agregar posición',
        'style'=>'cursor: pointer;font-size:13px;',
        'onclick'=>"{
		AgregarPosicionNueva();}"));?>
	
		
	
		
		
		<?php echo $form->error($model,'idposicionEje'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'nroRuedas'); ?>
		<?php echo $form->textField($model,'nroRuedas',array('size'=>2,'maxlength'=>2,'style'=>'width:40px;')); ?>
		<?php echo $form->error($model,'nroRuedas'); ?>
	</div>

	<div class="row">
		
		<?php echo $form->hiddenField($model,'idchasis',array("value"=>$idchasis)); ?>
	
	</div>

		
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Agregar' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<style>
#azul {
    background: none repeat scroll 0% 0% #F9FDFD;
    padding: 5px;
    border: 1px solid #94A8FF;
    margin-top: 5px;
   /* width: 320px;*/
	clear:both;
}
</style>
<script>
function actualizarListaPosiciones(){

var dir="<?php echo Yii::app()->baseUrl;?>"+"/neumaticos/actualizarListaPosicionesEje";
	$.ajax({  		
          url: dir,
        })
  	.done(function(result) {    	
    	     $('#Detalleeje_idposicionEje').html(result);
  	});
	
}
function AgregarPosicionNueva(){
$('#Posicion').dialog('open');
 
	var dir="<?php echo Yii::app()->baseUrl;?>"+"/posicioneje/agregarPosicionNueva/";
	jQuery.ajax({
                url: dir,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
								
                                if (data.status == 'failure'){
										
										$('#Posicion div.divForForm').html(data.div);
                                        $('#Posicion div.divForForm form').submit(AgregarPosicionNueva);
                                }
                                else{
                                        $('#Posicion div.divForForm').html(data.div);
										setTimeout("$('#Posicion').dialog('close') ",1000);
                                        //setTimeout("$('#registrar').hide(); ",0);
										actualizarListaPosiciones();
										//$('#registrarRuta').show();
										
                                }
                        },
                'cache':false});
    return false; 
}
</script>