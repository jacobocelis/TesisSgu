<?php
/* @var $this OrdenmttoController */
/* @var $model Ordenmtto */
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
		<?php echo $form->label($model,'tipo'); ?>
		<?php echo $form->textField($model,'tipo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idestatus'); ?>
		<?php echo $form->textField($model,'idestatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'taller'); ?>
		<?php echo $form->textField($model,'taller'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cOperativo'); ?>
		<?php echo $form->textField($model,'cOperativo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cTaller'); ?>
		<?php echo $form->textField($model,'cTaller'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->