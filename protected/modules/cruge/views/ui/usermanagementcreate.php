<?php
	/*
		$model:  es una instancia que implementa a ICrugeStoredUser
	*/
	$this->breadcrumbs=array(
	'Crear usuario',
);

$this->menu=array(
	array('label'=>'<div id="menu"><strong>Sistema</strong></div>' , 'visible'=>'1'),
	array('label'=>'Crear usuario', 'url'=>array('/cruge/ui/usermanagementcreate')),
	array('label'=>'Administrar usuarios', 'url'=>array('/cruge/ui/usermanagementadmin')),
	array('label'=>'Sesiones de usuarios', 'url'=>array('/cruge/ui/sessionadmin')),
	array('label'=>'Perfil', 'url'=>array('/cruge/ui/editprofile')),
	array('label'=>'Bitácora', 'url'=>array('/cruge/ui/bitacora')),
);
?>
<div class="form">
<?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'crugestoreduser-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>false,
)); ?>
<div class="row form-group">
<h1><?php echo ucwords(CrugeTranslator::t("crear usuario"));?></h1>
	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
	</div>
	<div class="row">
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		</div>
	<div class="row">
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'newPassword'); ?>
		</div>
	<div class="row">
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
		<?php /*echo CHtml::ajaxbutton(
			CrugeTranslator::t("Generar contraseña")
			,Yii::app()->user->ui->ajaxGenerateNewPasswordUrl
			,array('success'=>'js:fnSuccess','error'=>'js:fnError')
			,array('class'=>'btn btn-primary')
		); */?>
		
	</div>
	
	<?php Yii::app()->user->ui->tbutton("Crear Usuario"); ?>
</div>
<div class="row buttons">
	
</div>
<?php $this->endWidget(); ?>
</div>