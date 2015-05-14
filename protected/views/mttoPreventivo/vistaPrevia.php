<style>
.grid-view {
    padding: 0px 0px;
}
</style>
<?php 
	$this->breadcrumbs=array(
	'Mantenimiento preventivo'=>array('mttoPreventivo/index'),
	$nom=>array($dir),
	'Detalle de orden',
);
$this->menu=array(
	array('label'=>'<div id="menu"><strong>Opciones de orden</strong></div>'),
	array('label'=>'      Detalle de orden', 'url'=>array('mttoPreventivo/vistaPrevia/'.$idOrden.'?nom='.$nom.'&dir='.$dir.'')),
	array('label'=>'      Actualizar orden', 'url'=>array('mttoPreventivo/mttopRealizados/'.$idOrden.'?nom='.$nom.'&dir='.$dir.''),'visible'=>Yii::app()->controller->estatusOrden($idOrden)<>7),
	array('label'=>'      Registrar facturación', 'url'=>array('mttoPreventivo/registrarFacturacion/'.$idOrden.'?nom='.$nom.'&dir='.$dir.''),'visible'=>Yii::app()->controller->estatusOrden($idOrden)<>7),

	array('label'=>'<div id="menu"><strong>Ordenes de mantenimiento</strong></div>'),
	array('label'=>'      Crear orden de mantenimiento', 'url'=>array('mttoPreventivo/crearOrdenPreventiva') ,'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_crearOrdenPreventiva')),
	array('label'=>'      Ver ordenes abiertas <span class="badge badge-'.$Colorabi.' pull-right">'.$abiertas.'</span>', 'url'=>array('mttoPreventivo/verOrdenes') ,'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_verOrdenes')),
	array('label'=>'      Ordenes listas para cerrar <span class="badge badge-'.$Colorli.' pull-right">'.$listas.'</span>', 'url'=>array('mttoPreventivo/cerrarOrdenes'),'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_cerrarOrdenes')),
	
);
?>
<div class='crugepanel user-assignments-role-list'>
	<h1>Detalle de orden de mantenimiento</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'factura',
				'summaryText'=>'',
			   // 'enableSorting' => false,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>0,
				'emptyText'=>'',
                'dataProvider'=>$orden,
				//'htmlOptions'=>array('style'=>'cursor:pointer'),
				'columns'=>array(
				array(
					'headerHtmlOptions'=>array('style'=>''),
					'header'=>'Orden #',
					//'name'=>'id',
					'value'=>'str_pad((int) $data->id,6,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:170px'),
				),
				array(
					'header'=>'Fecha y hora',
					//'name'=>'fecha',
					'value'=>'date("d/m/Y h:i A",strtotime($data->fecha))',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'type'=>'raw',
					'header'=>'Estado',
					//'name'=>'idestatus',
					'value'=>'$data->color($data->idestatus,$data->idestatus0->estatus)',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Coordinador operativo',
					'name'=>'cOperativo',
					'value'=>'$data->cOperativo0->nombre.\'  \'.$data->cOperativo0->apellido',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Coordinador de transporte',
					'name'=>'cTaller',
					'value'=>'$data->cTaller0->nombre.\'  \'.$data->cTaller0->apellido',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Taller asignado',
					'name'=>'taller',
					'value'=>'$data->taller0->nombre',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Cerrar orden',
					'value'=>'CHTML::checkBox("campo",0,array(\'id\'=>"campo$data->id",\'width\'=>4,\'maxlength\'=>2,\'onchange\'=>"return cerrar($data->id)"))',
					'type'=>'raw',
					'visible'=>$nom=='Cerrar ordenes'?true:false,
					'htmlOptions'=>array('style'=>'text-align: center'),
				),
			)
        ));
		?>
		</div>
