<?php
/* @var $this ActividadesgrupoController */
/* @var $model Actividadesgrupo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'actividadesgrupo-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
	
	<div id="nuevaAct"></div>
	
	<div id="restante" style="width:550px">
	<div class="row">
		<?php echo CHtml::link('Nueva actividad'.'<img src='.Yii::app()->baseUrl.'/imagenes/agregar.png alt="Agregar"/>', "", array('title'=>'Agregar una nueva actividad','class'=>'required','style'=>'cursor: pointer; text-decoration: underline;float:left','onclick'=>"{nuevaActividad(); }")); echo $form->error($model,'idactividadMtto',array("style"=>"float:right"));?>
		<?php echo $form->hiddenField($model,'idactividadMtto');?>	
	</div>
	<br>
	<div class="row">
		<?php echo $form->labelEx($model,'frecuenciaKm',array("style"=>"width:130px")); ?>
		<?php echo $form->textField($model,'frecuenciaKm',array('style' => 'width:60px;'));?> Km
		<?php echo $form->error($model,'frecuenciaKm',array("style"=>"float:right;margin-right:20px")); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'frecuenciaMes',array("style"=>"width:130px")); ?>
		<?php echo $form->textField($model,'frecuenciaMes',array('style' => 'width:60px;')); ?>
		<?php echo $form->dropDownList($model,'idtiempof',CHtml::listData(Tiempo::model()->findAll(array("condition"=>"id <> 2 and id <> 5")),'id','tiempo'),array('id'=>'tiempo','style' => 'width:90px;')); ?>
		<?php echo $form->error($model,'frecuenciaMes',array("style"=>"float:right;;margin-right:45px")); ?>
	</div>
	
	<div class="row">
		
		<?php echo $form->hiddenField($model,'duracion',array('style' => 'width:60px;')); ?>
		<?php echo $form->dropDownList($model,'idtiempod',CHtml::listData(Tiempo::model()->findAll(array("condition"=>"id = 5 or id = 2 or id = 1 order by id ASC")),'id','tiempo'),array('style' => 'width:100px;display:none')); ?>
		
	<div class="row">
		<?php //echo $form->labelEx($model,'diasParo'); ?>
		<?php //echo $form->textField($model,'diasParo'); ?>
		<?php //echo $form->error($model,'diasParo'); ?>
	</div>

	<div class="row">
		
		<?php echo $form->hiddenField($model,'idgrupo',array('value'=>$id)); ?>
	
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idprioridad',array("style"=>"width:130px")); ?>
		<?php echo $form->dropDownList($model,'idprioridad',CHtml::listData(Prioridad::model()->findAll(),'id','prioridad'),array('id'=>'prioridad','style' => 'width:100px;')); ?>
		<?php echo $form->error($model,'idprioridad'); ?>
	</div>
	
	 

	<div class="row buttons">
		<?php 
		echo CHtml::submitButton($model->isNewRecord ? 'Registrar' : 'Guardar'); ?>
	</div>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->
 <script>
 $("#actividadesgrupo-form").submit(function(event){
	event.preventDefault();
	validar();
});
 function validar(){
 	var actividades = $.fn.yiiGridView.getSelection('ListaActividades');
 	
 	$('#Actividadesgrupo_idactividadMtto').val(actividades[0]);
 }
 </script>