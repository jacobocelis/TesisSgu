<?php
/* @var $this CantidadGrupoController */
/* @var $model CantidadGrupo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cantidad-grupo-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		
		<?php echo $form->textField($model,'detallePieza',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'detallePieza'); ?>
	</div>

	<div class="row">
		
		<?php echo $form->hiddenField($model,'idCaracteristicaVehGrupo',array('type'=>"hidden")); ?>
		<?php echo $form->error($model,'idCaracteristicaVehGrupo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Agregar' : 'Agregar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->