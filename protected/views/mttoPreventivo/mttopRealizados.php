<?php 
$this->breadcrumbs=array(
	'Mantenimiento preventivo'=>array('mttoPreventivo/index'),
	$nom=>array($dir),
	'Actualizar órden de mantenimiento',
);
	$this->menu=array(
	array('label'=>'<div id="menu"><strong>Opciones de orden</strong></div>'),
	array('label'=>'      Detalle de orden', 'url'=>array('mttoPreventivo/vistaPrevia/'.$id.'?nom='.$nom.'&dir='.$dir.'')),
	array('itemOptions'=>array('id' => 'mActualizar'),'label'=>'      Actualizar orden', 'url'=>array('mttoPreventivo/mttopRealizados/'.$id.'?nom='.$nom.'&dir='.$dir.'')),
	array('label'=>'      Registrar facturación', 'url'=>array('mttoPreventivo/registrarFacturacion/'.$id.'?nom='.$nom.'&dir='.$dir.'')),

	array('label'=>'<div id="menu"><strong>Órdenes de mantenimiento</strong></div>'),
	array('label'=>'      Crear orden de mantenimiento', 'url'=>array('mttoPreventivo/crearOrdenPreventiva') ,'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_crearOrdenPreventiva')),
	array('label'=>'      Ver ordenes abiertas <span class="badge badge-'.$Colorabi.' pull-right">'.$abiertas.'</span>', 'url'=>array('mttoPreventivo/verOrdenes') ,'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_verOrdenes')),
	array('label'=>'      Ordenes listas para cerrar <span class="badge badge-'.$Colorli.' pull-right">'.$listas.'</span>', 'url'=>array('mttoPreventivo/cerrarOrdenes'),'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_cerrarOrdenes')),
	
);
?>
<div class='crugepanel user-assignments-role-list'>
	<h1>Actualizar orden de mantenimiento</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'ordenes',
				'summaryText'=>'',
			   // 'enableSorting' => false,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>0,
				'emptyText'=>'',
                'dataProvider'=>$orden,
				//'afterAjaxUpdate'=>'recargar',
				//'htmlOptions'=>array('style'=>'cursor:pointer'),
				'columns'=>array(
				array(
					'headerHtmlOptions'=>array('style'=>'width:7%'),
					'header'=>'Orden #',
					//'name'=>'id',
					'value'=>'str_pad((int) $data->id,6,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:150px'),
				),
				
				array(
					'header'=>'Fecha y hora',
					//'name'=>'fecha',
					'value'=>'date("d/m/Y h:i A",strtotime($data->fecha))',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px'),
				),
				array(
					'type'=>'raw',
					'header'=>'Estado',
					//'name'=>'idestatus',
					'value'=>'$data->color($data->idestatus,$data->idestatus0->estatus)',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px'),
				),
				array(
					'header'=>'Coordinador operativo',
					'name'=>'cOperativo',
					'value'=>'$data->cOperativo0->nombre.\'  \'.$data->cOperativo0->apellido',
					'htmlOptions'=>array('style'=>'text-align:center;width:80px'),
				),
				array(
					'header'=>'Coordinador de transporte',
					'name'=>'cTaller',
					'value'=>'$data->cTaller0->nombre.\'  \'.$data->cTaller0->apellido',
					'htmlOptions'=>array('style'=>'text-align:center;width:80px'),
				),
				array(
					'header'=>'Taller asignado',
					'name'=>'taller',
					'value'=>'$data->taller0->nombre',
					'htmlOptions'=>array('style'=>'text-align:center;width:80px'),
				),
				array(
						'headerHtmlOptions'=>array('style'=>'text-align:left;width:10px;text-align:center;'),
						'htmlOptions'=>array('style'=>'text-align:center;width:10px;'),
						'header'=>'Registrar facturación',
						'type'=>'raw',
						'value'=>'CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
										  
                        Yii::app()->createUrl("mttoPreventivo/registrarFacturacion", array("id"=>$data->id,"nom"=>"'.$nom.'","dir"=>"'.$dir.'")),
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                        )
                );',),
				array(
					'header'=>'Lista para cerrar',
					'value'=>'CHTML::checkBox("campo",$data->estado($data->idestatus),array(\'id\'=>"campo1",\'width\'=>4,\'maxlength\'=>2,\'onchange\'=>"return validar($data->id)"))',
					'type'=>'raw',
					'htmlOptions'=>array('style'=>'width: 50px;text-align: center'),
				),
			)
        ));?>
	</div>
