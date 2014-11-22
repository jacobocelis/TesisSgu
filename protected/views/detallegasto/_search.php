<?php
/* @var $this DetallegastoController */
/* @var $model Detallegasto */
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
		<?php echo $form->label($model,'material'); ?>
		<?php echo $form->textField($model,'material',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'costoUnitario'); ?>
		<?php echo $form->textField($model,'costoUnitario'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cantidad'); ?>
		<?php echo $form->textField($model,'cantidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total'); ?>
		<?php echo $form->textField($model,'total'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'iddetalleAct'); ?>
		<?php echo $form->textField($model,'iddetalleAct'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->