<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'correo-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>
	
	<div class="row">
		
		<?php echo $form->hiddenField($model,'from',array('size'=>45,'maxlength'=>45,'readonly'=>'readonly','value'=>Yii::app()->params['correoPrincipal'])); ?>
		
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'to',array("style"=>"width:80px")); ?>
		<?php echo $form->textField($model,'to',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'to'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'subject',array("style"=>"width:80px")); ?>
		<?php echo $form->textField($model,'subject',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'body',array("style"=>"width:80px")); ?>
		<?php echo $form->textArea($model,'body',array('rows' => 6, 'cols' => 50)); ?>
		<?php echo $form->error($model,'body'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton( 'Enviar'); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->


