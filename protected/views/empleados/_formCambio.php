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


	<div class="row">
		
		<?php echo $form->hiddenField($model,'fechaInicio'); ?>
	
	</div>

	<div class="row">
		
		<?php echo $form->hiddenField($model,'fechaFin'); ?>
		
	</div>
	<?php 
		$models = Empleado::model()->findAll('idtipoEmpleado=1 and activo=1 and id<>"'.$model->idempleado.'"');
		$data = array();
		foreach ($models as $mode)
			$data[$mode->id] = $mode->nombre . ' '. $mode->apellido;  
	?>
	<div class="row">
		<?php echo $form->labelEx($model,'idempleado'); ?>
		<?php echo $form->dropDownList($model,'idempleado',$data,array('prompt'=>'Seleccione: ','style' => 'width:160px;margin-bottom: 2px;')); ?>
		<?php echo $form->error($model,'idempleado'); ?>
	</div>

	 
	
	
	<div id="unidad"class="row">
		
		<?php echo $form->hiddenField($model,'idvehiculo'); ?>
		
	</div>

	<div id="boton"class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Registrar' : 'Cambiar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->