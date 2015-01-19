<?php
/* @var $this DetalleeventocaController */
/* @var $model Detalleeventoca */
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
		<?php echo $form->label($model,'fechaFalla'); ?>
		<?php echo $form->textField($model,'fechaFalla'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fechaRealizada'); ?>
		<?php echo $form->textField($model,'fechaRealizada'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comentario'); ?>
		<?php echo $form->textField($model,'comentario',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idhistoricoCaucho'); ?>
		<?php echo $form->textField($model,'idhistoricoCaucho'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idfallaCaucho'); ?>
		<?php echo $form->textField($model,'idfallaCaucho'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idaccionCauho'); ?>
		<?php echo $form->textField($model,'idaccionCauho'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idestatus'); ?>
		<?php echo $form->textField($model,'idestatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idempleado'); ?>
		<?php echo $form->textField($model,'idempleado'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->