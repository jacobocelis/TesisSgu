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
	<div id="titulo">Registro de actividad de mantenimiento</div>
	<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>

	<?php //echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'idactividadMtto'); ?>
		<?php echo $form->dropDownList($model,'idactividadMtto',CHtml::listData(Actividadmtto::model()->findAll(array('order'=>'actividad asc')),'id','actividad'),array('id'=>'actividad','style' => 'width:345px;')); 
  echo CHtml::link('<img src='.Yii::app()->baseUrl.'/imagenes/agregar.png alt="algo"/>', "", array('title'=>'Agregar una nueva actividad','style'=>'cursor: pointer; text-decoration: underline;','onclick'=>"{nuevaActividad(); }"));?>	
		<?php echo $form->error($model,'idactividadMtto'); ?>
	</div>
	
	<div id="nuevaAct"></div>
	
	<div id="restante">
	<div class="row">
		<?php echo $form->labelEx($model,'frecuenciaKm'); ?>
		<?php echo $form->textField($model,'frecuenciaKm',array('style' => 'width:60px;'));?> Km
		<?php echo $form->error($model,'frecuenciaKm'); ?>
	
		<?php echo $form->labelEx($model,'frecuenciaMes'); ?>
		<?php echo $form->textField($model,'frecuenciaMes',array('style' => 'width:60px;')); ?>
		<?php echo $form->dropDownList($model,'idtiempof',CHtml::listData(Tiempo::model()->findAll(array("condition"=>"id <> 2 and id <> 5")),'id','tiempo'),array('id'=>'tiempo','style' => 'width:90px;')); ?>
		<?php echo $form->error($model,'frecuenciaMes'); ?>
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
		
		<?php echo $form->hiddenField($model,'idgrupo'); ?>
	
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idprioridad'); ?>
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
<style>

#titulo{
	font-family: "Carrois Gothic",sans-serif;
    font-size: 26px;
	font-weight: bold;
	color: inherit;
	text-rendering: optimizelegibility;
	margin: 10px 0px;
}
</style>