<div class='crugepanel user-assignments-role-list'>
<?php
for($i=0;$i<$totalVeh;$i++){
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'vehiculos',
				'hideHeader'=>true,
				//'selectionChanged'=>'validar',
				'summaryText'=>'',
			    'enableSorting' => true,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>0,
				'emptyText'=>'No hay ordenes listas para cerrar',
                'dataProvider'=>$vehiculos[$i],
				'columns'=>array(
				array(
					'type'=>'raw',
					'headerHtmlOptions'=>array('style'=>'width:7%;text-align:left;background:#F3FDA4'),
					'header'=>'Vehiculo',
					'value'=>'\'<strong>Unidad: </strong> #0\'.$data->numeroUnidad.\' \'.$data->idmodelo0->idmarca0->marca.\'  \'.$data->idmodelo0->modelo.\' \'.$data->anno.\' \'.$data->idcolor0->color',
					'htmlOptions'=>array('style'=>'text-align:left;width:100px;background:#F3FDA4'
				),
			),
		)
    ));
	for($j=0;$j<$idvehiculo[$i]["totAct"];$j++){
	$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'actividades',
				//'selectionChanged'=>'validar',
				'summaryText'=>'',
				'hideHeader'=>true,
			    'enableSorting' => true,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>0,
				'emptyText'=>'No hay ordenes listas para cerrar',
                'dataProvider'=>$actividades[$i][$j],
				'columns'=>array(
					array(
						'type'=>'raw',
						//'headerHtmlOptions'=>array('style'=>'width:10%;text-align:left;'),
						'header'=>'         Actividad',
						'value'=>'\'<strong>Actividad:</strong> \'.$data->idactividadMtto0->actividad',
						'htmlOptions'=>array('style'=>'text-align:left'),
					),
					array(
						'type'=>'raw',
						//'headerHtmlOptions'=>array('style'=>'text-align:right;'),
						'value'=>'$data->color($data->idestatus,$data->idestatus0->estatus).\'  \'.(date("d/m/Y",strtotime($data->fechaRealizada))=="31/12/1969"?"":date("d/m/Y",strtotime($data->fechaRealizada)))',
						'htmlOptions'=>array('style'=>'text-align:center;width:20%;margin-left:10px;'),
					),
				)
    ));
	if(count($recursos[$i][$j]->getData())>0){
	$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'recursos',
				//'selectionChanged'=>'validar',
				'summaryText'=>'',
			    'enableSorting' => true,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>0,
				'emptyText'=>'Esta actividad no tiene recursos asociados',
                'dataProvider'=>$recursos[$i][$j],
				'columns'=>array(
					array(
						'type'=>'raw',
						'headerHtmlOptions'=>array('style'=>'width:35%;text-align:left;'),
						'header'=>'<PRE>Recursos</PRE>',
						'value'=>'\'\'.(($data->idinsumo == null?\' \':$data->idinsumo0->insumo.\' \'.$data->detalle).\' \'.($data->idrepuesto == null?\' \':$data->idrepuesto0->repuesto.\' \'.$data->detalle.\' \'.($data->tieneAsignado()?CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/ver.png",
                                          "Agregar",array("title"=>"Ver detalle de nuevo repuesto cambiado")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{detalleRepuesto("\'.$data["id"].\'");}\'
                        )
                ):\' \')).\' \'.($data->idservicio == null?\' \':$data->idservicio0->servicio.\' \'.$data->detalle)).\' \'',
						'htmlOptions'=>array('style'=>'text-align:left;width:150px'),
					),
					array(
					'headerHtmlOptions'=>array('style'=>'text-align:left;'),
					'header'=>'<PRE>Tipo</PRE>',
					'value'=>'(($data->idinsumo == null?\'\':\'Insumo\').\'\'.($data->idrepuesto == null?\'\':\'Repuesto\').\'\'.($data->idservicio == null?\'\':\'Servicio\'))',
					'htmlOptions'=>array('style'=>'width:40px;'),
					//'footer'=>'',
				),
					array(
					'headerHtmlOptions'=>array('style'=>'text-align:left;'),
					'header'=>'<PRE>Cantidad</PRE>',
					'value'=>'$data->cantidad',
					'htmlOptions'=>array('style'=>'width:40px;'),
					
					//'footer'=>'',
					),
					array(
					'headerHtmlOptions'=>array('style'=>'text-align:left;'),
					'header'=>'<PRE>Unidad</PRE>',
					'value'=>'$data->idunidad0->unidad',
					'htmlOptions'=>array('style'=>'width:40px;'),
					//'footer'=>'',
					),
					array(
					'headerHtmlOptions'=>array('style'=>'text-align:left; width:50px;'),
					'header'=>'<PRE>Costo unitario</PRE>',
					'value'=>'number_format($data->costoUnitario, 2,",",".").\' Bs.\'',
					'htmlOptions'=>array('style'=>'width:50px;'),
					//'footer'=>'',
					),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:right;'),
					'header'=>'<PRE>Total</PRE>',
					'value'=>'$data->costoTotal',
					'value'=>'number_format($data->costoTotal, 2,",",".").\' Bs.\'',
					'htmlOptions'=>array('style'=>'width:50px;text-align:right;'),
					//'footer'=>'',
				),
			)
    ));
	}
}}
?>
</div>
<?php
if(count($factura->getData())>0){?>
<div class='crugepanel user-assignments-role-list'>
<i>*Información de facturación</i>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'factura',
				'summaryText'=>'',
				'selectableRows'=>0,
			    'enableSorting' => false,
				'emptyText'=>'no hay una factura registrada',
                'dataProvider'=>$factura,
				'columns'=>array(
					array(
					'header'=>'Fecha de factura',
					'name'=>'fechaFactura',
					'type'=>'raw',
					'value'=>'date("d/m/Y",strtotime($data->fechaFactura))',
					'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
				),
				array(
					'header'=>'Código de factura',
					'name'=>'codigo',
					'type'=>'raw',
					//'value'=>'',
					'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
				),
				array(
					'header'=>'Proveedor',
					'name'=>'idproveedor',
					'type'=>'raw',
					'value'=>'$data->idproveedor0->nombre',
					'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
				),
				array(
					'headerHtmlOptions'=>array('style'=>'width:10px;text-align:center;'),
					'header'=>'Sub-Total',
					'name'=>'total',
					'type'=>'raw',
					'value'=>'number_format($data->total, 2,",",".").\' Bs.\'',
					'htmlOptions'=>array('style'=>'width:10px;text-align:center;'),
				),
				array(
					'headerHtmlOptions'=>array('style'=>'width:10px;text-align:center;'),
					'header'=>'IVA',
					'name'=>'iva',
					'type'=>'raw',
					'value'=>'number_format($data->iva, 2,",",".").\' Bs.\'',
					'htmlOptions'=>array('style'=>'width:10px;text-align:center;'),
				),
				array(
					'headerHtmlOptions'=>array('style'=>'width:10px;text-align:center;'),
					'header'=>'Total Facturado',
					'name'=>'totalFactura',
					'type'=>'raw',
					'value'=>'number_format($data->totalFactura, 2,",",".").\' Bs.\'',
					'htmlOptions'=>array('style'=>'width:10px;text-align:center;'),
				),
			)
    ));

	?>
