<?php
/* @var $this CauchorepController */
/* @var $model Cauchorep */
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
		<?php echo $form->label($model,'idchasis'); ?>
		<?php echo $form->textField($model,'idchasis'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idcaucho'); ?>
		<?php echo $form->textField($model,'idcaucho'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->