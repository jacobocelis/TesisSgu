<?php
/* @var $this InfgrupoController */
/* @var $model informacion */
/*	$id vehiculo*/
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	//'id'=>'dialog',
	//'action'=>Yii::app()->createUrl('informacion/view/'.$id),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	// echo $form->errorSummary($model);
	'enableAjaxValidation'=>false,
)); ?>
		<div class="row">
		<?php echo $form->labelEx($model,'informacion'); ?>
		<?php echo $form->textField($model,'informacion',array('size'=>60,'maxlength'=>60,'readonly'=>true)); ?>
		<?php echo $form->error($model,'informacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('size'=>60,'maxlength'=>80)); ?>
		<?php echo $form->error($model,'descripcion'); ?>
	</div>
	<div class="row">
		
		<?php echo $form->hiddenField($model,'idvehiculo',array('type'=>"hidden",'value'=>$id));?>
	
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'agregar' : 'guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->