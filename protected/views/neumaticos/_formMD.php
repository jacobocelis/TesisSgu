<?php
/* @var $this NeumaticosController */
/* @var $model Historicocaucho */
/* @var $form CActiveForm */
?>

<div id="azul"class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'historicocaucho-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha'); ?>
		<?php echo $form->textField($model,'fecha',array("value"=>$model->fecha=="0000-01-01"?date("d/m/Y"):date("d/m/Y",strtotime($model->fecha)),'readonly'=>'readonly',"style"=>"width:90px;cursor:pointer;")); ?>
		<?php echo $form->error($model,'fecha'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'serial'); ?>
		<?php echo $form->textField($model,'serial',array("value"=>$model->serial=="0"?"":$model->serial,'size'=>20,'maxlength'=>20,"style"=>"width:90px;")); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'idmarcaCaucho'); ?>
		<?php echo $form->dropDownList($model,'idmarcaCaucho',CHtml::listData(Marcacaucho::model()->findAll(),'id','nombre'),array('style' => 'width:150px;'));?>
		</div>
	<?php $models = Caucho::model()->findAll();
		$data = array();
		foreach($models as $mode){
			$piso=Piso::model()->findByPk($mode->idpiso);
			$rin=Rin::model()->findByPk($mode->idrin);
			$medida=Medidacaucho::model()->findByPk($mode->idmedidaCaucho);
			$data[$mode->id] = $medida->medida . ' Rin '. $rin->rin .' '.$piso->piso; 
		}
		?>
		<?php echo $form->labelEx($model,'idcaucho'); ?>
		<?php echo $form->dropDownList($model,'idcaucho',$data,array('style' => 'width:240px;')); ?>
		<?php echo $form->error($model,'idcaucho'); ?>
	
<div class="row">
		<?php echo $form->hiddenField($model,'idestatusCaucho'); ?>

	</div>
	<div class="row">
		<?php echo $form->hiddenField($model,'idvehiculo'); ?>
	</div>
<div class="row">
		<?php echo $form->hiddenField($model,'costounitario'); ?>
	
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model,'iddetalleRueda'); ?>
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model,'idasigChasis'); ?>
	</div>

	<div id="boton"class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Montar' : 'Montar'); ?>
	</div>
		<?php echo $form->error($model,'serial'); ?>
		<?php echo $form->error($model,'idmarcaCaucho'); ?>
	<?php
		echo CHtml::link('Cancelar', "",array('title'=>'Cancelar',
        'style'=>'cursor: pointer;font-size:10px;float:left;',
        'onclick'=>"{cancelar()}"));?>
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
	        //minDate: '0d',
	    };
	    $.datepicker.setDefaults($.datepicker.regional['es']);
	});      		

	$("#Historicocaucho_fecha").datepicker();

function cancelar(){
	//$('#agregar'+"<?php echo $model->idvehiculo;?>").hide();
	$('#dialog').dialog('close');
}
</script>
<style>
#boton{
	float:right;
}
#azul {
    background: none repeat scroll 0% 0% #F9FDFD;
    padding: 5px;
    border: 1px solid #94A8FF;
	overflow:auto;
    width:100%;
	clear:both;
	margin-bottom:5px;
}

</style>