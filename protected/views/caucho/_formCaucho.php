<?php
/* @var $this CauchoController */
/* @var $model Caucho */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'caucho-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> obligatorios.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'idmedidaCaucho'); ?>
		<?php echo $form->dropDownList($model,'idmedidaCaucho',CHtml::listData(Medidacaucho::model()->findAll(),'id','medida'),array("style"=>'width:120px')); ?>
		<?php echo $form->error($model,'idmedidaCaucho'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idrin'); ?>
		<?php echo $form->dropDownList($model,'idrin',CHtml::listData(Rin::model()->findAll(),'id','rin'),array("style"=>'width:80px')); ?>
		<?php echo $form->error($model,'idrin'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idpiso'); ?>
		<?php echo $form->dropDownList($model,'idpiso',CHtml::listData(Piso::model()->findAll(),'id','piso'),array("style"=>'width:140px')); ?>
		<?php echo $form->error($model,'idpiso'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Agregar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->