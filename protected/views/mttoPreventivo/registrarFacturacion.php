<?php 
$this->breadcrumbs=array(
	'Mantenimiento preventivo'=>array('mttoPreventivo/index'),
	$nom=>array($dir),
	'Actualizar orden'=>array('mttoPreventivo/mttopRealizados/','id'=>$id,'nom'=>$nom,'dir'=>$dir),
	'Facturación',
);
	$this->menu=array(
	array('label'=>'<div id="menu"><strong>Opciones de orden</strong></div>'),
	array('label'=>'      Detalle de orden', 'url'=>array('mttoPreventivo/vistaPrevia/'.$id.'?nom='.$nom.'&dir='.$dir.'')),
	array('label'=>'      Actualizar orden', 'url'=>array('mttoPreventivo/mttopRealizados/'.$id.'?nom='.$nom.'&dir='.$dir.'')),
	array('label'=>'      Registrar facturación', 'url'=>array('mttoPreventivo/registrarFacturacion/'.$id.'?nom='.$nom.'&dir='.$dir.'')),

	array('label'=>'<div id="menu"><strong>Órdenes de mantenimiento</strong></div>'),
	array('label'=>'      Crear orden de mantenimiento', 'url'=>array('mttoPreventivo/crearOrdenPreventiva') ,'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_crearOrdenPreventiva')),
	array('label'=>'      Ver órdenes abiertas <span class="badge badge-'.$Colorabi.' pull-right">'.$abiertas.'</span>', 'url'=>array('mttoPreventivo/verOrdenes') ,'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_verOrdenes')),
	array('label'=>'      Órdenes listas para cerrar <span class="badge badge-'.$Colorli.' pull-right">'.$listas.'</span>', 'url'=>array('mttoPreventivo/cerrarOrdenes'),'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_cerrarOrdenes')),
);
?>
<div id="factura" class='crugepanel'>
</div>
<div id="detalle" class='crugepanel'>
<h1>Información de facturación</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'factu',
				'summaryText'=>'',
				'selectableRows'=>0,
			    //'enableSorting' => false,
				'emptyText'=>'no existen mantenimientos preventivos registrados',
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
					'name'=>'codigo',
					'type'=>'raw',
					'value'=>'str_pad((int) $data->codigo,8,"0",STR_PAD_LEFT);',
					'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
				),
				array(
					'header'=>'Proveedor',
					'name'=>'idproveedor',
					'type'=>'raw',
					'value'=>'$data->idproveedor0->nombre',
					'htmlOptions'=>array('style'=>'width:120px;text-align:center;'),
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
					array(
						'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;'),
						'htmlOptions'=>array('style'=>'text-align:center;'),
						'header'=>'Modificar datos de factura',
						'type'=>'raw',
						'value'=>'CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{editarFactura("\'.Yii::app()->createUrl("factura/update",array("id"=>$data["id"],"idorden"=>$data["idordenMtto"])).\'");}\'
                        )
                );',),
			)
    ));
?>	
<br>
<i>*Lista de actividades de mantenimiento realizadas</i>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'actividad',
				//'selectionChanged'=>'mostrarRecursos',
				'summaryText'=>'',
				'selectableRows'=>1,
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
				/*array(
					'header'=>'Fecha de realizada',
					'name'=>'fechaRealizada',
					'type'=>'raw',
					'value'=>'$data->valores($data->fechaRealizada)?date("d/m/Y",strtotime($data->fechaRealizada)):$data->noasignado()',
					'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
				),
				array(
					'header'=>'Kilometraje al realizarla',
					'name'=>'kmRealizada',
					'type'=>'raw',					
					'value'=>'number_format($data->valores($data->kmRealizada))?number_format($data->kmRealizada).\' Km \':$data->noasignado()',
					'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
				),*/
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;background:#B0E3FF'),
					'htmlOptions'=>array('style'=>'text-align:center;'),
					'header'=>'Registrar gastos',
					'type'=>'raw',
					'value'=>'CHtml::link(
                     CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Registrar")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                 \'onclick\'=>\'{ mostrarRecursos("\'.$data->id.\'")}\'
                        )
                );',),
			)
        ));
