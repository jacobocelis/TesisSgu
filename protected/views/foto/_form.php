<?php
/* @var $this FotoController */
/* @var $model Foto */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'foto-form',
	'action'=>array('create','id'=>$vehiculo->id),
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->hiddenField($model,'idvehiculo',array('value'=>$vehiculo->id)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'imagen'); ?>
		<?php echo $form->fileField($model, 'imagen'); ?>
		<?php echo $form->error($model,'imagen'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Agregar Foto'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->