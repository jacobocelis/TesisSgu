<?php
/* @var $this ChasisController */
/* @var $model Chasis */
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
		<?php echo $form->label($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nroEjes'); ?>
		<?php echo $form->textField($model,'nroEjes'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cantidadNormales'); ?>
		<?php echo $form->textField($model,'cantidadNormales'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cantidadRepuesto'); ?>
		<?php echo $form->textField($model,'cantidadRepuesto'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->