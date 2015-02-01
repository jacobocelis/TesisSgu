<?php
/* @var $this DetreccauchoController */
/* @var $model Detreccaucho */
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
		<?php echo $form->label($model,'cantidad'); ?>
		<?php echo $form->textField($model,'cantidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'costoUnitario'); ?>
		<?php echo $form->textField($model,'costoUnitario'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'costoTotal'); ?>
		<?php echo $form->textField($model,'costoTotal'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idrecursoCaucho'); ?>
		<?php echo $form->textField($model,'idrecursoCaucho'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'iddetalleEventoCa'); ?>
		<?php echo $form->textField($model,'iddetalleEventoCa'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idunidad'); ?>
		<?php echo $form->textField($model,'idunidad'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->