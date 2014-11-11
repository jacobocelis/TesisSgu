<?php
/* @var $this ActividadesController */
/* @var $model Actividades */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'actividad'); ?>
		<?php echo $form->textField($model,'actividad',array('size'=>60,'maxlength'=>80)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ultimoKm'); ?>
		<?php echo $form->textField($model,'ultimoKm'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ultimoFecha'); ?>
		<?php echo $form->textField($model,'ultimoFecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ultimo'); ?>
		<?php echo $form->textField($model,'ultimo',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'frecuenciaKm'); ?>
		<?php echo $form->textField($model,'frecuenciaKm'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'frecuenciaMes'); ?>
		<?php echo $form->textField($model,'frecuenciaMes'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'frecuencia'); ?>
		<?php echo $form->textField($model,'frecuencia',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'proximoKm'); ?>
		<?php echo $form->textField($model,'proximoKm'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'proximoFecha'); ?>
		<?php echo $form->textField($model,'proximoFecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'proximo'); ?>
		<?php echo $form->textField($model,'proximo',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'atraso'); ?>
		<?php echo $form->textField($model,'atraso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idprioridad'); ?>
		<?php echo $form->textField($model,'idprioridad'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idplan'); ?>
		<?php echo $form->textField($model,'idplan'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->