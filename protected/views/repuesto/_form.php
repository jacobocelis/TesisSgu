<?php
/* @var $this RepuestoController */
/* @var $model Repuesto */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'repuesto-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'repuesto'); ?>
		<?php echo $form->textField($model,'repuesto',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'repuesto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'descripcion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($tipo,'tipo'); ?>
		<?php echo $form->dropDownList($tipo,'id',
		CHtml::listData(Tiporepuesto::model()->findAll(array('order' => 'id ASC')), 'id', 'tipo'),
		array(
			'ajax'=>array(
			'type'=>'POST',
			'url'=>CController::createUrl('Repuesto/Selectdos'),
			'update'=>'#'.CHtml::activeId($model,'idsubTipoRepuesto'),
			),'prompt'=>'Seleccione: ')); 
			
			?>
		<?php echo $form->error($tipo,'id'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'idsubTipoRepuesto'); ?>
		<?php echo $form->dropDownList($model,'idsubTipoRepuesto',array()); ?>
		<?php echo $form->error($model,'idsubTipoRepuesto'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Registrar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->