<?php
/* @var $this CombustibleController */
/* @var $model Historicocombustible */
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
		<?php echo $form->label($model,'litros'); ?>
		<?php echo $form->textField($model,'litros'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'costoTotal'); ?>
		<?php echo $form->textField($model,'costoTotal'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idestacionServicio'); ?>
		<?php echo $form->textField($model,'idestacionServicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idconductor'); ?>
		<?php echo $form->textField($model,'idconductor'); ?>
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