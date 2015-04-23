<?php
/* @var $this FacturaController */
/* @var $model Factura */
/* @var $form CActiveForm */
?>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'factura-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
	<p class="note">Campos con <span class="required">*</span> obligatorios.</p>
	
	<div class="row">
		<?php echo $form->labelEx($model,'fechaFactura'); ?>
		<?php echo $form->textField($model,'fechaFactura',array('value'=>$model->fechaFactura==""?date('d/m/Y'):date('d/m/Y',strtotime($model->fechaFactura)),'readonly'=>'readonly','id'=>'otro','style' => 'width:100px;cursor:pointer;')); ?>
		<?php echo $form->error($model,'fechaFactura'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'codigo'); ?>
		<?php echo $form->textField($model,'codigo'); ?>
		<?php echo $form->error($model,'codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idproveedor'); ?>
		<?php echo $form->dropDownList($model,'idproveedor',CHtml::listData(Proveedor::model()->findAll(),'id','nombre'),array('id'=>'nombre','style' => 'width:300px;')); ?>
		<?php echo $form->error($model,'idproveedor'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->hiddenField($model,'idordenMtto'); ?>
		<?php echo $form->hiddenField($model,'total'); ?>
		<?php echo $form->hiddenField($model,'iva'); ?>
		<?php echo $form->hiddenField($model,'totalFactura'); ?>
		
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Continuar' : 'Actualizar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
var intervalo = "<?php echo $intervalo;?>";

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
	        minDate: '-'+intervalo+'d',
	    };
	    $.datepicker.setDefaults($.datepicker.regional['es']);
	});      		
	$("#otro").datepicker();
</script>