</div><?php }?>
<?php
/*ventana agregar costo*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'dialog',
    'options'=>array(
        'title'=>'',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'40%',
        'max-height'=>500,
		'position'=>array(null,100),
        //'height'=>260,
		'resizable'=>false,
		'close' => 'js:function(event, ui) { $("#gridSerial").hide(); }'
    ),
));?>
<div class="divForForm"> </div>
<div id="gridSerial" class='crugepanel' style="display:none;max-height: 200px;">
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'repdetalle',
				'summaryText'=>'',
				//'selectionChanged'=>'nuevoSerial',
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>0,
				'emptyText'=>'No se ha registrado ningun cambio de éste repueso en progeso',
                'dataProvider'=>$det,
				'htmlOptions'=>array('style'=>'cursor:pointer;'),
				'columns'=>array(
				array(
					'header'=>'Unidad',
					'name'=>'idvehiculo',
					'value'=>'str_pad((int) $data->idCaracteristicaVeh0->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:60px'),
				),
				array(
					'header'=>'Repuesto',
					//'name'=>'codigoPiezaEnUso',
					//'value'=>'str_pad((int) $data->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					'value'=>'$data->idCaracteristicaVeh0->idrepuesto0->repuesto',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				
				array(
					'header'=>'Detalle',
					'name'=>'detallePieza',
					//'value'=>'str_pad((int) $data->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Serial',
					'name'=>'codigoPiezaEnUso',
					//'value'=>'str_pad((int) $data->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Evento',
					//'name'=>'codigoPiezaEnUso',
					//'value'=>'str_pad((int) $data->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					'value'=>'$data->diasUltimoEvento()',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Anterior',
					'type'=>'raw',
					'value'=>'CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/ver.png",
                                          "Agregar",array("title"=>"Ver anterior")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{detalleAnterior("\'.$data["anterior"].\'");}\'
                        )
                )',
				'htmlOptions'=>array('style'=>'width:70px;text-align:center;'),
				),
			)
        ));

		?>
</div>
<?php $this->endWidget();?>

<?php
/*ventana detalle anterior*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'anterior',
    'options'=>array(
        'title'=>'Repuesto anterior',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>300,
		'position'=>array(null,150),
        //'height'=>260,
		'resizable'=>false,
		'close' => 'js:function(event, ui) { $("#serialAnterior").hide(); }'
    ),
));?>
<div class="divForForm"></div>
<div id="serialAnterior" class='crugepanel' style="display:none">
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'repdetalleAnterior',
				'summaryText'=>'',
				//'selectionChanged'=>'nuevoSerial',
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>0,
				'emptyText'=>'No existe un repuesto anterior',
                'dataProvider'=>$detAnterior,
				'htmlOptions'=>array('style'=>'padding: 10px 0px 0px;'),
				'columns'=>array(
				/*array(
					'header'=>'Unidad',
					'name'=>'idvehiculo',
					'value'=>'str_pad((int) $data->idCaracteristicaVeh0->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:60px'),
				),
				array(
					'header'=>'Repuesto',
					//'name'=>'codigoPiezaEnUso',
					//'value'=>'str_pad((int) $data->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					'value'=>'$data->idCaracteristicaVeh0->idrepuesto0->repuesto',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				
				array(
					'header'=>'Detalle',
					'name'=>'detallePieza',
					//'value'=>'str_pad((int) $data->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),*/
				array(
					'header'=>'Serial',
					'name'=>'codigoPiezaEnUso',
					//'value'=>'str_pad((int) $data->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),

				array(
					'header'=>'Último evento',
					//'name'=>'codigoPiezaEnUso',
					//'value'=>'str_pad((int) $data->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					'value'=>'$data->diasUltimoEvento()',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
			)
        ));

		?>
