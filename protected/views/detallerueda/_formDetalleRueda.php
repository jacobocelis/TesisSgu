<?php
/* @var $this DetalleruedaController */
/* @var $model Detallerueda */
/* @var $form CActiveForm */
?>

<div id="azul"class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'detallerueda-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> obligatorios.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'idposicionRueda'); ?>
		<?php echo $form->dropDownList($model,'idposicionRueda',CHtml::listData(Posicionrueda::model()->findAll(),'id','posicionRueda'),array('style' => 'width:150px;'));  echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Nueva posición caucho")), "",array('title'=>'Agregar posición',
        'style'=>'cursor: pointer;font-size:13px;',
        'onclick'=>"{
		nuevaPosCaucho();}"));?>
		<?php echo $form->error($model,'idposicionRueda'); ?>
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model,'iddetalleEje',array("value"=>$idEje)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idcaucho'); ?>
		<?php 
		
		$models = Caucho::model()->findAll();
		$data = array();
		
		foreach ($models as $mode){
			$piso=Piso::model()->findByPk($mode->idpiso);
			$rin=Rin::model()->findByPk($mode->idrin);
			$medida=Medidacaucho::model()->findByPk($mode->idmedidaCaucho);
			$data[$mode->id] = $medida->medida . ' '. $rin->rin .' '.$piso->piso; 
		}
		
		echo $form->dropDownList($model,'idcaucho',$data,array('style' => 'width:240px;'));  echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Nueva medida")), "",array('title'=>'Agregar medida',
        'style'=>'cursor: pointer;font-size:13px;',
        'onclick'=>"{
		nuevaMedCaucho();}"));?>
		<?php echo $form->error($model,'idcaucho'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Agregar' : 'Guardar'); ?>
	</div>
 
		
<?php $this->endWidget(); ?>

</div><!-- form -->
<style>
#azul {
    background: none repeat scroll 0% 0% #F9FDFD;
    padding: 5px;
    border: 1px solid #94A8FF;
    margin-top: 5px;
}
</style>
 <script>
 function actualizarListaMedCaucho(){

var dir="<?php echo Yii::app()->baseUrl;?>"+"/neumaticos/actualizarListaMedCaucho";
	$.ajax({  		
          url: dir,
        })
  	.done(function(result) {    	
    	     $('#Detallerueda_idcaucho').html(result);
  	});
	
}
 function actualizarListaPosCaucho(){

var dir="<?php echo Yii::app()->baseUrl;?>"+"/neumaticos/actualizarListaPosCaucho";
	$.ajax({  		
          url: dir,
        })
  	.done(function(result) {    	
    	     $('#Detallerueda_idposicionRueda').html(result);
  	});
	
}
 function nuevaMedCaucho(){

	$('#nuevaMedCaucho').dialog('open');
	
	jQuery.ajax({
                url: "<?php echo Yii::app()->baseUrl;?>"+"/Caucho/agregar/",
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        $('#nuevaMedCaucho div.divForForm').html(data.div);
                                        $('#nuevaMedCaucho div.divForForm form').submit(nuevaMedCaucho);
                                }
                                else{
                                        $('#nuevaMedCaucho div.divForForm').html(data.div);
                                        $('#nuevaMedCaucho').dialog('close');
                                        actualizarListaMedCaucho();
	
                                }
                },
                'cache':false});
    return false; 
}
 function nuevaPosCaucho(){

	$('#nuevaPosCaucho').dialog('open');
	
	jQuery.ajax({
                url: "<?php echo Yii::app()->baseUrl;?>"+"/Posicionrueda/agregar/",
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        $('#nuevaPosCaucho div.divForForm').html(data.div);
                                        $('#nuevaPosCaucho div.divForForm form').submit(nuevaPosCaucho);
                                }
                                else{
                                        $('#nuevaPosCaucho div.divForForm').html(data.div);
                                        $('#nuevaPosCaucho').dialog('close');
                                        actualizarListaPosCaucho();
										
										
                                }
                },
                'cache':false});
    return false; 
}
 </script>