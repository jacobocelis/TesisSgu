<?php
/* @var $this CantidadController */
/* @var $model Cantidad */
/* @var $form CActiveForm */
$repuesto=new Repuesto();
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	//'id'=>'cantidad-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
	<?php 
	$data=array(1=>'Cambio',2=>'reparación') ?>
	<div class="row">
		<?php echo $form->labelEx($model,'evento'); ?>
		<?php echo $form->dropDownList($model,'evento',$data,array('style' => 'width:110px;')); ?>
		<?php echo $form->error($model,'evento'); ?>
	</div>

	
	<div class="row">
		
		<?php echo $form->hiddenField($model,'detallePieza',array('size'=>60,'maxlength'=>100,'readonly'=>true)); ?>
	
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'codigoPiezaEnUso'); ?>
		<?php echo $form->textField($model,'codigoPiezaEnUso',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'codigoPiezaEnUso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fechaIncorporacion'); ?>
		<?php echo $form->textField($model,'fechaIncorporacion',array('value'=>$model->fechaIncorporacion=='0000-01-01'?date("d/m/Y"):date("d/m/Y", strtotime(str_replace('/', '-',$model->fechaIncorporacion))),'readonly'=>'readonly','style' => 'width:100px;cursor:pointer;')); ?>
		<?php echo $form->error($model,'fechaIncorporacion'); ?>
	</div>
	



	<div class="row">
	
		<?php echo $form->hiddenField($model,'estado'); ?>
		<?php echo $form->error($model,'estado'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Registrar' : 'Actualizar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
var codigo="<?php echo $actual->codigoPiezaEnUso;?>";
evaluar();
function evaluar(){
 if($("#Cantidad_evento").val()==1){
        $("#Cantidad_codigoPiezaEnUso").removeAttr('readonly');
        $("#Cantidad_codigoPiezaEnUso").val('');
  }
            	
 if($("#Cantidad_evento").val()==2){
        $("#Cantidad_codigoPiezaEnUso").attr('readonly', 'readonly');
        $("#Cantidad_codigoPiezaEnUso").val(codigo);
    }	
}
 	


$("#Cantidad_evento").change(function(){

           evaluar();
	});

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
	        showMonthAfterYear: false,
	        yearSuffix: '',
	        maxDate: 0,
	        changeMonth: true,
            changeYear: true,
	        
	    };
	    $.datepicker.setDefaults($.datepicker.regional['es']);
	});      		

	$("#Cantidad_fechaIncorporacion").datepicker({
		onSelect: function(selected) {
			$("#findate").datepicker("option","minDate", selected+" +1d");
		}
	});
	$("#findate").datepicker();
</script>