?>
</div>
<?php $factura=$factura->getData();
	if(isset($factura[0]["id"])){
		$idfac=$factura[0]["id"];
	}
	else{
		$idfac=0;
	}
?>
<?php
/*ventana agregar informacion*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'dialog3',
    'options'=>array(
        'title'=>'Registrar gastos realizados',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'80%',
        'position'=>array(null,100),
		'resizable'=>false
    ),
));?>
<div id='recur' style="display:none" class='crugepanel user-assignments-detail'>
<?php 
			$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'rec',
			'selectableRows'=>0,
			'dataProvider'=>$recurso,
			'enablePagination' => false,
			'template'=>"{items}{summary}{pager}",
			'emptyText' => 'no hay recursos agregados',
			'summaryText' => '',
			'columns'=>array(	
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;'),
					'header'=>'Recurso',
					'name'=>'idservicio',
					'value'=>'(($data->idinsumo == null?\'\':$data->idinsumo0->insumo).\'\'.($data->idrepuesto == null?\'\':$data->idrepuesto0->repuesto).\'\'.($data->idservicio == null?\'\':$data->idservicio0->servicio)).\' \'.$data->detalle',
					'htmlOptions'=>array('style'=>'text-align:center'),
					//'footer'=>'',
				),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;'),
					'header'=>'Cantidad',
					'name'=>'cantidad',
					'htmlOptions'=>array('style'=>'text-align:center'),
					
					//'footer'=>'',
				),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;'),
					'header'=>'Unidad',
					'name'=>'idunidad',
					'value'=>'$data->idunidad0->corto',
					'htmlOptions'=>array('style'=>'text-align:center'),
					//'footer'=>'',
				),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;'),
					'header'=>'Precio unitario',
					'value'=>'number_format($data->costoUnitario, 2,",",".").\' BsF.\'',
					'name'=>'costoUnitario',
					
					'htmlOptions'=>array('style'=>'text-align:center'),
					//'footer'=>'',
				),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;'),
					'header'=>'Total',
					'name'=>'costoTotal',

					'value'=>'number_format($data->costoTotal, 2,",",".").\' Bs.\'',
					'htmlOptions'=>array('style'=>'text-align:center'),
					//'footer'=>'',
				),
				array(
						'headerHtmlOptions'=>array('style'=>'text-align:center;width:100px;'),
						'htmlOptions'=>array('style'=>'text-align:center;'),
						'header'=>'Agregar costo',
						'type'=>'raw',
						'value'=>'CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{editarActividad("\'.Yii::app()->createUrl("actividadrecurso/update",array("id"=>$data["id"])).\'","\'.$data["id"].\'");}\'
                        )
                );',),
                /*array(
						'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;'),
						'htmlOptions'=>array('style'=>'text-align:center;'),
						'header'=>'Actualizar serial',
						'type'=>'raw',
						//'visible'=>'$data->costoTotal<=0?FALSE:TRUE',

						'value'=>'CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{actualizarSerial("\'.$data["id"].\'");}\'
                        )
                );',),*/
				array(
					'header'=>'Eliminar',
					'class'=>'CButtonColumn',
					'afterDelete' => 'function(id,data){$.fn.yiiGridView.update("factu");}',
					 'template'=>'{delete}',
					     'buttons'=>array(
							'delete' => array(
								'url'=>'Yii::app()->createUrl("actividadrecurso/delete", array("id"=>$data->id,"idfac"=>'.$idfac.'))',
						),
					),
				),
			),
	));?>
	<?php echo CHtml::link('Agregar recurso adicional', "",  // the link for open the dialog
    array(
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregarRecurso(); }"));
		?>	
</div>

<?php $this->endWidget();?>

<?php
/*ventana agregar recurso*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'ModFactura',
    'options'=>array(
        'title'=>'Editar información de factura',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>490,
		'resizable'=>false,
		'position'=>array(null,100),
    ),
));?>
<div class="divForForm"></div> 
<?php $this->endWidget();?>

<?php
/*ventana agregar costo*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'dialog',
    'options'=>array(
        'title'=>'Agregar costo',
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
<i>La lista inferior muestra el detalle del repuesto actual en el vehiculo, si está efectuando un cambio puede agregar la información del nuevo repuesto.</i>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'repdetalle',
				'summaryText'=>'',
				//'selectionChanged'=>'nuevoSerial',
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>0,
				'emptyText'=>'No hay repuestos asignados',
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
				/*array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;width:50px;'),
					'header'=>'Evento',
					'name'=>'evento',
					'value'=>'$data->evento',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:20px'),
				),*/
				array(
					'header'=>'Último evento',
					//'name'=>'codigoPiezaEnUso',
					//'value'=>'str_pad((int) $data->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					'value'=>'$data->diasUltimoEvento()',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				/*array(
						'headerHtmlOptions'=>array('style'=>'text-align:center;width:50px;'),
						'htmlOptions'=>array('style'=>'text-align:center;'),
						'header'=>'anterior',
						'type'=>'raw',
						'value'=>'CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/ver.png",
                                          "Agregar",array("title"=>"ver")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{editarActividad("\'.Yii::app()->createUrl("actividadrecurso/update",array("id"=>$data["id"])).\'","\'.$data["id"].\'");}\'
                        )
                );',),*/
				/*array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;width:50px;'),
					'header'=>'Estado',
					'name'=>'estado',
					'value'=>'$data->estado',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:20px'),
				),*/
				array(
					'header'=>'Nuevo',
					'type'=>'raw',
					'value'=>'$data->estado==3?CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/ver.png",
                                          "Agregar",array("title"=>"Ver anterior")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{detalleAnterior("\'.$data["anterior"].\'");}\'
                        )
                )." ".CHtml::link(CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png","Agregar",array("title"=>$data->estado<>3?"Agregar":"Editar")),"",
                    array(
                            \'style\'=>\'cursor: pointer; width:50px;text-decoration: underline;\',
                            \'onclick\'=>\'{addDetalle("\'.Yii::app()->createUrl("cantidad/actualizarSerial",array("id"=>$data["id"])
							).\'"); $("#dialog2").dialog("open");}\'
                    )
                )." ".CHtml::link(CHtml::image(Yii::app()->request->baseUrl."/imagenes/deshacer.png","Agregar",array("title"=>"Deshacer acción")),"",
                    array(
                            \'style\'=>\'cursor: pointer; width:50px;text-decoration: underline;\',
                            \'onclick\'=>\'{deshacer("\'.Yii::app()->createUrl("cantidad/deshacer",array("id"=>$data["id"])
							).\'");}\'
                    )
                ):CHtml::link(CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png","Agregar",array("title"=>$data->estado<>3?"Agregar":"Editar")),"",
                    array(
                            \'style\'=>\'cursor: pointer; width:50px;text-decoration: underline;\',
                            \'onclick\'=>\'{addDetalle("\'.Yii::app()->createUrl("cantidad/actualizarSerial",array("id"=>$data["id"])
							).\'"); $("#dialog2").dialog("open");}\'
                    )
                );',
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
        'width'=>'40%',
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

