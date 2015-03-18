<?php
/* @var $this VehiculoController */
/* @var $model Vehiculo */
/* @var $form CActiveForm */

?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'vehiculo-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'idgrupo'); ?>
		<?php echo $form->dropDownList($model,'idgrupo',CHtml::listData(Grupo::model()->findAll(array('order' => 'id ASC')), 'id', 'grupo'),
		array(
			'ajax'=>array(
			'type'=>'GET',
			'url'=>CController::createUrl('Vehiculo/Getdatos'),
			'data'=>'js:"id="+$(this).val()',
			'dataType'=>'json',
			'success'=>"js:prueba",
			),'prompt'=>'Seleccione: ')
		); ?>
		<?php echo CHtml::link('<img src='.Yii::app()->baseUrl.'/imagenes/agregar.png alt="algo"/>',"",array('title'=>'Registrar un nuevo grupo de vehiculos',
        'style'=>'cursor: pointer;',
        'onclick'=>"{
		nuevo('Crear un nuevo grupo de vehiculos','/grupo/nuevoGrupo','/grupo/actualizarListaGrupo','#Vehiculo_idgrupo');}"));?>
		
		<?php echo $form->error($model,'idgrupo'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'numeroUnidad'); ?>
		<?php echo $form->textField($model,'numeroUnidad',array('maxlength'=>4,'style'=>'width:50px')); ?>
		<?php echo $form->error($model,'numeroUnidad'); ?>
	</div>

<div class="row">
		<?php echo $form->labelEx($model,'KmInicial'); ?>
		<?php echo $form->textField($model,'KmInicial',array('maxlength'=>7,'style'=>'width:70px')); ?>
		<?php echo $form->error($model,'KmInicial'); ?>
	</div>
	

		
	<div class="row">
		<?php echo $form->labelEx($model,'serialCarroceria'); ?>
		<?php echo $form->textField($model,'serialCarroceria',array('size'=>45,'maxlength'=>15,'style'=>'width:120px')); ?>
		<?php echo $form->error($model,'serialCarroceria'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'serialMotor'); ?>
		<?php echo $form->textField($model,'serialMotor',array('size'=>45,'maxlength'=>15,'style'=>'width:120px')); ?>
		<?php echo $form->error($model,'serialMotor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'placa'); ?>
		<?php echo $form->textField($model,'placa',array('size'=>10,'maxlength'=>8,'style'=>'width:70px')); ?>
		<?php echo $form->error($model,'placa'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'anno'); ?>
		<?php echo $form->textField($model,'anno',array('size'=>4,'maxlength'=>4,'style'=>'width:40px')); ?>
		<?php echo $form->error($model,'anno'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nroPuestos'); ?>
		<?php echo $form->textField($model,'nroPuestos',array('size'=>10,'maxlength'=>3,'style'=>'width:50px')); ?>
		<?php echo $form->error($model,'nroPuestos'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($marca,'marca'); ?>
		<?php echo $form->dropDownList($marca,'id',CHtml::listData(Marca::model()->findAll(array('order' => 'id ASC')), 'id', 'marca'),
		array(
			'ajax'=>array(
			'type'=>'POST',
			'url'=>CController::createUrl('Vehiculo/Selectdos'),
			'update'=>'#'.CHtml::activeId($model,'idmodelo'),
			)
			,'prompt'=>'Seleccione: ')); 
			
			?>
			<?php echo CHtml::link('<img src='.Yii::app()->baseUrl.'/imagenes/agregar.png alt="algo"/>',"",array('title'=>'Registrar una marca nueva',
        'style'=>'cursor: pointer;',
        'onclick'=>"{
		nuevo('Registrar una nueva marca','/marca/nuevaMarca','/marca/actualizarListaMarca','#Marca_id');}"));?>
		
		<?php echo $form->error($marca,'id'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'idmodelo'); ?>
		<?php echo $form->dropDownList($model,'idmodelo',array(),array('prompt'=>'Seleccione marca ')); ?>
		<?php echo CHtml::link('<img src='.Yii::app()->baseUrl.'/imagenes/agregar.png alt="algo"/>',"",array('title'=>'Registrar un nuevo grupo de vehiculos',
        'style'=>'cursor: pointer;',
        'onclick'=>"{
		nuevo('Crear un nuevo grupo de vehiculos','/grupo/nuevoGrupo','/grupo/actualizarListaGrupo','#Vehiculo_idgrupo');}"));?>
		
		<?php echo $form->error($model,'idmodelo'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'idcombustible'); ?>
		<?php echo $form->dropDownList($model,'idcombustible',CHtml::listData(Tipocombustible::model()->findAll(),'id','combustible'),array('id'=>'combustible')); ?>
		<?php echo CHtml::link('<img src='.Yii::app()->baseUrl.'/imagenes/agregar.png alt="algo"/>',"",array('title'=>'Registrar un nuevo combustible',
        'style'=>'cursor: pointer;',
        'onclick'=>"{
		nuevoModelo();}"));?>
		
		<?php echo $form->error($model,'idcombustible'); ?>
	</div>
<div class="row">
		<?php echo $form->labelEx($model,'idcolor'); ?>
		<?php echo $form->dropDownList($model,'idcolor',CHtml::listData(Color::model()->findAll(),'id','color'),array('id'=>'color')); ?>
		
		<?php echo CHtml::link('<img src='.Yii::app()->baseUrl.'/imagenes/agregar.png alt="algo"/>',"",array('title'=>'Registrar un nuevo grupo de vehiculos',
        'style'=>'cursor: pointer;',
        'onclick'=>"{
		nuevo();}"));?>
		
		<?php echo $form->error($model,'idcolor'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'idpropiedad'); ?>
		<?php echo $form->dropDownList($model,'idpropiedad',CHtml::listData(Propiedad::model()->findAll(),'id','propiedad'),array('id'=>'propiedad')); ?>
		
		<?php echo CHtml::link('<img src='.Yii::app()->baseUrl.'/imagenes/agregar.png alt="algo"/>',"",array('title'=>'Registrar un nuevo grupo de vehiculos',
        'style'=>'cursor: pointer;',
        'onclick'=>"{
		nuevo();}"));?>
		
		<?php echo $form->error($model,'idpropiedad'); ?>
	</div>
	<div class="row">
		
		<?php echo $form->hiddenField($model,'fechaRegistro'); ?>
		
	</div>
	

	
	<div class="row">
		<?php echo $form->labelEx($model,'comentario'); ?>
		<?php echo $form->textArea($model,'comentario',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'comentario'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Registrar' : 'Actualizar'); ?>
	</div>
	
<?php
/*ventana agregar actividad*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'nuevo',
    'options'=>array(
        //'title'=>$titulo,
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>360,
		
        //'height'=>480,
		'resizable'=>false,	
		'position'=>array(null,130),
    ),
));?>
<div class="divForForm"></div>
 
<?php $this->endWidget();?>

<?php
/*ventana agregar actividad*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'tipo',
    'options'=>array(
        //'title'=>$titulo,
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>360,
		
        //'height'=>480,
		'resizable'=>false,	
		'position'=>array(null,130),
    ),
));?>
<div class="tipoVeh"></div>
 
<?php $this->endWidget();?>



</div><!-- form -->
<script>
var titulo,dir1,dir2,id;

function tipo(tit,dirA,dirB,id1){
	if(!dirA==""){
		titulo=tit;
		dir1=dirA;
		dir2=dirB;
		id=id1;
	}
$("#tipo").dialog("option","title", titulo);
$('#tipo').dialog('open');
	jQuery.ajax({
                url: "<?php echo Yii::app()->baseUrl;?>"+dir1,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        $('#tipo div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        $('#tipo div.divForForm form').submit(tipo);
                                }
                                else{
                                        $('#tipo div.divForForm').html(data.div);
                                        setTimeout("$('#tipo').dialog('close') ",1000);
										actualizarLista("<?php echo Yii::app()->baseUrl;?>"+dir2,id);
                                }
                },
                'cache':false});
    return false; 
}


function nuevo(tit,dirA,dirB,id1){
	if(!dirA==""){
		titulo=tit;
		dir1=dirA;
		dir2=dirB;
		id=id1;
	}
$("#nuevo").dialog("option","title", titulo);
$('#nuevo').dialog('open');
	jQuery.ajax({
                url: "<?php echo Yii::app()->baseUrl;?>"+dir1,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        $('#nuevo div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        $('#nuevo div.divForForm form').submit(nuevo);
                                }
                                else{
                                        $('#nuevo div.divForForm').html(data.div);
                                        setTimeout("$('#nuevo').dialog('close') ",1000);
										actualizarLista("<?php echo Yii::app()->baseUrl;?>"+dir2,id);
                                }
                },
                'cache':false});
    return false; 
}
function actualizarLista(dir,id){
	$.ajax({  		
          url: dir,
        })
  	.done(function(result) {    	
    	     $(id).html(result);
			 $(id).change();
			 
  	});
}
</script>

<?php $this->endWidget(); ?>
<?php

Yii::app()->clientScript->registerScript("update","
    function prueba(data, textStatus, jqXHR){
		if(data.data==null){	
			$('#Vehiculo_anno').val('');
			$('#Vehiculo_nroPuestos').val('');
			$('#Marca_id').val('').change();
			$('#combustible').val('');
			$('#color').val('');
			$('#propiedad').val('');
		}else{
		$('#Vehiculo_idgrupo').val(data.data.idgrupo);
        $('#Vehiculo_anno').val(data.data.anno);
		$('#Vehiculo_nroPuestos').val(data.data.nroPuestos);
		
		
		$('#combustible').val(data.data.idcombustible);
		$('#color').val(data.data.idcolor);
		$('#propiedad').val(data.data.idpropiedad);
		$('#Marca_id').val(data.idmarca).change();
		}		
	}
");
?>
