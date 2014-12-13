<?php
/* @var $this ViajeController */
/* @var $model Viaje */
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
		<?php echo $form->label($model,'distanciaKm'); ?>
		<?php echo $form->textField($model,'distanciaKm'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idOrigen'); ?>
		<?php echo $form->textField($model,'idOrigen'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idDestino'); ?>
		<?php echo $form->textField($model,'idDestino'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idtipo'); ?>
		<?php echo $form->textField($model,'idtipo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'viaje'); ?>
		<?php echo $form->textField($model,'viaje',array('size'=>60,'maxlength'=>80)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->