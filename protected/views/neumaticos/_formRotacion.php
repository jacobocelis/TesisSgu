<?php
/* @var $this DetalleeventocaController */
/* @var $model Detalleeventoca */
/* @var $form CActiveForm */
?>

<div id="azulA"class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'detalleeventoca-formA',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<div class="row">
		<?php echo $form->hiddenField($model,'fechaFalla',array('size'=>10,'readonly'=>'readonly','value'=>date('d/m/Y'),'maxlength'=>8, 'style'=>'width:100px;cursor:pointer;')); ?>
	</div>
	
	<div class="row">
		<?php echo $form->hiddenField($model,'idfallaCaucho');?>
	</div>
	
	<div id="sepA">
	<i>Buscar vehiculo por #:  </i>
		<?php 
		//echo CHtml::submitButton('Buscar',array("id"=>"boton","style"=>"float:right;margin-top:2px;margin-left:10px;")); 
		echo $form->dropDownList(new Vehiculo,'id',CHtml::listData(Vehiculo::model()->findAll(),'id','numeroUnidad'),array('id'=>'listaA','prompt'=>'Seleccione ','style' => 'width:110px;float:left')); ?>
	</div>
	<?php echo $form->error($model,'idhistoricoCaucho'); ?>
	<?php $this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'vehicA',
				'summaryText'=>'',
				//se deben definir inicialmente los neumaticos que posee cada vehiculo
			   // 'enableSorting' => false,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>1,
				'emptyText'=>'No hay registros',
				//'afterAjaxUpdate'=>'setId1',
				'afterAjaxUpdate'=>'js:function(id,data){$("#botonRot").attr("disabled", true)}',
				'selectionChanged'=>'setId1',
                'dataProvider'=>$montadosR,
				'htmlOptions'=>array('style'=>'margin-top:-15px;float: left;margin-right:2%;width:40%;cursor:pointer;'),
				'columns'=>array(
				array(
					'class'=>'CCheckBoxColumn',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'type'=>"raw",
					'header'=>'Fecha de montaje',
					'value'=>'$data->fecha=="0000-01-01"?$data->porDefinir($data->fecha):date("d/m/Y",strtotime($data->fecha))',
					'name'=>'fecha',
					'htmlOptions'=>array('style'=>'text-align:center;width:5px'),
				),
				
				array(
					'header'=>'Eje',
					'value'=>'$data->iddetalleRueda==null?\' - \':$data->iddetalleRueda0->iddetalleEje0->idposicionEje0->posicionEje',
					'name'=>'iddetalleRueda',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'header'=>'Posición',
					'value'=>'$data->iddetalleRueda==null?\' - \':$data->iddetalleRueda0->idposicionRueda0->posicionRueda',
					'name'=>'iddetalleRueda',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'type'=>"raw",
					'headerHtmlOptions'=>array('style'=>'text-align:center;width:50px;'),
					'header'=>'Estatus',
					'value'=>'$data->coloresEstatus($data)',
					'name'=>'idestatusCaucho',
					'htmlOptions'=>array('style'=>'text-align:center;width:45px;font-weight: bold;'),
				),
			),
        ));?>
		<div id="sepB">
			<i>Buscar vehiculo por #:  </i>
		<?php 
		//echo CHtml::submitButton('Buscar',array("id"=>"boton","style"=>"float:right;margin-top:2px;margin-left:10px;")); 
		echo $form->dropDownList(new Vehiculo,'id',CHtml::listData(Vehiculo::model()->findAll(),'id','numeroUnidad'),array('id'=>'listaB','prompt'=>'Seleccione ','style' => 'width:110px;float:right')); ?>
	</div>
	<?php echo $form->error($model,'idhistoricoCaucho'); ?>
	<?php $this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'vehicB',
				'summaryText'=>'',
				//se deben definir inicialmente los neumaticos que posee cada vehiculo
			   // 'enableSorting' => false,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>1,
				'emptyText'=>'No hay registros',
				'selectionChanged'=>'setId1',
				'afterAjaxUpdate'=>'js:function(id,data){$("#botonRot").attr("disabled", true)}',
                'dataProvider'=>$montadosR,
				'htmlOptions'=>array('style'=>'margin-top:-15px;float: left;width:40%;cursor:pointer;'),
				'columns'=>array(
				array(
					'class'=>'CCheckBoxColumn',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'type'=>"raw",
					'header'=>'Fecha de montaje',
					'value'=>'$data->fecha=="0000-01-01"?$data->porDefinir($data->fecha):date("d/m/Y",strtotime($data->fecha))',
					'name'=>'fecha',
					'htmlOptions'=>array('style'=>'text-align:center;width:5px'),
				),
			
				array(
					'header'=>'Eje',
					'value'=>'$data->iddetalleRueda==null?\' - \':$data->iddetalleRueda0->iddetalleEje0->idposicionEje0->posicionEje',
					'name'=>'iddetalleRueda',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'header'=>'Posición',
					'value'=>'$data->iddetalleRueda==null?\' - \':$data->iddetalleRueda0->idposicionRueda0->posicionRueda',
					'name'=>'iddetalleRueda',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'type'=>"raw",
					'headerHtmlOptions'=>array('style'=>'text-align:center;width:50px;'),
					'header'=>'Estatus',
					'value'=>'$data->coloresEstatus($data)',
					'name'=>'idestatusCaucho',
					'htmlOptions'=>array('style'=>'text-align:center;width:45px;font-weight: bold;'),
				),
			),
        ));?>
		
	<div class="row">
		<?php echo $form->hiddenField($model,'fechaRealizada',array('value'=>'0000-01-01')); ?>
	</div>
	
	<div id="conductorA" class="row">		
		<?php echo $form->hiddenField($model,'idempleado',array('style' => 'width:170px;')); ?>
	</div>	
	<br>	
	<div class="row">
		<?php echo $form->hiddenField($model,'comentario',array('size'=>60,'maxlength'=>100,'style'=>'width:98%;')); ?>
		
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model,'idhistoricoCaucho'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->hiddenField($model,'idaccionCaucho',array('value'=>2)); ?>
	</div>

		<?php echo $form->hiddenField($model,'idestatus',array("value"=>8)); ?>

	
		<?php echo CHtml::ajaxSubmitButton('Agregar rotación', $this->createAbsoluteUrl('neumaticos/agregarNeumaticosRotar'), 
        array(	 'dataType' => 'json',
                 'type' => 'post',
				 'data'=>array("origen"=>"js:$.fn.yiiGridView.getSelection('vehicA')","destino"=>"js:$.fn.yiiGridView.getSelection('vehicB')"),
				 'success'=>'js:function(data){
					 alert(data.status);
					 $.fn.yiiGridView.update("vehicA");
					 $.fn.yiiGridView.update("rotaciones");
					 $("#arotar").hide();
					 $("#agregarRotacion").show();
					 $("#botonRot").attr("disabled", true);
				 }',
                ), array('id' => 'botonRot')) 
		?>
	<?php
		echo CHtml::link('Cancelar', "",array('title'=>'Cancelar',
        'style'=>'cursor: pointer;font-size:10px;float:right;',
        'onclick'=>"{cancelarA()}"));?>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
