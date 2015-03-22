<?php
/* @var $this FotoController */
/* @var $model Foto */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'foto-form',
	//'action'=>array('create'),
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<?php echo $form->hiddenField($model,'idvehiculo',array('value'=>$vehiculo->id)); ?>
<div class="row">
<?php 
		echo $form->labelEx($model,'imagen');
		echo $form->fileField($model,'imagen');
		echo $form->error($model,'imagen');
		?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Agregar Foto',array('style'=>'margin-top:10px;')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->