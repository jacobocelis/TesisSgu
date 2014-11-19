<?php
/* @var $this ActividadrecursogrupoController */
/* @var $model Actividadrecursogrupo */
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
		<?php echo $form->label($model,'cantidad'); ?>
		<?php echo $form->textField($model,'cantidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idactividadesGrupo'); ?>
		<?php echo $form->textField($model,'idactividadesGrupo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idinsumo'); ?>
		<?php echo $form->textField($model,'idinsumo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idprovServ'); ?>
		<?php echo $form->textField($model,'idprovServ'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idrepuesto'); ?>
		<?php echo $form->textField($model,'idrepuesto'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idunidad'); ?>
		<?php echo $form->textField($model,'idunidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'detalle'); ?>
		<?php echo $form->textField($model,'detalle',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->