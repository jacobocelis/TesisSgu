<?php
/* @var $this ReportefallaController */
/* @var $model Reportefalla */
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
		<?php echo $form->label($model,'detalle'); ?>
		<?php echo $form->textField($model,'detalle',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fechaFalla'); ?>
		<?php echo $form->textField($model,'fechaFalla'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fechaRealizada'); ?>
		<?php echo $form->textField($model,'fechaRealizada'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kmRealizada'); ?>
		<?php echo $form->textField($model,'kmRealizada'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'diasParo'); ?>
		<?php echo $form->textField($model,'diasParo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idtiempo'); ?>
		<?php echo $form->textField($model,'idtiempo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idvehiculo'); ?>
		<?php echo $form->textField($model,'idvehiculo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idempleado'); ?>
		<?php echo $form->textField($model,'idempleado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idfalla'); ?>
		<?php echo $form->textField($model,'idfalla'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idestatus'); ?>
		<?php echo $form->textField($model,'idestatus'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->