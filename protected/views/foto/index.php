<?php
/* @var $this FotoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Vehiculos'=>array('/vehiculo/index'),
	'Unidad '.$vehiculo->numeroUnidad=>array('/vehiculo/view','id'=>$vehiculo->id),
	'Fotos',
);
$this->menu=array(
	array('label'=>'<div id="menu"><strong>Opciones de vehiculo</strong></div>' , 'visible'=>'1'),
	array('label'=>'Ficha técnica', 'url'=>array('vehiculo/view', 'id'=>$model->id)),
	array('label'=>'Editar vehiculo', 'url'=>array('vehiculo/update', 'id'=>$vehiculo->id)),
	array('label'=>'Agregar fotografía', 'url'=>array('foto/index', 'id'=>$vehiculo->id)),
	
	//array('label'=>'<div id="menu"><strong>Operaciones</strong></div>' , 'visible'=>'1'),
	array('label'=>'Desincorporar vehiculo', 'url'=>array('vehiculo/desincorporar', 'id'=>$vehiculo->id) ,'linkOptions'=>array('style'=>'cursor:pointer;cursor:pointer;background:#FFE0E1;') , 'visible'=>Yii::app()->user->checkAccess('action_vehiculo_desincorporar')),
	
	//array('label'=>'Eliminar vehiculo', 'url'=>'' ,'linkOptions'=>array('confirm'=>'¿Confirma que desea eliminar el vehiculo?','onclick'=>'eliminar('.$model->id.')','style'=>'cursor:pointer;background:#FFE0E1;')),
);
?>
<div class='crugepanel user-assignments-role-list'>
<h1>Agregar una foto al vehiculo # <?php echo $vehiculo->numeroUnidad; ?></h1>

<?php 
echo $this->renderPartial('_form', array('model'=>$model,'vehiculo'=>$vehiculo)); ?>

</div>
<div class='crugepanel user-assignments-role-list'>
<h1>Fotos del vehiculo # <?php echo $vehiculo->numeroUnidad; ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'htmlOptions'=>array('style'=>'max-width:60%'),
)); ?>
</div>
<style>
	.view img{
		width: 100%;
	}
	.btn-right{
		clear: both;
		width: 100%;
		padding-top: 10px;
		text-align: right;
	}
</style>
<script>
var idveh="<?php echo $vehiculo->id;?>";
foto();
function foto(){
	var dir="<?php echo Yii::app()->baseUrl."/foto/create/"?>";
	jQuery.ajax({
                url: dir+idveh,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        $('#fotoNueva').html(data.div);
                                        $('#fotoNueva form').submit(foto); 
                                }
                                else{
                                        $('#fotoNueva').html(data.div);
                                        setTimeout("$('#viaje').dialog('close') ",1000);
                                        $.fn.yiiGridView.update('viajes');
										
                                }
                        },
                'cache':false});
    return false; 
}
function eliminar(id){
var dir="<?php echo Yii::app()->baseUrl;?>"+"/vehiculo/delete/";
	$.ajax({  		
			 type: 'POST',
          url: dir+id+'?ajax=ajax',
        })
  	.done(function(result) {    	
			if(result!="")
    	     alert(result);
			if(result=="")
				window.location.replace("<?php echo Yii::app()->baseUrl."/vehiculo/index"?>");
  	});
}
</script>