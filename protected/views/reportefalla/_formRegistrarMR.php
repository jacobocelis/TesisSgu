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
<?php echo $form->hiddenField($model,'fechaFalla'); ?>
<?php 
		$km=Kilometraje::model()->findAll(array(
			'condition'=>'t.idvehiculo ='.$model->idvehiculo.' order by t.id desc limit 1',
		));
		$modelo=new Kilometraje();
	?>
	
	
	<div class="row">
		
		<?php echo $form->hiddenField($model,'kmRealizada',array('value'=>$id?'':$model->kmRealizada,'style' => 'width:100px;text-align:right;')); ?>
		<?php echo $form->error($model,'kmRealizada'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'fechaRealizada'); ?>
		<?php echo $form->textField($model,'fechaRealizada',array('value'=>$id?date('d/m/Y'):date("d/m/Y", strtotime($model->fechaRealizada)),'readonly'=>'readonly','style' => 'width:100px;cursor:pointer;')); ?>
		<?php echo $form->error($model,'fechaRealizada'); ?>
	</div>

	<div class="row">
		 
		<?php echo $form->hiddenField($model,'diasParo');  
		 echo $form->hiddenField($model,'idtiempo',array('value' =>1)); ?>
	</div>
	<?php 
	if($model->tipo==0){?>

	<div class="row">
		<?php echo $form->labelEx($model,'arreglos'); ?>
		<?php echo $form->textArea($model,'arreglos',array('style' => 'width:80%;')); ?>
		<?php echo $form->error($model,'arreglos'); ?>
	</div>

	<?php }else{?>

	<div class="row">
		<?php echo $form->labelEx($model,'detalle'); ?>
		<?php echo $form->textArea($model,'detalle',array('style' => 'width:80%;')); ?>
		<?php echo $form->error($model,'detalle'); ?>
	</div>
	<?php }?>
	
	<?php echo $form->hiddenField($model,'idvehiculo'); ?>
	<?php echo $form->hiddenField($model,'idempleado'); ?>
	<?php echo $form->hiddenField($model,'idfalla'); ?>
	<?php echo $form->hiddenField($model,'idestatus'); ?>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Registrar' : 'Actualizar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
var dias = "<?php echo $dias2;?>";
var idvehiculo="<?php echo $model->idvehiculo;?>";
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
	        minDate: '-'+dias+'d',
	    };
	    $.datepicker.setDefaults($.datepicker.regional['es']);
	});      		
	$("#Reportefalla_fechaRealizada").datepicker({
		//setDate: "7/11/2011",
		onSelect: function(selected){
          getUltimoKm(selected,idvehiculo);
		}
	});
</script>
<script type="text/javascript">
var dir="<?php echo Yii::app()->baseUrl."/mttoPreventivo/getUltimoKm/"?>";	
function getUltimoKm(selected,idvehiculo){

	jQuery.ajax({
                url: dir+idvehiculo,
                'data':$(this).serialize()+"fecha="+selected,
                'type':'post',
                'dataType':'json',
                'success':function(data)
                        {
                              $("#Reportefalla_kmRealizada").val(data.valor);
                        } ,
                'cache':false});
    return false; 
}
$("#Kilometraje_lectura").click(function(){
	$("#Reportefalla_kmRealizada").val($("#Kilometraje_lectura").val());
});
</script>