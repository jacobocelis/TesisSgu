<?php
/* @var $this EmpleadosController */
/* @var $model Historicoempleados */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'historicoempleados-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
<h1>Registro y asignación de conductores</h1>
	<p class="note">Campos con <span class="required">*</span> obligatorios.</p>


	<div class="row">
		
		<?php echo $form->hiddenField($model,'fechaInicio',array('value'=>date('Y-m-d'))); ?>
	
	</div>

	<div class="row">
		
		<?php echo $form->hiddenField($model,'fechaFin'); ?>
		
	</div>
	<?php 
		$models = Empleado::model()->findAll('idtipoEmpleado=1');
		$data = array();
		foreach ($models as $mode)
			$data[$mode->id] = $mode->nombre . ' '. $mode->apellido;  
	?>
	<div class="row">
		<?php echo $form->labelEx($model,'idempleado'); ?>
		<?php echo $form->dropDownList($model,'idempleado',$data,array('prompt'=>'Seleccione: ','style' => 'width:160px;margin-bottom: 2px;')); ?>
		<?php echo $form->error($model,'idempleado'); ?>
	</div>
	
	<div id="registrarRuta">
	<?php echo CHtml::link('Registrar conductor', "",array('title'=>'Registrar conductor',
        'style'=>'cursor: pointer;font-size:13px;margin-left:120px;',
        'onclick'=>"{AgregarConductor(1);}"));?>
	</div>
	<div id="registrar"></div>
	
	<div id="unidad"class="row">
		<?php echo $form->labelEx($model,'idvehiculo'); ?>
		<?php echo $form->dropDownList($model,'idvehiculo',CHtml::listData(Vehiculo::model()->findAll(),'id','numeroUnidad'),array('prompt'=>'Seleccione: ','style' => 'width:110px;')); ?>
		<?php echo $form->error($model,'idvehiculo'); ?>
	</div>

	<div id="boton"class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Registrar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
$('#registrar').hide();
AgregarConductor(0);
function AgregarConductor(tip){
if(tip){
$('#registrarRuta').hide();
$('#registrar').show();
	$('#unidad').hide();
	$('#boton').hide();
}
	var dir="<?php echo Yii::app()->baseUrl;?>"+"/empleados/registrarConductor";
	jQuery.ajax({
                url: dir,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
								
                                if (data.status == 'failure'){
										
										$('#registrar').html(data.div);
                                        $('#registrar  form').submit(AgregarConductor);
                                }
                                else{
                                        $('#registrar form').html(data.div);
										
                                        setTimeout("$('#registrar').hide(); ",0);
									
										$('#unidad').show();
										$('#boton').show();
										$('#registrarRuta').show();
										//window.setTimeout('location.reload()');
										actualizarListaConductor();
										
                          
                                }
                        },
                'cache':false});
				//$('#registrar').show();
    return false; 
}
function actualizarListaConductor(){
var dir="<?php echo Yii::app()->baseUrl;?>"+"/viajes/actualizarListaConductor";
	$.ajax({  		
          url: dir,
        })
  	.done(function(result) {    	
    	     $('#Historicoempleados_idempleado').html(result);
  	});
}
</script>