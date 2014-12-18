<?php
/* @var $this EmpleadosController */
/* @var $model Historicoempleados */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'historicoempleados-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		
		<?php echo $form->hiddenField($model,'fechaInicio',array('value'=>date('Y-m-d'))); ?>
	
	</div>

	<div class="row">
		
		<?php echo $form->hiddenField($model,'fechaFin'); ?>
		
	</div>
	<?php 
		$models = Empleado::model()->findAll('idtipoEmpleado=1');
		$data = array();
		foreach ($models as $mode)
			$data[$mode->id] = $mode->nombre . ' '. $mode->apellido;  
	?>
	<div class="row">
		<?php echo $form->labelEx($model,'idempleado'); ?>
		<?php echo $form->dropDownList($model,'idempleado',$data,array('prompt'=>'Seleccione: ','style' => 'width:160px;')); ?>
		<?php echo $form->error($model,'idempleado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idvehiculo'); ?>
		<?php echo $form->dropDownList($model,'idvehiculo',CHtml::listData(Vehiculo::model()->findAll(),'id','numeroUnidad'),array('prompt'=>'Seleccione: ','style' => 'width:110px;')); ?>
		<?php echo $form->error($model,'idvehiculo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Registrar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->