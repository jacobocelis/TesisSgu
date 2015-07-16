<style>
#titulo {
    float: left;
    font-size: 120%;
}
#sep {
    text-align: right;
    font-size: 120%;
}
#azul {
    background: none repeat scroll 0% 0% #F9FDFD;
    padding: 10px;
    border: 1px solid #94A8FF;
    margin-top: 5px;
    
}
</style>
<?php
/* @var $this DetalleeventocaController */
/* @var $model Detalleeventoca */
/* @var $form CActiveForm */
?>

<div id="azul"class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'detalleeventoca-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
<h1>Registro de averías en neumáticos</h1>

	<p class="note">Campos con <span class="required">*</span> obligatorios.</p>
	
	<div class="row">
		<?php echo $form->labelEx($model,'fechaFalla'); ?>
		<?php echo $form->textField($model,'fechaFalla',array('size'=>10,'readonly'=>'readonly','value'=>date('d/m/Y'),'maxlength'=>8, 'style'=>'width:100px;cursor:pointer;')); ?>
	<?php echo $form->error($model,'fechaFalla'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'idfallaCaucho'); ?>
		<?php echo $form->dropDownList($model,'idfallaCaucho',CHtml::listData(Fallacaucho::model()->findAll(),'id','falla')); echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Nueva avería")), "",array('title'=>'Registrar avería',
		 //'class'=>'botonAgregar',
        'style'=>'cursor: pointer;font-size:15px',
        'onclick'=>"{
		AgregarAveriaNueva();}"));?>
		<?php echo $form->error($model,'idfallaCaucho');?>
	</div>
	<div id="titulo">
		<i>*Seleccione el neumático que se encuentra averiado:</i>
	</div>
	<div id="sep">
	<i>Buscar vehiculo por #:  </i>
		<?php 
		//echo CHtml::submitButton('Buscar',array("id"=>"boton","style"=>"float:right;margin-top:2px;margin-left:10px;")); 
		echo $form->dropDownList(new Vehiculo,'id',CHtml::listData(Vehiculo::model()->findAll('activo<>0'),'id','numeroUnidad'),array('id'=>'lista','prompt'=>'Seleccione ','style' => 'width:110px;float:right')); ?>
	</div>
	<?php echo $form->error($model,'idhistoricoCaucho'); ?>
	<?php $this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'vehi',
				'summaryText'=>'',
				//se deben definir inicialmente los neumaticos que posee cada vehiculo
			   // 'enableSorting' => false,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>1,
				'emptyText'=>'No hay registros',
				'selectionChanged'=>'setId',
                'dataProvider'=>$montados,
				'htmlOptions'=>array('style'=>'margin-top:-15px;float: left;width:100%;cursor:pointer;'),
				'columns'=>array(
				array(
					'class'=>'CCheckBoxColumn'
				),
				array(
					'type'=>"raw",
					'header'=>'Fecha de montaje',
					'value'=>'$data->fecha=="0000-01-01"?$data->porDefinir($data->fecha):date("d/m/Y",strtotime($data->fecha))',
					'name'=>'fecha',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
						'header'=>'Última falla',
						'value'=>'$data->diasUltimaFalla()',
						'htmlOptions'=>array('style'=>'text-align:center;'),
					),
				array(
					'header'=>'Eje',
					'value'=>'$data->iddetalleRueda==null?\' - \':$data->iddetalleRueda0->iddetalleEje0->idposicionEje0->posicionEje',
					'name'=>'iddetalleRueda',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Posición',
					'value'=>'$data->iddetalleRueda==null?\' - \':$data->iddetalleRueda0->idposicionRueda0->posicionRueda',
					'name'=>'iddetalleRueda',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				
				array(
					'type'=>'raw',
					'header'=>'Marca',
					'value'=>'$data->idmarcaCaucho==""?$data->porDefinir(""):$data->idmarcaCaucho0->nombre',
					'name'=>'idmarcaCaucho',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				
				array(
					'header'=>'Detalle',
					'value'=>'$data->idcaucho0->idmedidaCaucho0->medida.\' R\'.$data->idcaucho0->idrin0->rin.\' \'.$data->idcaucho0->idpiso0->piso',
					'name'=>'idcaucho',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'type'=>"raw",
					'header'=>'Serial',
					'value'=>'$data->serial=="0"?$data->porDefinir($data->serial):strtoupper($data->serial);',
					'name'=>'serial',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'type'=>"raw",
					'headerHtmlOptions'=>array('style'=>'text-align:center;'),
					'header'=>'Estatus',
					'value'=>'$data->coloresEstatus($data)',
					'name'=>'idestatusCaucho',
					'htmlOptions'=>array('style'=>'text-align:center;font-weight: bold;'),
				),
			),
        ));?>
		
	<div class="row">
		<?php echo $form->hiddenField($model,'fechaRealizada',array('value'=>'0000-01-01')); ?>
	</div>
	
	<div id="conductor" class="row" style="display:none">
		<?php echo $form->labelEx($model,'idempleado'); ?>
		<?php echo $form->dropDownList($model,'idempleado',array(),array('style' => 'width:170px;')); ?>
		<?php echo $form->error($model,'idempleado'); ?>
	</div>
	<br>
	<div class="row">
		<?php //echo $form->labelEx($model,'comentario'); ?>
		<?php //echo $form->textArea($model,'comentario',array('size'=>60,'maxlength'=>100,'style'=>'width:98%;')); ?>
		
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model,'idhistoricoCaucho'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->hiddenField($model,'idaccionCaucho',array('value'=>3)); ?>
	</div>

		<?php echo $form->hiddenField($model,'idestatus',array("value"=>8)); ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Registrar avería'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>

$("#lista").change(function(){
	$.fn.yiiGridView.update('vehi',{ data : "idvehiculo="+$(this).val()});
	obtenerConductor($(this).val());
});
function obtenerConductor(id){
	$('#conductor').show();
	if(id==""){
		$('#conductor').hide();
		id=0;
	}
		
	var dir="<?php echo Yii::app()->baseUrl;?>"+"/mttoCorrectivo/AjaxObtenerConductor/";
	$.ajax({  		
          url: dir+id,
        })
  	.done(function(result) {    	
    	     $('#Detalleeventoca_idempleado').html(result);
  	});	
}

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
	$("#Detalleeventoca_fechaFalla").datepicker({
		onSelect: function(selected){

		}
});
function setId(){
	var id=$.fn.yiiGridView.getSelection('vehi');
	$("#Detalleeventoca_idhistoricoCaucho").val(id);
}
</script>

