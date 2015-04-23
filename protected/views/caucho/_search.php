<?php
/* @var $this CauchoController */
/* @var $model Caucho */
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
		<?php echo $form->label($model,'idmedidaCaucho'); ?>
		<?php echo $form->textField($model,'idmedidaCaucho'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idrin'); ?>
		<?php echo $form->textField($model,'idrin'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idpiso'); ?>
		<?php echo $form->textField($model,'idpiso'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->