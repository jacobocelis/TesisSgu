<?php
/* @var $this RecursocauchoController */
/* @var $model Recursocaucho */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'recursocaucho-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'recurso'); ?>
		<?php echo $form->textField($model,'recurso',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'recurso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'descripcion'); ?>
	</div>

	<div class="row buttons">
	<?php echo CHtml::ajaxSubmitButton('Agregar recurso', $this->createAbsoluteUrl('recursocaucho/nuevo'), 
        array(	 'dataType' => 'json',
                 'type' => 'post',
				 'data'=>array("origen"=>"1"),
				 'success'=>'js:function(data){
				 }',
                ), array('id' => 'botonRot')) 
		?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->