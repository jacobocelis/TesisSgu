<?php
/* @var $this ViajesController */
/* @var $model Historicoviajes */
/* @var $form CActiveForm */
?>

<div id="azul"class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'historicoviajes-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
 

	<p class="note">Campos con  <span class="required">*</span> son obligatorios.</p>
	
	<div class="row">
		<?php echo $form->labelEx($model,'Fecha * ',array("style"=>"width:110px")); ?>
		<?php echo $form->hiddenField($model,'fechaSalida',array('readonly'=>'readonly','style' =>'width:80px;cursor:pointer')); ?>
		<?php echo $form->error($model,'fechaSalida'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'horaSalida',array("style"=>"width:110px")); ?>
		<?php echo $form->hiddenField($model,'horaSalida',array('readonly'=>'readonly','style' =>'width:60px;cursor:pointer')); ?>
		<?php echo $form->error($model,'horaSalida'); ?>
	</div>

	<div class="row">
	
		<?php echo $form->hiddenField($model,'fechaLlegada',array('readonly'=>'readonly','style' =>'width:80px;cursor:pointer')); ?>
	
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'idvehiculo',array("style"=>"width:110px")); ?>
		<?php echo $form->dropDownList($model,'idvehiculo',CHtml::listData(Vehiculo::model()->findAll(),'id','numeroUnidad'),array('prompt'=>'Seleccione: ','onchange'=>'obtenerPuestos(this.value);','style' => 'width:110px;')); ?>
		<?php echo $form->error($model,'idvehiculo'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'idconductor',array("style"=>"width:110px")); ?>
		<?php echo $form->dropDownList($model,'idconductor',array(),array('style' => 'width:170px;')); ?>
		<?php echo $form->error($model,'idconductor'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'idviaje',array("style"=>"width:110px")); ?>
		<?php echo $form->hiddenField($model,'idviaje');?>
		<?php echo $form->error($model,'idviaje');?>
	</div>
	
 	<div class="row">
		<?php echo $form->labelEx($model,'horaLlegada',array("style"=>"width:110px")); ?>
		<?php echo $form->hiddenField($model,'horaLlegada',array('readonly'=>'readonly','style' =>'width:60px;cursor:pointer')); ?>
		<?php echo $form->error($model,'horaLlegada'); ?>
	</div>

	<div class="row">
		
		<?php echo $form->hiddenField($model,'nroPersonas'); ?>
	
	</div>	


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Registrar' : 'Actualizar'); 
		?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<style>
#azul {
    background: none repeat scroll 0% 0% #F9FDFD;
    padding: 5px;
    border: 1px solid #94A8FF;
    margin-top: 5px;
    
}
</style>

