<?php
/* @var $this MetasController */
/* @var $model Metas */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'metas-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<div id="tmef" class="row" style="display:none">
		<?php echo $form->labelEx($model,'TMEF'); ?>
		<?php echo $form->textField($model,'TMEF'); ?>
		<?php echo $form->error($model,'TMEF'); ?>
	</div>

	<div id="tmpr" class="row" style="display:none">
		<?php echo $form->labelEx($model,'TMPR'); ?>
		<?php echo $form->textField($model,'TMPR'); ?>
		<?php echo $form->error($model,'TMPR'); ?>
	</div>

	<div id="disp" class="row" style="display:none">
		<?php echo $form->labelEx($model,'DISP'); ?>
		<?php echo $form->textField($model,'DISP'); ?>
		<?php echo $form->error($model,'DISP'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Establecer'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
var tipo="<?php echo $tipo;?>";

	$("#"+tipo).show();

</script>