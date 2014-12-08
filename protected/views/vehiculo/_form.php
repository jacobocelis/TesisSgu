<?php
/* @var $this VehiculoController */
/* @var $model Vehiculo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'vehiculo-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'idgrupo'); ?>
		<?php echo $form->dropDownList($model,'idgrupo',CHtml::listData(Grupo::model()->findAll(array('order' => 'id ASC')), 'id', 'grupo'),
		array(
			'ajax'=>array(
			'type'=>'GET',
			'url'=>CController::createUrl('Vehiculo/Getdatos'),
			'data'=>'js:"id="+$(this).val()',
			'dataType'=>'json',
			'success'=>"js:prueba",
			),'prompt'=>'Seleccione: ')
		); ?>
		<?php echo $form->error($model,'idgrupo'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'numeroUnidad'); ?>
		<?php echo $form->textField($model,'numeroUnidad'); ?>
		<?php echo $form->error($model,'numeroUnidad'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'KmInicial'); ?>
		<?php echo $form->textField($model,'KmInicial'); ?>
		<?php echo $form->error($model,'KmInicial'); ?>
		
		
	<div class="row">
		<?php echo $form->labelEx($model,'serialCarroceria'); ?>
		<?php echo $form->textField($model,'serialCarroceria',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'serialCarroceria'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'serialMotor'); ?>
		<?php echo $form->textField($model,'serialMotor',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'serialMotor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'placa'); ?>
		<?php echo $form->textField($model,'placa',array('size'=>7,'maxlength'=>7)); ?>
		<?php echo $form->error($model,'placa'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'anno'); ?>
		<?php echo $form->textField($model,'anno'); ?>
		<?php echo $form->error($model,'anno'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nroPuestos'); ?>
		<?php echo $form->textField($model,'nroPuestos'); ?>
		<?php echo $form->error($model,'nroPuestos'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nroEjes'); ?>
		<?php echo $form->textField($model,'nroEjes'); ?>
		<?php echo $form->error($model,'nroEjes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'capCarga'); ?>
		<?php echo $form->textField($model,'capCarga'); ?>
		<?php echo $form->error($model,'capCarga'); ?>
	</div>



	<div class="row">
		<?php echo $form->labelEx($model,'cantidadRuedas'); ?>
		<?php echo $form->textField($model,'cantidadRuedas'); ?>
		<?php echo $form->error($model,'cantidadRuedas'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'capTanque'); ?>
		<?php echo $form->textField($model,'capTanque'); ?>
		<?php echo $form->error($model,'capTanque'); ?>
	</div>
<div class="row">
		<?php echo $form->labelEx($marca,'marca'); ?>
		<?php echo $form->dropDownList($marca,'id',CHtml::listData(Marca::model()->findAll(array('order' => 'id ASC')), 'id', 'marca'),
		array(
			'ajax'=>array(
			'type'=>'POST',
			'url'=>CController::createUrl('Vehiculo/Selectdos'),
			'update'=>'#'.CHtml::activeId($model,'idmodelo'),
			)
			,'prompt'=>'Seleccione: ')); 
			
			?>
		<?php echo $form->error($marca,'id'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'idmodelo'); ?>
		<?php echo $form->dropDownList($model,'idmodelo',array(),array('prompt'=>'Seleccione marca ')); ?>
		<?php echo $form->error($model,'idmodelo'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'idcombustible'); ?>
		<?php echo $form->dropDownList($model,'idcombustible',CHtml::listData(Combustible::model()->findAll(),'id','combustible'),array('id'=>'combustible')); ?>
		<?php echo $form->error($model,'idcombustible'); ?>
	</div>
<div class="row">
		<?php echo $form->labelEx($model,'idcolor'); ?>
		<?php echo $form->dropDownList($model,'idcolor',CHtml::listData(Color::model()->findAll(),'id','color'),array('id'=>'color')); ?>
		<?php echo $form->error($model,'idcolor'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'idpropiedad'); ?>
		<?php echo $form->dropDownList($model,'idpropiedad',CHtml::listData(Propiedad::model()->findAll(),'id','propiedad'),array('id'=>'propiedad')); ?>
		<?php echo $form->error($model,'idpropiedad'); ?>
	</div>
	<div class="row">
		
		<?php echo $form->hiddenField($model,'fechaRegistro'); ?>
		
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'comentario'); ?>
		<?php echo $form->textArea($model,'comentario',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'comentario'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Registrar' : 'Actualizar'); ?>
	</div>

<script>

</script>

<?php $this->endWidget(); ?>
<?php

Yii::app()->clientScript->registerScript("update","
    function prueba(data, textStatus, jqXHR){
		if(data==null){	
			$('#Vehiculo_anno').val('');
			$('#Vehiculo_nroPuestos').val('');
			$('#Vehiculo_nroEjes').val('');
			$('#Vehiculo_capCarga').val('');
			$('#Vehiculo_cantidadRuedas').val('');
			$('#Vehiculo_capTanque').val('');
			$('#combustible').val('');
			$('#color').val('');
			$('#propiedad').val('');
		}
		$('#Vehiculo_idgrupo').val(data.idgrupo);
        $('#Vehiculo_anno').val(data.anno);
		$('#Vehiculo_nroPuestos').val(data.nroPuestos);
		$('#Vehiculo_nroEjes').val(data.nroEjes);
		$('#Vehiculo_capCarga').val(data.capCarga);
		$('#Vehiculo_cantidadRuedas').val(data.cantidadRuedas);
		$('#Vehiculo_capTanque').val(data.capTanque);
		$('#combustible').val(data.idcombustible);
		$('#color').val(data.idcolor);
		$('#propiedad').val(data.idpropiedad);	
    }
");
?>
</div><!-- form -->