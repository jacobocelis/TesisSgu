<?php
/* @var $this DetallleordenController */
/* @var $model Detallleorden */
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
		<?php echo $form->label($model,'idactividades'); ?>
		<?php echo $form->textField($model,'idactividades'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idordenMtto'); ?>
		<?php echo $form->textField($model,'idordenMtto'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->