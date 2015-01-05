<?php
/* @var $this NeumaticosController */
/* @var $model Historicocaucho */
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
		<?php echo $form->label($model,'serial'); ?>
		<?php echo $form->textField($model,'serial',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idestatusCaucho'); ?>
		<?php echo $form->textField($model,'idestatusCaucho'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idcaucho'); ?>
		<?php echo $form->textField($model,'idcaucho'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idmarcaCaucho'); ?>
		<?php echo $form->textField($model,'idmarcaCaucho'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idposicionEje'); ?>
		<?php echo $form->textField($model,'idposicionEje'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idposicionRueda'); ?>
		<?php echo $form->textField($model,'idposicionRueda'); ?>
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