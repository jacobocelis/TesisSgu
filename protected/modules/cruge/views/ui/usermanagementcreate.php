
<div class="form">
<?php
	/*
		$model:  es una instancia que implementa a ICrugeStoredUser
	*/
?>
<?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'crugestoreduser-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>false,
)); ?>
<div class="row form-group">
<h1><?php echo ucwords(CrugeTranslator::t("crear nuevo usuario"));?></h1>
	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'newPassword'); ?>
		<?php echo $form->textField($model,'newPassword'); ?>
		<?php echo $form->error($model,'newPassword'); ?>
	

		<script>
			function fnSuccess(data){
				$('#CrugeStoredUser_newPassword').val(data);
			}
			function fnError(e){
				alert("error: "+e.responseText);
			}
		</script>
		<?php echo CHtml::ajaxbutton(
			CrugeTranslator::t("Generar contraseña")
			,Yii::app()->user->ui->ajaxGenerateNewPasswordUrl
			,array('success'=>'js:fnSuccess','error'=>'js:fnError')
		); ?>
		
	</div>
	
	<?php Yii::app()->user->ui->tbutton("Crear Usuario"); ?>
</div>
<div class="row buttons">
	
</div>
<?php $this->endWidget(); ?>
</div>