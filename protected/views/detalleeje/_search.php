<?php
/* @var $this DetalleejeController */
/* @var $model Detalleeje */
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
		<?php echo $form->label($model,'nroRuedas'); ?>
		<?php echo $form->textField($model,'nroRuedas'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idchasis'); ?>
		<?php echo $form->textField($model,'idchasis'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idposicionEje'); ?>
		<?php echo $form->textField($model,'idposicionEje'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->