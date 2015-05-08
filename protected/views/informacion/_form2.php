<?php
/* @var $this InfgrupoController */
/* @var $model informacion */
/*	$id vehiculo*/
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	//'id'=>'dialog',
	//'action'=>Yii::app()->createUrl('informacion/view/'.$id),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	// echo $form->errorSummary($model);
	'enableAjaxValidation'=>false,
)); ?>
		<div class="row">
		<?php echo $form->labelEx($model,'informacion'); ?>
		<?php echo $form->textField($model,'informacion',array('size'=>60,'maxlength'=>60,'readonly'=>true)); ?>
		<?php echo $form->error($model,'informacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'descripcion',array('style'=>'width:120px;')); ?>
		<?php echo $form->dropDownList($model,'descripcion',array("Sí"=>"Sí","No"=>"No"),array('style' => 'width:100px;')); ?>
		<?php echo $form->error($model,'descripcion'); ?>
		<?php 
		echo CHtml::label('Valor', 'nombre',array('style'=>'margin-right:10px;margin-left:20px;'));
		echo CHtml::CheckBox('check',false, array('value'=>'on')); ?>

	</div>
	<div class="row">
		<?php echo $form->hiddenField($model,'idvehiculo',array('type'=>"hidden",'value'=>$id));?>
	
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'agregar' : 'guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
$( "input" ).change(function() {
  var $input = $(this);
 	if($("#check").is(':checked'))
		$('#Informacion_descripcion').replaceWith('<input style="width:120px;" size="60" maxlength="80" name="Informacion[descripcion]" id="Informacion_descripcion" type="text">');	
	else
		$('#Informacion_descripcion').replaceWith('<select style="width:100px;" name="Informacion[descripcion]" id="Informacion_descripcion"><option value="Sí">Sí</option><option value="No" selected="selected">No</option></select>');
});
</script>