<?php
/* @var $this CauchorepController */
/* @var $model Cauchorep */
/* @var $form CActiveForm */
?>

<div id="azul"class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cauchorep-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<div class="row">
	
		<?php echo $form->hiddenField($model,'idchasis',array("value"=>$id)); ?>
		
	</div>
<?php $models = Caucho::model()->findAll();
		$data = array();
		
		foreach ($models as $mode){
			$piso=Piso::model()->findByPk($mode->idpiso);
			$rin=Rin::model()->findByPk($mode->idrin);
			$medida=Medidacaucho::model()->findByPk($mode->idmedidaCaucho);
			$data[$mode->id] = $medida->medida . ' Rin '. $rin->rin .' '.$piso->piso; 
		}
		?>
	<div class="row">
		<?php echo $form->labelEx($model,'idcaucho'); ?>
		<?php echo $form->dropDownList($model,'idcaucho',$data,array('style' => 'width:240px;')); ?>
		<?php echo $form->error($model,'idcaucho'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Agregar' : 'Guardar'); ?>
	</div>
<?php
		echo CHtml::link('Cancelar', "",array('title'=>'Cancelar',
        'style'=>'cursor: pointer;font-size:10px;float:right;',
        'onclick'=>"{cancelar()}"));?>
<?php $this->endWidget(); ?>

</div><!-- form -->
<style>
#azul {
    background: none repeat scroll 0% 0% #F9FDFD;
    padding: 5px;
    border: 1px solid #94A8FF;
    margin-top: 5px;
    width: 300px;
	clear:both;
}
</style>
<script>
function cancelar(){
	$('#nuevoCauchoRep').hide();
	$('#cauchoRep').show();	
}
</script>