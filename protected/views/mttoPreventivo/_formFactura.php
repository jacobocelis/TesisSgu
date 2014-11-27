<?php
/* @var $this FacturaController */
/* @var $model Factura */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'factura-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
<h1>Registrar facturación</h1>
	<p class="note">Campos con <span class="required">*</span> obligatorios.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'fechaFactura'); ?>
		<?php echo $form->textField($model,'fechaFactura',array('style' => 'width:100px;')); ?>
		<?php echo $form->error($model,'fechaFactura'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'codigo'); ?>
		<?php echo $form->textField($model,'codigo'); ?>
		<?php echo $form->error($model,'codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idproveedor'); ?>
		<?php echo $form->dropDownList($model,'idproveedor',CHtml::listData(Proveedor::model()->findAll(),'id','nombre'),array('id'=>'nombre','style' => 'width:300px;')); ?>
		<?php echo $form->error($model,'idproveedor'); ?>
	</div>
	<div class="row">
	
		<?php echo $form->hiddenField($model,'idordenMtto',array('value'=>$id)); ?>

	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Continuar' : 'Actualizar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->