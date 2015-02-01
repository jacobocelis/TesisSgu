<?php
/* @var $this DetreccauchoController */
/* @var $model Detreccaucho */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'detreccaucho-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span>obligatorios.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'idrecursoCaucho'); ?>
		<?php echo $form->dropDownList($model,'idrecursoCaucho',CHtml::listData(Recursocaucho::model()->findAll(),'id','recurso'),array('style' => 'width:250px;')); ?>
		<?php echo $form->error($model,'idrecursoCaucho'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'cantidad'); ?>
		<?php echo $form->textField($model,'cantidad',array('style' => 'width:50px;')); ?>
		<?php echo $form->dropDownList($model,'idunidad',CHtml::listData(Unidad::model()->findAll(),'id','corto'),array('style' => 'width:100px;')); ?>
		<?php echo $form->error($model,'cantidad'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->hiddenField($model,'costoUnitario')?> 
	</div>
	<div class="row">
		
		<?php echo $form->hiddenField($model,'costoTotal'); ?>
		
	</div>

	<div class="row">
		
		<?php echo $form->hiddenField($model,'iddetalleEventoCa',array("value"=>$id)); ?>
			
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Agregar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