<?php
/*ventana agregar recurso*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'recurso',
    'options'=>array(
        'title'=>'Agregar recurso adicional',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>510,
		'position'=>array(null,100),
		'resizable'=>false
    ),
));?>
<div class="divForForm"></div>
 
<?php $this->endWidget();?>

<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'dialog2',
    'options'=>array(
        'title'=>'Registro de serial nuevo',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>320,
       // 'height'=>270,
        'position'=>array(null,200),
		'resizable'=>false
    ),
));?>
<div class="divForForm2"></div>
<?php $this->endWidget();?>

<script>
 
var idAct;
$('#recur').hide();
cargar();
function cargar(){
var data=<?php echo $total?>;
var idord=<?php echo $id?>;
if(data==0){
	$('#factura').show();
	$('#detalle').hide();
}
else{
	$('#factura').hide();
	$('#detalle').show();
}
var id=<?php echo $id?>;
var dir="<?php echo Yii::app()->baseUrl."/mttoPreventivo/agregarFactura"?>";
jQuery.ajax({
                url: dir+"/"+id,
                'data':$(this).serialize()+"&idord="+idord,
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        $('#factura').html(data.div);
                                        $('#factura form').submit(cargar);
                                }
                                else{
                                        $('#factura').html(data.div);
										window.setTimeout('location.reload()', 1);
                                }
                        } ,
                'cache':false});
	return false; 
}
function detalleAnterior(id){
	$("#serialAnterior").show();
	$('#anterior').dialog('open');
	$.fn.yiiGridView.update('repdetalleAnterior',{ data : "idRepAnt="+id});	
}
function mostrarRecursos(id){
idAct=id;
//var altura = $(document).height();
//$("html, body").animate({scrollTop:altura+"px"},500);
//$('#recur').show(500);
	/*var idAct = $.fn.yiiGridView.getSelection('fallas');
	if(idAct=="")
		$('#recur').hide();*/
	$('#recur').show();
	$.fn.yiiGridView.update('rec',{ data : "idAct="+id});
	$("#dialog3").dialog("open");
}
var Uurl;
var idfac=<?php echo $idfac?>;
var idRep;
function editarActividad(id,rep){
//$("#gridSerial").show();

if(rep!=undefined){
	idRep=rep;	
	$.fn.yiiGridView.update('repdetalle',{ data : "idRep="+rep});	
}

$('#dialog').dialog('open');
	 if (typeof(id)=='string')
                Uurl=id;
	jQuery.ajax({
                url: Uurl,
                'data':$(this).serialize()+'&idfac='+idfac,
                'type':'post',
                'dataType':'json',
                'success':function(data)
                        {
                                if (data.status == 'failure')
                                {
                                		if(data.asignado)
                                			$("#gridSerial").show();
                                		else
                                			$("#gridSerial").hide();
                                        $('#dialog div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        $('#dialog div.divForForm form').submit(editarActividad); // updatePaymentComment
                                }
                                else
                                {

                                        //$('#dialog div.divForForm').html(data.div);
                                        $('#dialog').dialog('close');
                                        $.fn.yiiGridView.update('rec');
										$.fn.yiiGridView.update('factu');
                                }
                        } ,
                'cache':false});

    return false; 
}
function nuevoSerial(){

	$('#divRenovacion').show(500);
	var idrenov = $.fn.yiiGridView.getSelection('renovaciones');
	if(idrenov==""){
		$('#divRenovacion').hide();	
		idrenov=0;
	}
	$.fn.yiiGridView.update('nuevoMontaje',{ data : {idrenov:idrenov.toString()},
			complete: function(jqXHR, status) {
            if (status=='success'){
				$.fn.yiiGridView.update('factu');
                verificar(idrenov.toString());
			}
		}
	});
}
var dirurl;
function deshacer(_url){

//$.fn.yiiGridView.update('detalle');
        // If its a string then set the global variable, if its an object then don't set
        if (typeof(_url)=='string')
                dirurl=_url;

        jQuery.ajax({
                url: dirurl,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){			
                        if (data.status == 'failure'){   
							
                        }
                        else{		
                            $.fn.yiiGridView.update('repdetalle');
                        }
                } ,
                'cache':false});
        return false;
}

