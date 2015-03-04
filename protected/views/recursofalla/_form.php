<?php
/* @var $this RecursofallaController */
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
		<?php echo $form->labelEx($model,'cantidad'); ?>
		<?php echo $form->textField($model,'cantidad',array('style' => 'width:100px;')); ?>
		<?php echo $form->dropDownList($model,'idunidad',CHtml::listData(Unidad::model()->findAll(),'id','corto'),array('style' => 'width:100px;')); ?>
		<?php echo $form->error($model,'cantidad'); ?>
	</div>

	<div class="row">
		
		<?php echo $form->hiddenField($model,'idreporteFalla'); ?>
		
	</div>

	<div class="row">
	
		<?php echo $form->hiddenField($model,'idinsumo'); ?>
		
	</div>

	<div class="row">
		
		<?php echo $form->hiddenField($model,'idrepuesto'); ?>
		
	</div>

	<div class="row">
		
		<?php echo $form->hiddenField($model,'idservicio'); ?>
		
	</div>



	<div class="row">
		<?php echo $form->labelEx($model,'costoUnitario'); ?>
		<?php echo $form->textField($model,'costoUnitario',array('style' => 'width:100px;')); ?>  Bs.
		<?php echo $form->error($model,'costoUnitario'); ?>
	</div>

	<div class="row">
		
		<?php echo $form->hiddenField($model,'costoTotal'); ?>
		
	</div>
<div class="row" id="garantia" style="display:none"><br>
	Opcional puede agregar informacion adicional de garantía <br><br>
		<?php echo $form->labelEx($model,'garantia'); ?>
		<?php echo $form->textField($model,'garantia',array('style' => 'width:50px;'));?>
		<?php echo $form->dropDownList($model,'idtiempo',CHtml::listData(Tiempo::model()->findAll(array("condition"=>"id <> 5 and id <> 2")),'id','tiempo'),array('id'=>'tiempo','style' => 'width:90px;')); ?>
		<?php echo $form->error($model,'garantia'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Agregar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
/*$("#garantia").hide();
if($("#Recursofalla_idrepuesto").val()!="")
$("#garantia").show();*/
$("#recursofalla-form").submit(function(event){
	event.preventDefault();
	validar();
});
function validar(){
	var cantidad=$("#Recursofalla_cantidad").val();
	var costo=$("#Recursofalla_costoUnitario").val();
	var total=(parseFloat(cantidad) * parseFloat(costo));
	$("#Recursofalla_costoTotal").val(total);
}
</script>