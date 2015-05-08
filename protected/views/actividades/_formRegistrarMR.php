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

	<p class="note">Campos con <span class="required">*</span> obligatorios.</p>


		<?php echo $form->hiddenField($model,'ultimoKm'); ?> 

<?php 
		$km=Kilometraje::model()->findAll(array(
			'condition'=>'t.idvehiculo ='.$model->idvehiculo.' order by t.id desc limit 1',
		));
		$modelo=new Kilometraje();
	?>
	
	
	<div class="row">
		
		<?php echo $form->hiddenField($model,'kmRealizada',array('value'=>$id?'':$model->kmRealizada,'style' => 'width:100px;text-align:right;')); ?>
		
	</div>
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'fechaRealizada'); ?>
		<?php echo $form->textField($model,'fechaRealizada',array('value'=>$id?date('d/m/Y'):date("d/m/Y", strtotime($model->fechaRealizada)),'readonly'=>'readonly','style' => 'width:100px;cursor:pointer;')); ?>
		<?php echo $form->error($model,'fechaRealizada'); ?>
	</div>

		
	<div class="row">
		
		
		<?php echo $form->hiddenField($model,'idtiempod',CHtml::listData(Tiempo::model()->findAll(array("condition"=>"id = 5 or id = 2 or id = 1 order by id ASC")),'id','tiempo'),array('style' => 'width:100px;')); ?>
		<?php echo $form->error($model,'duracion'); ?>
	</div>
	
	
	<div class="row">
		<?php echo $form->hiddenField($model,'frecuenciaKm'); ?>
	</div>
	<div class="row">
		<?php echo $form->hiddenField($model,'frecuenciaMes'); ?>
	</div>
	<div class="row">
		
		<?php echo $form->hiddenField($model,'proximoKm'); ?>
		
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model,'proximoFecha'); ?>
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
		<?php echo $form->hiddenField($model,'idtiempof'); ?>
	</div>
	<div class="row">
		
		<?php echo $form->hiddenField($model,'idactividadesGrupo'); ?>
		<?php echo $form->hiddenField($model,'idestatus'); ?>
		<?php echo $form->hiddenField($model,'idactividadMtto'); ?>
		<?php echo $form->hiddenField($model,'procedimiento'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Registrar' : 'Actualizar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
var dir="<?php echo Yii::app()->baseUrl."/mttoPreventivo/getUltimoKm/"?>";	
function getUltimoKm(selected,idvehiculo){

	jQuery.ajax({
                url: dir+idvehiculo,
                'data':$(this).serialize()+"fecha="+selected,
                'type':'post',
                'dataType':'json',
                'success':function(data)
                        {
                              $("#Actividades_kmRealizada").val(data.valor);
                        } ,
                'cache':false});
    return false; 
}
var diass = "<?php echo $dias2;?>";
var idvehiculo="<?php echo $model->idvehiculo;?>";
getUltimoKm($("#Actividades_fechaRealizada").val(),idvehiculo);
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
	        minDate: '-'+diass+'d',
	    };
	    $.datepicker.setDefaults($.datepicker.regional['es']);
	});      		
	$("#Actividades_fechaRealizada").datepicker({
     onSelect: function(selected){
          getUltimoKm(selected,idvehiculo);
		}
	});
</script>
<script type="text/javascript">


$("#Kilometraje_lectura").click(function(){
	$("#Actividades_kmRealizada").val($("#Kilometraje_lectura").val());
});
</script>
<style>
.tooltip {
	opacity: 1;
    display: inline-block;
    width: 10px;
    height: 10px;
    cursor: help;
	background-image: url("<?php echo Yii::app()->request->baseUrl;?>/imagenes/help.png");
}
</style>