<div class='crugepanel user-assignments-role-list'>
<strong><p>Listado de actividades a realizar:</p></strong>
	<?php
	$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'final',
				'selectableRows'=>0,
				'summaryText'=>'',
			    'enableSorting' => true,
				'emptyText'=>'no existen mantenimientos preventivos registrados',
                'dataProvider'=>$dataProvider,
				'columns'=>array(
				array(
					'header'=>'Unidad',
					'name'=>'idvehiculo',
					'value'=>'str_pad((int) $data->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT)',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px;'),
				),
				array(
					//'headerHtmlOptions'=>array('style'=>'width:7%'),
					'header'=>'Placa',
					'name'=>'idplan',
					'value'=>'$data->idvehiculo0->placa',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px'),
				),
				array(
					//'headerHtmlOptions'=>array('style'=>'width:7%'),
					'header'=>'Marca',
					'name'=>'idplan',
					'value'=>'$data->idvehiculo0->idmodelo0->idmarca0->marca',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:80px'),
				),
				array(
					//'headerHtmlOptions'=>array('style'=>'width:7%'),
					'header'=>'Modelo',
					'name'=>'idplan',
					'value'=>'$data->idvehiculo0->idmodelo0->modelo',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:80px'),
				),
				array(
					'header'=>'Actividad',
					'name'=>'idactividadMtto',
					'value'=>'$data->idactividadMtto0->actividad',
					'htmlOptions'=>array('style'=>'text-align:center;width:180px;'),
				),
				array(
					'header'=>'Prioridad',
					'name'=>'idprioridad',
					'value'=>'$data->idprioridad0->prioridad',
					'htmlOptions'=>array('style'=>'width:50px;text-align:center;'),
				),
				array(
					'header'=>'Fecha de realizada',
					'name'=>'fechaRealizada',
					'type'=>'raw',
					'value'=>'($data->textoFecha()).CHtml::link(
                     CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{registrarMR("\'.Yii::app()->createUrl("actividades/actualizarMR",array("id"=>$data["id"])).\'"); $("#dialog").dialog("open");}\'
                        )
                )',
					'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
				),
				/*array(
					'header'=>'Kilometraje al realizarla',
					'name'=>'kmRealizada',
					'type'=>'raw',
				
					'value'=>'number_format($data->valores($data->kmRealizada))?number_format($data->kmRealizada).\' Km \':$data->noasignado()',
					'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
				),*/
				/*array(
					'header'=>'Tiempo de paro',
					'name'=>'duracion',
					'type'=>'raw',
					'value'=>'$data->duracion.\' \'.$data->idtiempod0->tiempo',
					'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
				),*/
				/*array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;'),
					'htmlOptions'=>array('style'=>'text-align:center;'),
					'header'=>'Registrar mantenimiento',
					'type'=>'raw',
					'value'=>'CHtml::link(
                     CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{registrarMR("\'.Yii::app()->createUrl("actividades/actualizarMR",array("id"=>$data["id"])).\'"); $("#dialog").dialog("open");}\'
                        )
                );',),*/
				array(
					'header'=>'Estado',
					'name'=>'idestatus',
					'type'=>'raw',
					'value'=>'$data->color($data->idestatus,$data->idestatus0->estatus)',
					'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
				),
			)
        ));
?>
</div>
<?php
/*ventana agregar informacion*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'dialog',
    'options'=>array(
        'title'=>'Registrar mantenimiento realizado',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>400,
        //'height'=>255,
		'resizable'=>false,
		'position'=>array(null,100),
    ),
));?>
<div class="divForForm"></div>
 
<?php $this->endWidget();?>

 
<script>
var idorden="<?php echo $id;?>";
actualizarCheck(idorden);
function actualizarCheck(idorden){	
var dir="<?php echo Yii::app()->baseUrl."/mttoPreventivo/actualizarCheck"?>";	
		jQuery.ajax({
                url: dir+"/"+idorden,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
				'success':function(data){
					if(data.estado==0)
						$('#campo1').attr('disabled',true);
						else
						$('#campo1').attr('disabled',false);
				},
                'cache':false});
}

var Uurl;
function registrarMR(id){
var dias="<?php echo $dias;?>";
	 if (typeof(id)=='string')
                Uurl=id;
	jQuery.ajax({
                url: Uurl,
                'data':$(this).serialize()+"&dias="+dias,
                'type':'post',
                'dataType':'json',
                'success':function(data)
                        {
                                if (data.status == 'failure')
                                {
                                        $('#dialog div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        $('#dialog div.divForForm form').submit(registrarMR); // updatePaymentComment
                                }
                                else
                                {
                                        $('#dialog div.divForForm').html(data.div);
                                        setTimeout("$('#dialog').dialog('close') ",000);
                                        $.fn.yiiGridView.update('final');
										actualizarCheck(idorden);
                                }
                        } ,
                'cache':false});
    return false; 
}
function recargar(){
	window.location.replace("<?php echo Yii::app()->baseUrl."/mttoPreventivo/verOrdenes"?>");	
}
function validar(id){

//var id="<?php echo $id?>";
	var dir="<?php echo Yii::app()->baseUrl."/mttoPreventivo/estatusOrden"?>";
	var y = document.getElementById("campo1").checked;
	if(y==true){
		if(confirm('Confirma que desea poner la orden como lista?')){
			x=1;
			
		}else{
			x=0;
			y=false;
		}	
	}else
		x=0;
	jQuery.ajax({
                url: dir+"/"+x,
                'data':$(this).serialize()+ '&id=' + id,
                'type':'post',
                'dataType':'json',
				'success':function(){
					if(x==1)
						recargar();
				},
                'cache':false});		
				
	$.fn.yiiGridView.update('ordenes');
}
var url="<?php echo Yii::app()->controller->action->id;?>";
if(url=="mttopRealizados")
	$("#mActualizar").addClass("active");
</script>