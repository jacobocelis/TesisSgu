<?php
/* @var $this OrdenmttoController */
/* @var $model Ordenmtto */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ordenmtto-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
<h1>Datos para la orden</h1>
<div class="row">
		<?php //echo $form->labelEx($model,'fecha'); ?>
		<?php echo $form->hiddenField($model,'fecha',array('value'=>date("Y-m-d H:i"),'size'=>20,'maxlength'=>10,'style'=>'width:80px;')); ?>
		<?php //echo $form->error($model,'fecha'); ?>
		
		<?php echo $form->hiddenField($model,'tipo',array('value'=>0)); ?>
		<?php 
		$models = Empleado::model()->findAll('idtipoEmpleado=2');
		$data = array();
		foreach ($models as $mode)
			$data[$mode->id] = $mode->nombre . ' '. $mode->apellido;  ?>
			
	<div class="row">
		<?php echo $form->labelEx($model,'cOperativo'); ?>
		<?php echo $form->dropDownList($model,'cOperativo',$data,array('style' => 'width:200px;')); ?>
		<?php echo $form->error($model,'cOperativo'); ?>
	</div>
	<?php 
		$models = Empleado::model()->findAll("idtipoEmpleado=3");
		$datac		= array();
		foreach ($models as $mode)
			$datac[$mode->id] = $mode->nombre . ' '. $mode->apellido;  ?>
			
	<div class="row">
		<?php echo $form->labelEx($model,'cTaller'); ?>
		<?php echo $form->dropDownList($model,'cTaller',$datac,array('style' => 'width:200px;')); ?>
		<?php echo $form->error($model,'cTaller'); ?>
	</div>
	
		<div class="row">
		<?php echo $form->labelEx($model,'taller'); ?>
		<?php echo $form->dropDownList($model,'taller',CHtml::listData(Proveedor::model()->findAll(),'id','nombre'),array('style' => 'width:300px;')); ?>
		<?php echo $form->error($model,'taller'); ?>
	</div>
	
        <?php echo $form->hiddenField($model,'idestatus',array('value'=>5)); ?>
	
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear orden' : 'Save',array('style'=>'margin-left:20px;margin-bottom: 9px;')); ?>
	<?php 
		echo CHtml::link('Cancelar', "",array('title'=>'Cancelar',
        'style'=>'cursor: pointer;font-size:10px;float:right;',
        'onclick'=>"{cancelarC()}"));?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
function cancelarC(){
	$('#scrollingDiv').show(300);
	$('#formulario').dialog('close')
}
</script>