</div>
<?php $this->endWidget();?>

<script>
function detalleRepuesto(rep){
	$("#gridSerial").show();
	$.fn.yiiGridView.update('repdetalle',{ data : "idRep="+rep});	
	$('#dialog').dialog('open');
}
function detalleAnterior(id){
	$("#serialAnterior").show();
	$('#anterior').dialog('open');
	$.fn.yiiGridView.update('repdetalleAnterior',{ data : "idRepAnt="+id});	
}

$('#formulario').hide();
function validar(){
var idAct = $.fn.yiiGridView.getSelection('actividades');
	if(idAct=="")
		$('#formulario').hide(500);
	else
		$('#formulario').show(500);
		
jQuery.ajax({
                url: "crearOrden",
                'data':$(this).serialize()+ '&idAct=' + idAct,
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        $('#formulario').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        $('#formulario form').submit(validar); // 
                                }
                                else{
                                        $('#formulario').html(data.div);
                                }
                        } ,
                'cache':false});
	

		return false; 
}
function cerrar(orden){
	if(confirm('¿confirma que desea cerrar la orden?')){
	var dir="<?php echo Yii::app()->baseUrl."/mttoPreventivo/estatusOrden"?>";
		x=7;
	jQuery.ajax({
                url: dir+"/"+x,
                'data':$(this).serialize()+ '&id=' + orden,
                'type':'post',
                'dataType':'json',
				'success':function(){
					window.location.replace("<?php echo Yii::app()->baseUrl."/mttoPreventivo/index"?>");	
				},
                'cache':false});			
	}
	$.fn.yiiGridView.update('ordenes');
}

</script>