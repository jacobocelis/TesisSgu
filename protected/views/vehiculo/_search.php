<?php
/* @var $this VehiculoController */
/* @var $model Vehiculo */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'numeroUnidad'); ?>
		<?php echo $form->textField($model,'numeroUnidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'serialCarroceria'); ?>
		<?php echo $form->textField($model,'serialCarroceria',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'serialMotor'); ?>
		<?php echo $form->textField($model,'serialMotor',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'placa'); ?>
		<?php echo $form->textField($model,'placa',array('size'=>7,'maxlength'=>7)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'anno'); ?>
		<?php echo $form->textField($model,'anno'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nroPuestos'); ?>
		<?php echo $form->textField($model,'nroPuestos'); ?>
	</div>

	


	<div class="row">
		<?php echo $form->label($model,'comentario'); ?>
		<?php echo $form->textField($model,'comentario',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	

	<div class="row">
		<?php echo $form->label($model,'idmodelo'); ?>
		<?php echo $form->textField($model,'idmodelo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idgrupo'); ?>
		<?php echo $form->textField($model,'idgrupo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idcombustible'); ?>
		<?php echo $form->textField($model,'idcombustible'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idcolor'); ?>
		<?php echo $form->textField($model,'idcolor'); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'idpropiedad'); ?>
		<?php echo $form->textField($model,'idpropiedad'); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'fechaRegistro'); ?>
		<?php echo $form->textField($model,'fechaRegistro'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->