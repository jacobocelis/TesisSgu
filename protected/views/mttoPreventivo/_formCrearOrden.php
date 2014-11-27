<?php
/* @var $this OrdenmttoController */
/* @var $model Ordenmtto */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ordenmtto-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

<div class="row">
		<?php //echo $form->labelEx($model,'fecha'); ?>
		<?php echo $form->hiddenField($model,'fecha',array('size'=>20,'maxlength'=>10,'style'=>'width:80px;')); ?>
		<?php //echo $form->error($model,'fecha'); ?>
		
		<?php echo $form->labelEx($model,'responsable',array('style'=>'margin-left:2px')); ?>
		<?php echo $form->textField($model,'responsable',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'responsable'); ?>
		
        <?php echo $form->hiddenField($model,'idestatus',array('value'=>5)); ?>
	
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear orden' : 'Save',array('style'=>'margin-left:20px;margin-bottom: 9px;')); ?>
	
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->