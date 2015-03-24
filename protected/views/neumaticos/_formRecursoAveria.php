<?php
/* @var $this DetreccauchoController */
/* @var $model Detreccaucho */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'detreccaucho-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span>obligatorios.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'idrecursoCaucho'); ?>
		<?php echo $form->dropDownList($model,'idrecursoCaucho',CHtml::listData(Recursocaucho::model()->findAll(),'id','recurso'),array('style' => 'width:250px;')); echo CHtml::link('(+)', "", array('id'=>'regis','title'=>'Agregar un nuevo recurso','style'=>'cursor: pointer; text-decoration: underline;','onclick'=>"{nuevoRecurso(); }"));?>
		<?php echo $form->error($model,'idrecursoCaucho'); ?>
	</div>
	
	<div id="nuevo"></div>
	
	<div id="cantidad"class="row">
		<?php echo $form->labelEx($model,'cantidad'); ?>
		<?php echo $form->textField($model,'cantidad',array('style' => 'width:50px;')); ?>
		<?php echo $form->dropDownList($model,'idunidad',CHtml::listData(Unidad::model()->findAll(),'id','corto'),array('style' => 'width:100px;'));
		?>
		<?php echo $form->error($model,'cantidad'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'costoUnitario'); ?>
		<?php echo $form->textField($model,'costoUnitario',array('style' => 'width:100px;','value'=>$model->costoUnitario<=0?'':$model->costoUnitario)); ?> Bs. 
		<?php echo $form->error($model,'costoUnitario'); ?>
	</div>
	<div class="row">
		
		<?php echo $form->hiddenField($model,'costoTotal'); ?>
		
	</div>

	<div class="row">
		
		<?php echo $form->hiddenField($model,'iddetalleEventoCa',array("value"=>$id)); ?>
			
	</div>

	<div id="buton"class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Agregar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<style>

#titulo{
	font-family: "Carrois Gothic",sans-serif;
    font-size: 26px;
	font-weight: bold;
	color: inherit;
	text-rendering: optimizelegibility;
	margin: 10px 0px;
}
</style>
<script>
$("#detreccaucho-form").submit(function(event){
	event.preventDefault();
	total();
});
function total(){
	var cantidad=$("#Detreccaucho_cantidad").val();
	var costo=$("#Detreccaucho_costoUnitario").val();
	var total=(parseFloat(cantidad) * parseFloat(costo));
	$("#Detreccaucho_costoTotal").val(total);

}
</script>
<script>
//nuevoRecurso();
function nuevoRecurso(){
	$('#regis').hide();
	$('#cantidad').hide();
	$('#buton').hide();
	$('#nuevo').show();
	var dir="<?php echo Yii::app()->baseUrl;?>"+"/neumaticos/nuevoRec";
	jQuery.ajax({
                url: dir,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
										$('#nuevo').html(data.div);
                                        $('#nuevo  form').submit(nuevoRecurso);
                                }
                                else{
                                        $('#nuevo form').html(data.div);
                                        setTimeout("$('#nuevo').hide(); ",0);
										$('#regis').show();
										$('#cantidad').show();
										$('#buton').show();
										actualizarListaRecursos();
                                }
                        },
                'cache':false});
    return false; 
}
function actualizarListaRecursos(){
var dir="<?php echo Yii::app()->baseUrl;?>"+"/neumaticos/actualizarListaRecursos";
	$.ajax({  		
          url: dir,
        })
  	.done(function(result) {    	
    	     $('#Detreccaucho_idrecursoCaucho').html(result);
  	});
}
</script>