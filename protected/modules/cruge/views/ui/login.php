
<?php 

if(Yii::app()->user->hasFlash('loginflash')): ?>
<div class="flash-error">
	<?php echo Yii::app()->user->getFlash('loginflash'); ?>
</div>
<?php else: ?>



<div class='crugepanel user-assignments-role-list'  style="width: 280px; margin: 40px auto 0 auto;">
<h1><?php echo CrugeTranslator::t("Iniciar sesión"); ?></h1>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'logon-form',
	'enableClientValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	
)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
	</div>
	<div class="row">
		<?php echo $form->textField($model,'username',array('style' =>'width:200px' , )); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>		
	</div>
	<div class="row">
		<?php echo $form->passwordField($model,'password',array('style' =>'width:200px' , )); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	<div class="row rememberMe" style="display:none">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>
		<div class="row">
			<?php /*echo Yii::app()->user->ui->passwordRecoveryLink; */?>
		</div>
	<div class="row buttons">
		<?php Yii::app()->user->ui->tbutton("Ingresar"); ?>
		
		<?php
			if(Yii::app()->user->um->getDefaultSystem()->getn('registrationonlogin')===1)
				echo Yii::app()->user->ui->registrationLink;
		?>
	
</div>
<?php $this->endWidget(); ?>
</div>


</div>
<?php endif; ?>