<?php
/* @var $this InfgrupoController */
/* @var $model Infgrupo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	//'id'=>'infgrupo-form',
	//'action'=>Yii::app()->createUrl('grupo/view/'.$id),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>



	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Nombre del campo:'); ?>
		<?php echo $form->textField($model,'informacion',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'informacion'); ?>
	</div>
<div class="row">
		<?php echo $form->labelEx($model,'Detalle:'); ?>
		<?php echo $form->textField($model,'detalle',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'detalle'); ?>
	</div>
	<div class="row">
		
		<?php echo $form->hiddenField($model,'idvehiculo',array('type'=>"hidden",'value'=>$id));?>
	
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'agregar' : 'guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->