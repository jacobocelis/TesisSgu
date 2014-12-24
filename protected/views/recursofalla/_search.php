<?php
/* @var $this RecursofallaController */
/* @var $model Recursofalla */
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
		<?php echo $form->label($model,'idinsumo'); ?>
		<?php echo $form->textField($model,'idinsumo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idservicio'); ?>
		<?php echo $form->textField($model,'idservicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idrepuesto'); ?>
		<?php echo $form->textField($model,'idrepuesto'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idreporteFalla'); ?>
		<?php echo $form->textField($model,'idreporteFalla'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idunidad'); ?>
		<?php echo $form->textField($model,'idunidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'garantia'); ?>
		<?php echo $form->textField($model,'garantia'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idtiempo'); ?>
		<?php echo $form->textField($model,'idtiempo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->