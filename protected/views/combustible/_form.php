<?php
/* @var $this CombustibleController */
/* @var $model Historicocombustible */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'historicocombustible-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha'); ?>
		<?php echo $form->textField($model,'fecha'); ?>
		<?php echo $form->error($model,'fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'litros'); ?>
		<?php echo $form->textField($model,'litros'); ?>
		<?php echo $form->error($model,'litros'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'costoTotal'); ?>
		<?php echo $form->textField($model,'costoTotal'); ?>
		<?php echo $form->error($model,'costoTotal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idestacionServicio'); ?>
		<?php echo $form->textField($model,'idestacionServicio'); ?>
		<?php echo $form->error($model,'idestacionServicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idconductor'); ?>
		<?php echo $form->textField($model,'idconductor'); ?>
		<?php echo $form->error($model,'idconductor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idvehiculo'); ?>
		<?php echo $form->textField($model,'idvehiculo'); ?>
		<?php echo $form->error($model,'idvehiculo'); ?>
	</div>

	<div class="row">
		
		<?php echo $form->hiddenField($model,'historico',array('value'=>0)); ?>
		
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->