<?php
/* @var $this ReportefallaController */
/* @var $model Reportefalla */
/* @var $form CActiveForm */
?>

<div id="azul"class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reportemejora-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
<h1>Registro de mejoras</h1>
	<p class="note">Campos con <span class="required">*</span> obligatorios.</p>
	
<div class="row">
		
		<?php echo $form->hiddenField($model,'fechaFalla',array('id'=>'fecha','size'=>10,'readonly'=>'readonly','value'=>date('d/m/Y'),'maxlength'=>8, 'style'=>'width:100px;cursor:pointer;')); ?>

	</div>

	<div class="row">
		<?php echo $form->hiddenField($model,'fechaRealizada'); ?>
	</div>

	<div class="row">
		
		<?php echo $form->hiddenField($model,'kmRealizada'); ?>
		
	</div>
	
	<div class="row">
		
		<?php echo $form->hiddenField($model,'diasParo',array('style' => 'width:60px;')); ?>
		<?php echo $form->hiddenField($model,'idtiempo'); ?>
	
	</div>

	<div class="row">
	<?php echo $form->labelEx($model,'idvehiculo'); ?>
		<?php echo $form->dropDownList($model,'idvehiculo',CHtml::listData(Vehiculo::model()->findAll(),'id','numeroUnidad'),array('prompt'=>'Seleccione: ','style' => 'width:110px;','onchange'=>'obtenerConductor(this.value);')); ?>
		<?php echo $form->error($model,'idvehiculo'); ?>
	</div>
	<?php 
		$models = Empleado::model()->findAll();
		$data = array();
		foreach ($models as $mode)
			$data[$mode->id] = $mode->nombre . ' '. $mode->apellido;  
	?>
	
	<div class="row">
			<?php echo $form->labelEx($model,'Conductor*'); ?>
		<?php echo $form->dropDownList($model,'idempleado',$data,array('style' => 'width:295px;')); ?>
		<?php echo $form->error($model,'idempleado'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'Mejora*'); ?>
		<?php echo $form->dropDownList($model,'idfalla',CHtml::listData(Falla::model()->findAll('tipo=1 order by id desc'),'id','falla'),array('prompt'=>'Seleccione: ','style' => 'width:320px;')); ?>
		<?php echo $form->error($model,'idfalla'); ?>
	</div>
			
	<div id="registrarFalla">			
		<?php echo CHtml::link('Nueva mejora', "",  // the link for open the dialog
		array(
			'style'=>'cursor: pointer; text-decoration: underline;font-size:13px;margin-left:290px;',
			'onclick'=>"{falla(); }"));
			?>
	</div>		
		<div id="nuevaFalla"></div>
	
	<div id="detalle" class="row">
	<br>
		<?php echo $form->labelEx($model,'detalle'); ?>
		<?php echo $form->textArea($model,'detalle',array('size'=>160,'maxlength'=>150,'style'=>'width:310px')); ?>
		<?php echo $form->error($model,'detalle'); ?>
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model,'idestatus',array('value'=>8)); ?>
	</div>
	
	<div class="row">
		<?php echo $form->hiddenField($model,'tipo',array('value'=>1)); ?>
	</div>

	<div id="boton" class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Registrar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
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
	        minDate: '-30d',
	    };
	    $.datepicker.setDefaults($.datepicker.regional['es']);
	});        		
	$("#fecha").datepicker();
</script>
<script>

function obtenerConductor(id){
	if(id=="")
		id=0;
	var dir="<?php echo Yii::app()->baseUrl;?>"+"/mttoCorrectivo/AjaxObtenerConductor/";
	$.ajax({  		
          url: dir+id,
        })
  	.done(function(result) {    	
    	     $('#Reportefalla_idempleado').html(result);
  	});	
}
function falla(){	
	$("#nuevo").dialog("open");
	var dir="<?php echo Yii::app()->baseUrl;?>"+"/mttoCorrectivo/nuevaMejora";
	jQuery.ajax({
                url: dir,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
								
                                if (data.status == 'failure'){
										
										$('#nuevo div.divForForm').html(data.div);
                                        $('#nuevo div.divForForm  form').submit(falla);
                                }
                                else{
										
                                        $('#nuevo div.divForForm').html(data.div);
										$('#nuevaFalla').hide();
										$('#registrarFalla').show();
                                        //setTimeout("$('#nuevaFalla').hide(); ",0);
										$('#detalle').show();
										$('#boton').show();
										actualizarListaFallas();
                                }
                        },
                'cache':false});
				
    return false; 
}
function actualizarListaFallas(){
var dir="<?php echo Yii::app()->baseUrl;?>"+"/mttoCorrectivo/ajaxActualizarListaMejora";
	$.ajax({  		
          url: dir,
        })
  	.done(function(result) {    	
    	     $('#Reportefalla_idfalla').html(result);
  	});
}
</script>
<style>
#azul{
	 background: none repeat scroll 0% 0% #F9FDFD;
    padding: 5px;
    border: 1px solid #94A8FF;
    margin-top: 5px;
	width:50%;
}
</style>
