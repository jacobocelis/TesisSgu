<?php
	/*
		$model:  es una instancia que implementa a ICrugeStoredUser
	*/
	$this->breadcrumbs=array(
	'Mi perfil',
);

$this->menu=array(
	array('label'=>'<div id="menu"><strong>Sistema</strong></div>' , 'visible'=>'1'),
	//array('label'=>'Crear usuario', 'url'=>array('/cruge/ui/usermanagementcreate')),
	array('label'=>'Administrar usuarios', 'url'=>array('/cruge/ui/usermanagementadmin')),
	array('label'=>'Sesiones de usuarios', 'url'=>array('/cruge/ui/sessionadmin')),
	array('label'=>'Perfil', 'url'=>array('/cruge/ui/editprofile'), 'visible'=>Yii::app()->user->isSuperAdmin),
	array('label'=>'Bitácora', 'url'=>array('/cruge/ui/bitacora')),
);
?>
<?php
	/*
		$model:  
			es una instancia que implementa a ICrugeStoredUser, y debe traer ya los campos extra 	accesibles desde $model->getFields()
		
		$boolIsUserManagement: 
			true o false.  si es true indica que esta operandose bajo el action de adminstracion de usuarios, si es false indica que se esta operando bajo 'editar tu perfil'
	*/
?>

<div class="form">

<?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'crugestoreduser-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>false,
)); ?>
<div class="row form-group">
<h1><?php echo ucwords(CrugeTranslator::t(	
	$boolIsUserManagement ? "Información de usuario" : "editando tu perfil"
));?></h1>
	<div class='field-group'>

		<h6><?php echo ucfirst(CrugeTranslator::t("datos de la cuenta"));?></h6>
		<?php if($boolIsUserManagement){?>
		<div class='col textfield-readonly' >
			<?php echo $form->labelEx($model,'username'); ?>
			<?php echo $form->textField($model,'username'); ?>
			<?php echo $form->error($model,'username'); ?>
		</div>
		<?php }else{?>
		<div class='col textfield-readonly' style="display:none ">
			<?php echo $form->labelEx($model,'username'); ?>
			<?php echo $form->textField($model,'username'); ?>
			<?php echo $form->error($model,'username'); ?>
		</div>
		<?php }?>
		<div class='col'>
			<?php echo $form->labelEx($model,'email'); ?>
			<?php echo $form->textField($model,'email'); ?>
			<?php echo $form->error($model,'email'); ?>
		</div>
		
		<?php if(!$boolIsUserManagement) {?>
		<div class='col' style=" ">
			
			
			<?php echo $form->labelEx($model,'newPassword'); ?>
			<?php echo $form->passwordField($model,'newPassword',array('size'=>10)); ?>
			<?php echo $form->error($model,'newPassword'); ?>

	
		<?php echo $form->labelEx($model,'password_repeat'); ?>
		<?php echo $form->passwordField($model,'password_repeat',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'password_repeat'); ?>
	
			<script>
				function fnSuccess(data){
					$('#CrugeStoredUser_newPassword').val(data);
				}
				function fnError(e){
					alert("error: "+e.responseText);
				}
			</script>
			 
 
		</div>
		<?php }?>
	</div>
	
	<div class='field-group'>
	
		<div class='col textfield-readonly'>
			<?php echo $form->labelEx($model,'regdate'); ?>
			<?php echo $form->textField($model,'regdate'
					,array(
						'readonly'=>'readonly',
						'value'=>Yii::app()->user->ui->formatDate($model->regdate),
					)
			); ?>
		</div>
		<div class='col textfield-readonly' style='display:none'>
			<?php echo $form->labelEx($model,'actdate'); ?>
			<?php echo $form->textField($model,'actdate'
					,array(
						'readonly'=>'readonly',
						'value'=>Yii::app()->user->ui->formatDate($model->actdate),
					)
				); ?>
		</div>
		<div class='col textfield-readonly'>
			<?php echo $form->labelEx($model,'logondate'); ?>
			<?php echo $form->textField($model,'logondate'
					,array(
						'readonly'=>'readonly',
						'value'=>Yii::app()->user->ui->formatDate($model->logondate),
					)
				); ?>
		</div>
	
	</div>
</div>

<!-- inicio de campos extra definidos por el administrador del sistema -->
<?php if($boolIsUserManagement)
	if(count($model->getFields()) > 0){
		echo "<div class='row form-group'>";
		//$foto = Yii::app()->user->um->getFieldValue(Yii::app()->user->id,'foto'); 
		//echo CHtml::image('data:image/jpeg;base64,'.$foto );
		echo "<h6>".ucfirst(CrugeTranslator::t("perfil"))."</h6>";
		foreach($model->getFields() as $f){
			// aqui $f es una instancia que implementa a: ICrugeField
			echo "<div class='col'>";
			

			if($f->fieldname=="Foto"){
				echo CHtml::image('data:image/jpeg;base64,'.$f->fieldvalue);
			}else{
			echo "<br>";
			if($f->fieldname!="gidnumber"){
					echo Yii::app()->user->um->getLabelField($f);
					echo ": ";
					echo Yii::app()->user->um->getInputField($model,$f);
					
					echo $form->error($model,$f->fieldname);
				}
			}
			echo "</div>";
		}
		echo "</div>";
	}
?>
<!-- fin de campos extra definidos por el administrador del sistema -->




<!-- inicio de opciones avanazadas, solo accesible bajo el rol 'admin' -->

<?php 
	if($boolIsUserManagement)
	if(Yii::app()->user->checkAccess('edit-advanced-profile-features'
		,__FILE__." linea ".__LINE__))
		$this->renderPartial('_edit-advanced-profile-features'
			,array('model'=>$model,'form'=>$form),false); 
?>

<!-- fin de opciones avanazadas, solo accesible bajo el rol 'admin' -->





<div class="row buttons">
	<?php Yii::app()->user->ui->tbutton("Guardar Cambios"); ?>
	
</div>

<?php $this->endWidget(); ?>
</div>
