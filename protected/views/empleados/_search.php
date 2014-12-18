<?php
/* @var $this EmpleadosController */
/* @var $model Historicoempleados */
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
		<?php echo $form->label($model,'fechaInicio'); ?>
		<?php echo $form->textField($model,'fechaInicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fechaFin'); ?>
		<?php echo $form->textField($model,'fechaFin'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idempleado'); ?>
		<?php echo $form->textField($model,'idempleado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idvehiculo'); ?>
		<?php echo $form->textField($model,'idvehiculo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->