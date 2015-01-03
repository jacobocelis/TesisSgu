<?php
/* @var $this CombustibleController */
/* @var $model Historicocombustible */
/* @var $form CActiveForm */
?>

<div id="azul" class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'historicocombustible-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
<h1>Registrar reposición de combustible</h1>
	<p class="note">Campos con <span class="required">*</span> obligatorios.</p>

	<div class="row"><?php echo $form->labelEx($model,'fecha'); ?>
		<?php echo $form->textField($model,'fecha',array('id'=>'fecha','size'=>10,'readonly'=>'readonly','value'=>date('d/m/Y'),'maxlength'=>8, 'style'=>'width:100px;cursor:pointer;')); ?>
	<?php echo $form->error($model,'fecha'); ?>
	</div>

	<div class="row">
	<?php echo $form->labelEx($model,'idvehiculo'); ?>
		<?php echo $form->dropDownList($model,'idvehiculo',CHtml::listData(Vehiculo::model()->findAll(),'id','numeroUnidad'),array('prompt'=>'Seleccione: ','style' => 'width:110px;','onchange'=>'obtenerConductor(this.value);')); ?>
		<?php echo $form->error($model,'idvehiculo'); ?>
	</div>
	
	<div class="row">
			<?php echo $form->labelEx($model,'idconductor'); ?>
		<?php echo $form->dropDownList($model,'idconductor',array(),array('style' => 'width:160px;')); ?>
		<?php echo $form->error($model,'idconductor'); ?>
	</div>
		<div class="row">
		<?php echo $form->labelEx($model,'idestacionServicio'); ?>
		<?php echo $form->dropDownList($model,'idestacionServicio',CHtml::listData(Estacionservicio::model()->findAll(),'id','nombre'),array('style' => 'width:150px;')); ?>
		<?php echo $form->error($model,'idestacionServicio'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'idcombust'); ?>
		<?php echo $form->dropDownList($model,'idcombust',array(),array('style' => 'width:160px;')); ?>
		<?php echo $form->error($model,'idcombust'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'litros'); ?>
		<?php echo $form->textField($model,'litros',array('size'=>4,'maxlength'=>4, 'style'=>'width:100px')); ?>
		<?php echo $form->error($model,'litros'); ?>
	</div>

	<div class="row">
		
		<?php echo $form->hiddenField($model,'costoTotal',array('value'=>0,'size'=>4,'maxlength'=>4, 'style'=>'width:100px')); ?>

	</div>
	
	<div class="row">
		
		<?php echo $form->hiddenField($model,'historico',array('value'=>0)); ?>
		
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Registrar' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<style>
#azul {
    background: none repeat scroll 0% 0% #F9FDFD;
    padding: 5px;
    border: 1px solid #94A8FF;
    margin-top: 5px;
    width: 600px;
}
</style>
<script>

$(function($){
	    $.datepicker.regional['es'] = {
	        closeText: 'Cerrar',
	        prevText: 'Anterior',
	        nextText: 'Siguiente',
	        currentText: 'Hoy',
	        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
	        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
	        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
	        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
	        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
	        weekHeader: 'Sm',
	        dateFormat: 'dd/mm/yy',
	        firstDay: 1,
	        isRTL: false,
			changeMonth: true,
            changeYear: true,
	        showMonthAfterYear: false,
	        yearSuffix: '',
	        maxDate: '0d',
	        //minDate: '0d',
	    };
	    $.datepicker.setDefaults($.datepicker.regional['es']);
	});  
	$("#fecha").datepicker({
		onSelect: function(){
			
		}
});	
function obtenerConductor(id){
	obtenerTipoCombustible(id);
	if(id=="")
		id=0;
	var dir="<?php echo Yii::app()->baseUrl;?>"+"/mttoCorrectivo/AjaxObtenerConductor/";
	$.ajax({  		
          url: dir+id,
        })
  	.done(function(result) {    	
    	     $('#Historicocombustible_idconductor').html(result);
  	});	
}
function obtenerTipoCombustible(id){
	if(id=="")
		id=0;
	var dir="<?php echo Yii::app()->baseUrl;?>"+"/combustible/AjaxObtenerTipoCombustible/";
	$.ajax({  		
          url: dir+id,
        })
  	.done(function(result) {    	
    	     $('#Historicocombustible_idcombust').html(result);
  	});	
}

</script>