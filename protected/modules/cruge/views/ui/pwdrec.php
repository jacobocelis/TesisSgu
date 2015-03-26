<div class='crugepanel user-assignments-role-list'  style="width: 400px; margin: 40px auto 0 auto;">
<h1><?php echo CrugeTranslator::t("Recuperar la contraseña"); ?></h1>

<?php if(Yii::app()->user->hasFlash('pwdrecflash')): ?>
<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('pwdrecflash'); ?>
</div>
<?php else: ?>
<div class="form">
<i>La contraseña será enviada a su correo electrónico</i>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pwdrcv-form',
	'enableClientValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
<br>
	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		
	</div>
	<div class="row">
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>
	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="row">
		
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<div class="hint"><?php echo CrugeTranslator::t("por favor ingrese el código de la imagen");?></div>
		<?php echo $form->textField($model,'verifyCode'); ?>
		</div>
		
		<?php echo $form->error($model,'verifyCode'); ?>
	</div>
	<?php endif; ?>
	
	<div class="row buttons">
		<?php Yii::app()->user->ui->tbutton("Recuperar"); ?>
	</div>
	
<?php $this->endWidget(); ?>
</div>
</div>
<?php endif; ?>