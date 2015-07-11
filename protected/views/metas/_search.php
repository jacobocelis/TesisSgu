<?php
/* @var $this MetasController */
/* @var $model Metas */
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
		<?php echo $form->label($model,'TMEF'); ?>
		<?php echo $form->textField($model,'TMEF'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TMPR'); ?>
		<?php echo $form->textField($model,'TMPR'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DISP'); ?>
		<?php echo $form->textField($model,'DISP'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->