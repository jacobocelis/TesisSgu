<?php
/* @var $this AsigchasisController */
/* @var $model Asigchasis */
/* @var $form CActiveForm */
?>

<div id="azul"class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'asigchasis-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
<strong>Seleccione un grupo para asignar la plantilla</strong>
	<div class="row">
		<?php echo $form->hiddenField($model,'idchasis',array("value"=>$id)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idgrupo'); ?>
		<?php echo $form->dropDownList($model,'idgrupo',CHtml::listData(Grupo::model()->findAll('id not in (select idgrupo from sgu_asigChasis)'), 'id', 'grupo'),array("prompt"=>"Seleccione: ")); ?>
		<?php echo $form->error($model,'idgrupo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Asignar' : 'Guardar',array("id"=>"boton","style"=>"cursor:pointer")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>

$('#asigchasis-form').submit(function() {
        $('#boton').attr("disabled", true);
		
        return true; // return false to cancel form action
    });
</script>
<style>
#azul {
    background: none repeat scroll 0% 0% #F9FDFD;
    border: 1px solid #A8C5F0;
    width: 350px;
    float: left;
    padding: 10px;
    margin-top: 10px;
	
}
</style>