$('#botonRot').attr("disabled", true);
$('#conductorA').hide();
$("#listaA").change(function(){
	$.fn.yiiGridView.update('vehicA',{ data : "idvehiculo="+$(this).val()});
setId1();
});
$("#listaB").change(function(){
	$.fn.yiiGridView.update('vehicB',{ data : "idvehiculo="+$(this).val()});
setId1();
});
function cancelarA(){
	$('#arotar').hide();
	$('#agregarRotacion').show();
}
function setId1(){
	var id1=$.fn.yiiGridView.getSelection('vehicA');
	var id2=$.fn.yiiGridView.getSelection('vehicB');

	if(id1=="" || id2=="")
		$('#botonRot').attr("disabled", true);
	else
		$('#botonRot').attr("disabled", false);
	
	$("#Detalleeventoca_idhistoricoCaucho").val(id1);
}
</script>
<style>
#tituloA {
    float: left;
    font-size: 120%;
}
#sepA {
    text-align: left;
    font-size: 120%;
}
#tituloB {
    float: left;
    font-size: 120%;
}
#sepB {
    text-align: right;
    font-size: 120%;
}
#azulA {
    background: none repeat scroll 0% 0% #F9FDFD;
    padding: 10px;
    border: 1px solid #94A8FF;
    margin-top: 5px;
}
</style>