function addDetalle(_url){

//$.fn.yiiGridView.update('detalle');
        // If its a string then set the global variable, if its an object then don't set
        if (typeof(_url)=='string')
                dirurl=_url;

        jQuery.ajax({
                url: dirurl,
                'data':$(this).serialize()+'&idrep='+idRep,
                'type':'post',
                'dataType':'json',
                'success':function(data){
				
                                if (data.status == 'failure')
                                {   
										$('#dialog2 div.divForForm2').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        $('#dialog2 div.divForForm2 form').submit(addDetalle); // updatePaymentComment
                                }
                                else
                                {		
                                        $('#dialog2 div.divForForm2').html(data.div);
                                        setTimeout("$('#dialog2').dialog('close') ",1000);
                                        $.fn.yiiGridView.update('repdetalle');
                                }
                        } ,
                'cache':false});
        return false;
}
function editarFactura(id){
$('#ModFactura').dialog('open');
	 if (typeof(id)=='string')
                Uurl=id;
	jQuery.ajax({
                url: Uurl,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data)
                        {
                                if (data.status == 'failure')
                                {
                                        $('#ModFactura div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        $('#ModFactura div.divForForm form').submit(editarFactura); // updatePaymentComment
                                }
                                else
                                {
                                        $('#ModFactura div.divForForm').html(data.div);
                                        setTimeout("$('#ModFactura').dialog('close') ",1000);
										$.fn.yiiGridView.update('factu');
                                }
                        } ,
                'cache':false});
    return false; 
}
function agregarRecurso(){
$('#recurso').dialog('open');
	var url="<?php echo Yii::app()->baseUrl."/mttoPreventivo/agregarRecursoAdicional/"?>";
	jQuery.ajax({
                url: url+idAct,
                'data':$(this).serialize()+'&idfac='+idfac,
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        $('#recurso div.divForForm').html(data.div);
                                        $('#recurso div.divForForm form').submit(agregarRecurso); // updatePaymentComment
                                }
                                else{
                                        $('#recurso div.divForForm').html(data.div);
                                        setTimeout("$('#recurso').dialog('close') ",1000);
                                        $.fn.yiiGridView.update('rec');
                                        $.fn.yiiGridView.update('factu');
                                }
                        },
                'cache':false});
    return false; 
}
function nuevoInsumo(){
	$("#lista").attr('disabled', true);
	$("#nuevoInsumo").show(500);
	$("#restoFormRecurso").hide(500);
	
	jQuery.ajax({
                url: "<?php echo Yii::app()->baseUrl;?>"+"/Insumo/create",
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        $('#nuevoInsumo ').html(data.div);
                                        
										$('#Insumo_tipoInsumo').val($('#Tipoinsumo_tipo').val());
										$('#nuevoInsumo  form').submit(nuevoInsumo);
                                }
                                else{
                                        $('#nuevoInsumo').html(data.div);
										$("#nuevoInsumo").hide(500);
										$("#restoFormRecurso").show(500);
										$("#lista").attr('disabled', false);
										
										validarInsumoNuevo($('#Tipoinsumo_tipo option:selected').val());
                                }
                },
                'cache':false});
    return false; 

}
function nuevoRepuesto(){
	$("#lista").attr('disabled', true);
	$("#nuevoRepuesto").show(500);
	$("#restoFormRecurso").hide(500);
	jQuery.ajax({
                url: "<?php echo Yii::app()->baseUrl;?>"+"/Repuesto/crear",
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if(data.status == 'failure'){
                                        $('#nuevoRepuesto ').html(data.div);
                                   
										$('#Repuesto_idsubTipoRepuesto').val($('#Subtiporepuesto_subTipo option:selected').val());
										$('#nuevoRepuesto  form').submit(nuevoRepuesto);
                                }
                                else{
                                        $('#nuevoRepuesto').html(data.div);
										$("#nuevoRepuesto").hide(500);
										$("#restoFormRecurso").show(500);
										$("#lista").attr('disabled', false);
										validarRepuestoNuevo($('#Subtiporepuesto_subTipo option:selected').val());
                                }
                },
                'cache':false});
    return false; 
}
function nuevoServicio(){
	$("#lista").attr('disabled', true);
	$("#nuevoServicio").show(500);
	$("#restoFormRecurso").hide(500);
	jQuery.ajax({
                url: "<?php echo Yii::app()->baseUrl;?>"+"/Servicio/crear",
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if(data.status == 'failure'){
                                        $('#nuevoServicio').html(data.div);
										//$('#Repuesto_idsubTipoRepuesto').val($('#Subtiporepuesto_subTipo option:selected').val());
										$('#nuevoServicio  form').submit(nuevoServicio);
                                }
                                else{
                                        $('#nuevoServicio').html(data.div);
										$("#nuevoServicio").hide(500);
										$("#restoFormRecurso").show(500);
										$("#lista").attr('disabled', false);
										validarServicioNuevo();
                                }
                },
                'cache':false});
    return false; 
}
</script>