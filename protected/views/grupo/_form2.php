<?php
/* @var $this InfgrupoController */
/* @var $model Infgrupo */
/* @var $form CActiveForm */
?>

<div class="form" id="Form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'job-form',
	//'action'=>Yii::app()->createUrl('grupo/view/'.$id),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

	

	<div class="row">
		<?php echo $form->labelEx($model,'Nombre del campo:'); ?>
		<?php echo $form->textField($model,'informacion',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'informacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model,'idgrupo',array('type'=>"hidden",'value'=>$id));?>
	</div>

	<div class="row buttons">
<?php echo CHtml::ajaxSubmitButton(Yii::t('job','agregar'),
						CHtml::normalizeUrl(array('grupo/addnew/'.$id,)),array('success'=>'js: function() {
                    }'),array('id'=>'closeJobDialog')); ?>

					</div>

<?php $this->endWidget(); ?>

</div><!-- form -->