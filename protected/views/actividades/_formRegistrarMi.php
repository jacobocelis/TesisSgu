<?php
/* @var $this ActividadesController */
/* @var $model Actividades */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'actividades-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
	<div class="crugepanel">
		<i>*marque la casilla si desconoce ésta información, Entonces podrá indicar cuando desea realizar el próximo mantenimiento</i>
	<div class="row">
		<br><?php echo $form->labelEx($model,'noConfirmo'); ?> 
		<?php echo $form->checkBox($model,'noConfirmo'); ?>
		<?php echo $form->error($model,'noConfirmo'); ?>
	</div>
	</div>
	<br>
	<?php 
		$km=Kilometraje::model()->findAll(array(
			'select'=>'max(lectura) as lectura',
			'condition'=>'t.idvehiculo ='.$model->idvehiculo.'  order by t.id desc limit 1',
		));
		$modelo=new Kilometraje();
	?>
	<div id="confirmado">

	<div class="row">
		<label>Última lectura del odómetro: </label><?php echo $form->textField($modelo,'lectura',array('value'=>number_format($km[0]["lectura"], 0,",","") ,'readonly'=>'readonly','style' => 'width:100px;cursor:default;text-align:right')); ?> Km 
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'ultimoKm'); ?>
		<?php echo $form->textField($model,'ultimoKm',array('value'=>$id?'':$model->ultimoKm,'readonly'=>'readonly','style' => 'width:100px;cursor:pointer;text-align:right')); ?>  Km
		<?php echo $form->error($model,'ultimoKm'); ?>
	</div>

<div id="slider-range-min"><div id="uno" style="float:left;margin-top:10px;"></div><div id="dos" style="float:right;margin-top:10px;">Hoy</div></div>

	<div class="row">
		<?php echo $form->labelEx($model,'ultimoFecha'); ?>
		<?php echo $form->textField($model,'ultimoFecha',array('value'=>$id?date("d/m/Y"):date("d/m/Y", strtotime(str_replace('/', '-',$model->ultimoFecha))),'readonly'=>'readonly','style' => 'width:100px;cursor:pointer;')); ?>
		<?php echo $form->error($model,'ultimoFecha'); ?>
	</div>
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model,'frecuenciaKm'); ?>
	</div>
	<div class="row">
		<?php echo $form->hiddenField($model,'frecuenciaMes'); ?>
	</div>

	<div id="noconfirmado" style="display:none">
	<div class="row">
		<?php echo $form->labelEx($model,'proximoKm'); ?>
		<?php echo $form->textField($model,'proximoKm',array('value'=>$id?'':$model->proximoKm ,'readonly'=>'readonly','style' => 'width:100px;cursor:pointer;text-align:right')); ?>  Km
		<?php echo $form->error($model,'proximoKm'); ?>
	</div>

<div id="slider-range-max"><div id="tres" style="float:left;margin-top:10px;">Hoy</div><div id="cuatro" style="float:right;margin-top:10px;">hoy</div></div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'proximoFecha'); ?>
		<?php echo $form->textField($model,'proximoFecha',array('value'=>$id?date("d/m/Y"):date("d/m/Y", strtotime(str_replace('/', '-',$model->ultimoFecha))),'readonly'=>'readonly','style' => 'width:100px;cursor:pointer;')); ?>
		<?php echo $form->error($model,'proximoFecha'); ?>
	</div>
</div>
	<div class="row">
		
		<?php echo $form->hiddenField($model,'duracion'); ?>
	</div>
	<div class="row">
		
		<?php echo $form->hiddenField($model,'atraso'); ?>
		
	</div>
	<div class="row">
		<?php echo $form->hiddenField($model,'idprioridad'); ?>
	</div>
	<div class="row">
		
		<?php echo $form->hiddenField($model,'idvehiculo'); ?>
		
	</div>

	<div class="row">
		
		<?php echo $form->hiddenField($model,'idtiempod'); ?>
		
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model,'idtiempof'); ?>
	</div>
	<div class="row">
		
		<?php echo $form->hiddenField($model,'idactividadesGrupo'); ?>
		<?php echo $form->hiddenField($model,'idestatus',array('value'=>$idestatus?2:$idestatus)); ?>
		<?php echo $form->hiddenField($model,'idactividadMtto'); ?>
		<?php echo $form->hiddenField($model,'procedimiento'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Registrar' : 'Actualizar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
$("#actividades-form").submit(function(event){
	event.preventDefault();
	if($("#Actividades_noConfirmo").is(':checked')){
			$( "#Actividades_ultimoKm" ).val('-1');
			$( "#Actividades_ultimoFecha").val('0000-01-01');
 	}else{
 		$("#Actividades_proximoKm").val('');
 		$("#Actividades_proximoFecha").val('');
 	}
});

<?php $data=Tiempo::model()->findByPk($model->idtiempof);?>
var tiempo="<?php echo $model->frecuenciaMes;?>";
var unidad="<?php echo $data->sqlTimevalues;?>";

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
	        minDate: '-'+tiempo+unidad,
	    };
	    $.datepicker.setDefaults($.datepicker.regional['es']);
	});      		
	$("#Actividades_ultimoFecha").datepicker({
		maxDate: '0d',
		minDate: '-'+tiempo+unidad,
	});
	$("#Actividades_proximoFecha").datepicker({
		minDate: '0d',
	    maxDate: '+'+tiempo+unidad,
	});
	
</script>

 <script>
$("#uno").html("hace: "+$("#Actividades_frecuenciaKm").val()+"Km");
$("#dos").html();

$("#cuatro").html("Dentro de: "+$("#Actividades_frecuenciaKm").val()+"Km");
$("#tres").html();
var medio=$("#Kilometraje_lectura").val()-($("#Actividades_frecuenciaKm").val()/2);
 
var mini=$("#Kilometraje_lectura").val();
var min=$("#Kilometraje_lectura").val()-$("#Actividades_frecuenciaKm").val();
var maxi=parseInt($("#Kilometraje_lectura").val())+parseInt($("#Actividades_frecuenciaKm").val());
if(min<0)
	min=0;
$(function() {
$( "#slider-range-min" ).slider({
	range: "min",
	value: medio,
	min: min,
	step: 1,
max: $("#Kilometraje_lectura").val(),
slide: function( event, ui ) {
$( "#Actividades_ultimoKm" ).val( ui.value );}});
$( "#Actividades_ultimoKm" ).val($( "#slider-range-min" ).slider( "value" ) );
});
$(function() {
 
$( "#slider-range-max" ).slider({
	range: "min",
	min: parseInt(mini),
	step: 1,
max: maxi,
slide: function( event, ui ) {
$( "#Actividades_proximoKm" ).val(ui.value );}});
$( "#Actividades_proximoKm" ).val($( "#slider-range-max" ).slider( "value" ) );
});
</script>
<script>
validar_check();
function validar_check(){
	 if($("#Actividades_noConfirmo").is(':checked')){
 		$("#confirmado").hide(100);
 		$("#noconfirmado").show(100);
 	}else{
 		$("#confirmado").show(100);
 		$("#noconfirmado").hide(100);
 	}
}
$( "#Actividades_noConfirmo" ).change(function() {
	validar_check();
});
</script>