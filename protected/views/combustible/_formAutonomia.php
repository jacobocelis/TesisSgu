<div id="azul"class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'autonomia-form',
	'enableAjaxValidation'=>false,
)); ?>	
	<div class="row">
		<?php echo $form->labelEx($model,'autonomia'); ?>
		<?php echo $form->textField($model,'autonomia',array('size'=>3,'maxlength'=>3,'style'=>'width:50px;')); ?> (Km/l)
		<?php echo $form->error($model,'autonomia'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton( 'Guardar'); ?>
	</div>
<?php $this->endWidget(); ?>
<i>* Establecer la autonomía de combustible permite comparar el consumo estimado de cada vehiculo con el consumo real de acuerdo a los viajes realizados.<br> *Sí se observa que el consumo real está muy por encima del consumo estimado pudieramos estar ante la presencia de una "fuga" de combustible</i>
</div><!-- form -->
<style>
#azul{
	border: 1px solid #94A8FF;
	padding:5px;
	margin-right:500px;
}
</style>


