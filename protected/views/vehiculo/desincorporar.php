<?php
/* @var $this HistoricoedosController */
/* @var $model Historicoedos */

$this->breadcrumbs=array(
		'Vehiculos'=>array('/vehiculo/index'),
	'Unidad '.$vehiculo->numeroUnidad=>array('/vehiculo/view','id'=>$vehiculo->numeroUnidad),
	'Desincorporar',
);
$this->menu=array(
	array('label'=>'<div id="menu"><strong>Opciones de vehiculo</strong></div>' , 'visible'=>'1'),
	array('label'=>'Editar vehiculo', 'url'=>array('vehiculo/update', 'id'=>$vehiculo->id)),
	array('label'=>'Agregar fotografía', 'url'=>array('foto/index', 'id'=>$vehiculo->id)),
	
	array('label'=>'<div id="menu"><strong>Zona peligrosa</strong></div>' , 'visible'=>'1'),
	array('label'=>'Desincorporar vehiculo', 'url'=>array('vehiculo/desincorporar', 'id'=>$vehiculo->id) ,'linkOptions'=>array('style'=>'cursor:pointer;')),
	
	array('label'=>'Eliminar vehiculo', 'url'=>'' ,'linkOptions'=>array('confirm'=>'¿Confirma que desea eliminar el vehiculo?','onclick'=>'eliminar('.$vehiculo->id.')','style'=>'cursor:pointer;background:#FFE0E1;')),
);
?>
<div class='crugepanel user-assignments-role-list'>
<h1>Desincorporar el vehiculo</h1>
<?php $this->renderPartial('_formDesinco', array('model'=>$model,'vehiculo'=>$vehiculo->id)); ?>
</div>
<script>
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