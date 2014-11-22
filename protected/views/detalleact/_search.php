<?php
/* @var $this DetalleactController */
/* @var $model Detalleact */
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
		<?php echo $form->label($model,'idfactura'); ?>
		<?php echo $form->textField($model,'idfactura'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'iddetallleOrden'); ?>
		<?php echo $form->textField($model,'iddetallleOrden'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->