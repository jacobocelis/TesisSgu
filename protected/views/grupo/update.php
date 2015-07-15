<?php
/* @var $this GrupoController */
/* @var $model Grupo */

$this->breadcrumbs=array(
	'Vehiculos'=>array('vehiculo/index'),
	'Grupos registrados'=>array('index'),
	$model->grupo=>array('view','id'=>$model->id),
	'Editar',
);

$this->menu=array(
	array('label'=>'<div id="menu"><strong>Opciones de grupo</strong></div>' , 'visible'=>'1'),
	array('label'=>'Ver detalle', 'url'=>array('grupo/view', 'id'=>$model->id)),
	array('label'=>'Editar grupo', 'url'=>array('grupo/update', 'id'=>$model->id)),
	array('label'=>'Eliminar grupo', 'url'=>'' ,'linkOptions'=>array('confirm'=>'¿Confirma que desea eliminar el grupo?','onclick'=>'eliminar('.$model->id.')','style'=>'cursor:pointer;background:#FFE0E1;'), 'visible'=>Yii::app()->user->checkAccess('action_grupo_delete')),
	//array('label'=>'Administrar grupo', 'url'=>array('admin')),
);

?>
<div class='crugepanel user-assignments-role-list'>

<h1>Editar grupo</h1>

<?php 
/*echo CHtml::link(
    CHtml::image(Yii::app()->request->baseUrl."/imagenes/montar.png",
                                          "Agregar",array("title"=>"Montar neumático")), 
    "",
    array('class'=>'linkClass','onclick'=>'doSomething();', 'style'=>'cursor: pointer;')
);*/
$this->renderPartial('_form', array('model'=>$model)); ?>
</div>
<script>
function eliminar(id){
var dir="<?php echo Yii::app()->baseUrl;?>"+"/grupo/delete/";
	$.ajax({  		
			 type: 'POST',
          url: dir+id+'?ajax=ajax',
        })
  	.done(function(result) {    	
			if(result!="")
    	     alert(result);
			if(result=="")
				window.location.replace("<?php echo Yii::app()->baseUrl."/grupo/index"?>");
  	});
}
</script>