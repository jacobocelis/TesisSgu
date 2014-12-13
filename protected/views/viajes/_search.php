<?php
/* @var $this ViajesController */
/* @var $model Historicoviajes */
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
		<?php echo $form->label($model,'fecha'); ?>
		<?php echo $form->textField($model,'fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'horaSalida'); ?>
		<?php echo $form->textField($model,'horaSalida'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'horaLlegada'); ?>
		<?php echo $form->textField($model,'horaLlegada'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idviaje'); ?>
		<?php echo $form->textField($model,'idviaje'); ?>
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