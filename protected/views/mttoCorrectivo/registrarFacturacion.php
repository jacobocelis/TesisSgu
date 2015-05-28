<?php 

$this->breadcrumbs=array(
	'Mantenimiento correctivo'=>array('mttoCorrectivo/index'),
	$nom=>array($dir),
	'Actualizar orden'=>array('mttoCorrectivo/mttocRealizados/','id'=>$id,'nom'=>$nom,'dir'=>$dir),
	'Facturación',
);
	$this->menu=array(
	array('label'=>'<div id="menu"><strong>Opciones de orden</strong></div>'),
	array('label'=>'      Detalle de orden', 'url'=>array('mttoCorrectivo/vistaPrevia/'.$id.'?nom='.$nom.'&dir='.$dir.'')),
	array('label'=>'      Actualizar orden', 'url'=>array('mttoCorrectivo/mttocRealizados/'.$id.'?nom='.$nom.'&dir='.$dir.''),'visible'=>Yii::app()->controller->estatusOrden($id)<>7),
	array('label'=>'      Registrar facturación', 'url'=>array('mttoCorrectivo/registrarFacturacion/'.$id.'?nom='.$nom.'&dir='.$dir.''),'visible'=>Yii::app()->controller->estatusOrden($id)<>7),

	array('label'=>'<div id="menu"><strong>Ordenes de mantenimiento</strong></div>'),
	array('label'=>'      Crear orden de mantenimiento', 'url'=>array('mttoCorrectivo/crearOrdenCorrectiva') ,'visible'=>Yii::app()->user->checkAccess('action_mttocorrectivo_crearOrdenCorrectiva')),
	array('label'=>'      Ver ordenes abiertas <span class="badge badge-'.$Colorabi.' pull-right">'.$abiertas.'</span>', 'url'=>array('mttoCorrectivo/verOrdenes') ,'visible'=>Yii::app()->user->checkAccess('action_mttocorrectivo_verOrdenes')),
	array('label'=>'      Ordenes listas para cerrar <span class="badge badge-'.$Colorli.' pull-right">'.$listas.'</span>', 'url'=>array('mttoCorrectivo/cerrarOrdenes'),'visible'=>Yii::app()->user->checkAccess('action_mttocorrectivo_cerrarOrdenes')),

 );
?>
<div id="factura" class='crugepanel user-assignments-role-list'>

</div>

<div id="detalle" style="display:none" class='crugepanel user-assignments-role-list'>	

<h1>Información de facturación</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'factu',
				'summaryText'=>'',
				'selectableRows'=>0,
			    //'enableSorting' => false,
				'emptyText'=>'',
                'dataProvider'=>$factura,
				'columns'=>array(
					array(
					'header'=>'Fecha de factura',
					'name'=>'fechaFactura',
					'type'=>'raw',
					'value'=>'date("d/m/Y",strtotime($data->fechaFactura))',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'name'=>'codigo',
					'type'=>'raw',
					'value'=>'str_pad((int) $data->codigo,8,"0",STR_PAD_LEFT);',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Proveedor',
					'name'=>'idproveedor',
					'type'=>'raw',
					'value'=>'$data->idproveedor0->nombre',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;'),
					'header'=>'Sub-Total',
					'name'=>'total',
					'type'=>'raw',
					'value'=>'number_format($data->total, 2,",",".").\' Bs.\'',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;'),
					'header'=>'IVA',
					'name'=>'iva',
					'type'=>'raw',
					'value'=>'number_format($data->iva, 2,",",".").\' Bs.\'',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;'),
					'header'=>'Total Facturado',
					'name'=>'totalFactura',
					'type'=>'raw',
					'value'=>'number_format($data->totalFactura, 2,",",".").\' Bs.\'',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
					array(
						'headerHtmlOptions'=>array('style'=>'text-align:center;'),
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
<?php if(count($dataProvider->getData())>0){?>
<div class='crugepanel user-assignments-role-list'>
	<i>*Incidentes reportados</i>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'fallas',
				'selectionChanged'=>'mostrarRecursos',
				'summaryText'=>'',
			    'enableSorting' => true,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>0,
				'emptyText'=>'No hay fallas por atender',
                'dataProvider'=>$dataProvider,
				'columns'=>array(
				
				array(
					'header'=>'Unidad',
					'name'=>'idvehiculo',
					'value'=>'str_pad((int) $data->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:60px'),
				),
				array(
					'header'=>'Fecha incidente',
					'name'=>'fechaFalla',
					'value'=>'date("d/m/Y",strtotime($data->fechaFalla))',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
			
				array(
					'header'=>'Incidente reportado',
					'name'=>'idfalla',
					'value'=>'$data->idfalla0->falla',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Lugar',
					'name'=>'lugar',
					//'value'=>'$data->idfalla0->falla',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Reportó',
					'name'=>'idempleado',
					'value'=>'$data->idempleado0->nombre.\' \'.$data->idempleado0->apellido',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
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
                                \'onclick\'=>\'{registrarMR("\'.Yii::app()->createUrl("reportefalla/actualizar",array("id"=>$data["id"])).\'"); $("#dialog2").dialog("open");}\'
                        )
                );',),*/
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;background:#B0E3FF;width:90px'),
					'header'=>'Fecha de reparación',
					'name'=>'fechaRealizada',
					'type'=>'raw',
					'value'=>'$data->valores($data->fechaRealizada)?date("d/m/Y",strtotime($data->fechaRealizada)).CHtml::link(
                     CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{registrarMR("\'.Yii::app()->createUrl("reportefalla/actualizar",array("id"=>$data["id"])).\'"); $("#dialog2").dialog("open");}\'
                        )
                ):$data->noasignado().CHtml::link(
                     CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{registrarMR("\'.Yii::app()->createUrl("reportefalla/actualizar",array("id"=>$data["id"])).\'"); $("#dialog2").dialog("open");}\'
                        )
                )',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;background:#B0E3FF;width:90px'),
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
				array(
					'type'=>'raw',
					'header'=>'Estatus',
					'name'=>'idestatus',
					'value'=>'$data->color($data->idestatus,$data->idestatus0->estatus)',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				
			)
        ));
		?>
</div>
<?php }?>
<?php if(count($mejoras->getData())>0){?>
<div  class='crugepanel user-assignments-role-list'>
	<i>*Mejoras por realizar</i>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'mejoras',
				'selectionChanged'=>'mostrarRecursos',
				'summaryText'=>'',
			    'enableSorting' => true,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>0,
				'emptyText'=>'No hay mejoras por realizar',
                'dataProvider'=>$mejoras,
				'columns'=>array(
				
				array(
					'header'=>'Unidad',
					'name'=>'idvehiculo',
					'value'=>'str_pad((int) $data->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:60px'),
				),
				
				array(
					'header'=>'Mejora',
					'name'=>'idfalla',
					'value'=>'$data->idfalla0->falla',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Detalle',
					'name'=>'detalle',
					
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				/*array(
					'header'=>'Conductor',
					'name'=>'idempleado',
					'value'=>'$data->idempleado0->nombre.\' \'.$data->idempleado0->apellido',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px'),
				),*/
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;background:#B0E3FF;width:90px'),
					'header'=>'Fecha de ejecución',
					'name'=>'fechaRealizada',
					'type'=>'raw',
					'value'=>'$data->valores($data->fechaRealizada)?date("d/m/Y",strtotime($data->fechaRealizada)).CHtml::link(
                     CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{registrarMR("\'.Yii::app()->createUrl("reportefalla/actualizar",array("id"=>$data["id"])).\'"); $("#dialog2").dialog("open");}\'
                        )
                ):$data->noasignado().CHtml::link(
                     CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{registrarMR("\'.Yii::app()->createUrl("reportefalla/actualizar",array("id"=>$data["id"])).\'"); $("#dialog2").dialog("open");}\'
                        )
                )',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;background:#B0E3FF;width:90px'),
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
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;'),
					'type'=>'raw',
					'header'=>'Estatus',
					'name'=>'idestatus',
					'value'=>'$data->color($data->idestatus,$data->idestatus0->estatus)',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),	
			)
        ));
		?>
		</div>
 <?php }?>
</div>
<?php $factura=$factura->getData();
	if(isset($factura[0]["id"]))
		$idfac=$factura[0]["id"];
	else
		$idfac=0;
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
					'headerHtmlOptions'=>array('style'=>'text-align:left;'),
					'header'=>'Recurso',
					'name'=>'idservicio',
					'value'=>'(($data->idinsumo == null?\'\':$data->idinsumo0->insumo).\'\'.($data->idrepuesto == null?\'\':$data->idrepuesto0->repuesto).\'\'.($data->idservicio == null?\'\':$data->idservicio0->servicio)).\'\'',
					'htmlOptions'=>array('style'=>'width:250px;'),
					//'footer'=>'',
				),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:left;'),
					'header'=>'Cantidad',
					'name'=>'cantidad',
					'htmlOptions'=>array('style'=>'width:50px;'),
					
					//'footer'=>'',
				),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:left;'),
					'header'=>'Unidad',
					'name'=>'idunidad',
					'value'=>'$data->idunidad0->corto',
					'htmlOptions'=>array('style'=>'width:50px;'),
					//'footer'=>'',
				),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:left;'),
					'header'=>'Precio unitario',
					'value'=>'number_format($data->costoUnitario, 2,",",".").\' BsF.\'',
					'name'=>'costoUnitario',
					
					'htmlOptions'=>array('style'=>'width:50px;'),
					//'footer'=>'',
				),
				array(
					'type'=>'raw',
					'headerHtmlOptions'=>array('style'=>'text-align:left;'),
					'header'=>'Total',
					'name'=>'costoTotal',
					'value'=>'number_format($data->costoTotal, 2,",",".").\' Bs.\'',
					'htmlOptions'=>array('style'=>'width:50px;'),
					//'footer'=>'<strong>Total:</strong><div id="total"></div>'.$model->total($recurso->getData()),
					//'footerHtmlOptions'=> array('style' => 'text-align:right;'),

				),
				array(
						'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;'),
						'htmlOptions'=>array('style'=>'text-align:center;'),
						'header'=>'Agregar costo',
						'type'=>'raw',
						'value'=>'CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{editarActividad("\'.Yii::app()->createUrl("Recursofalla/update",array("id"=>$data["id"])).\'","\'.$data["id"].\'"); $("#dialog").dialog("open");}\'
                        )
                );',),
				array(
					'header'=>'Eliminar',
					'class'=>'CButtonColumn',
					'afterDelete' => 'function(id,data){$.fn.yiiGridView.update("factu");}',
					 'template'=>'{delete}',
					     'buttons'=>array(
							'delete' => array(
								'url'=>'Yii::app()->createUrl("Recursofalla/delete", array("id"=>$data->id,"idfac"=>'.$idfac.'))',
						),
					),
				),
			),
	));?>
	<?php echo CHtml::link('Agregar recurso', "",  // the link for open the dialog
    array(
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregarRecurso(); }"));
		?>	
</div>
 
<?php $this->endWidget();?>

<?php
/*ventana agregar informacion*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'dialog2',
    'options'=>array(
        'title'=>'Registrar mantenimiento realizado',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'30%',
        'position'=>array(null,100),
		'resizable'=>false
    ),
));?>
<div class="divForForm"></div>
 
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
<div class="divForForm"></div>
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

				array(
					'header'=>'Último evento',
					//'name'=>'codigoPiezaEnUso',
					//'value'=>'str_pad((int) $data->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					'value'=>'$data->diasUltimoEvento()',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),

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
							).\'"); $("#dialog4").dialog("open");}\'
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
							).\'"); $("#dialog4").dialog("open");}\'
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
        'title'=>'Agregar recurso a facturar',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>410,
		'position'=>array(null,100),
		'resizable'=>false
    ),
));?>
<div id="panelBuscar" style="float:left;width:100%;display:none">
<i><b style="float:left;">Buscar recurso: </b></i>
<?php
$this->widget('ext.myAutoComplete.myAutoComplete',array(
    'name'=>'ajaxrequest',
	'id'=>'buscador',
    // additional javascript options for the autocomplete plugin
    'options'=>array(
        'minLength'=>'1',
        'showAnim'=>'fold',
        'open'=> 'js:function(e, ui) {
        	/*$(".ui-menu-item").css("top", $("ul.ui-autocomplete").cssUnit("top")[0] + 4);
        	$(".ui-menu-item").css("left", $("ul.ui-autocomplete").cssUnit("left")[0] - 2);
        	$(".ui-menu-item").append("<div><span>2,000</span> results found, showing <span>10</span></div>");*/

        }',
       'select'=>"js:function(event, ui) { 
        	Filtrar(ui.item.id,ui.item.tipo);
       }"
    ),
    'source'=>$this->createUrl("vehiculo/buscarRecurso"),
    'htmlOptions'=>array(
        'style'=>'width:300px;float:left',
		'placeholder'=>"Ejemplo: Aceite",
    ),
    'methodChain'=>'.data( "autocomplete" )._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<a><b>" + item.label + "</b><br>" + item.desc + "</a>" )
        .appendTo( ul );
	};'

));
?>

</div><br>
<div class="divForForm"></div>
 
<?php $this->endWidget();?>

<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'dialog4',
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
<div class="divForForm"></div>
<?php $this->endWidget();?>
<script>
cargar();
var Uurl;
var idAct;
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
                                        $('#dialog2 div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        $('#dialog2 div.divForForm form').submit(registrarMR); // updatePaymentComment
                                }
                                else
                                {
                                        $('#dialog2 div.divForForm').html(data.div);
                                        setTimeout("$('#dialog2').dialog('close') ",1000);
                                        $.fn.yiiGridView.update('fallas');
										$.fn.yiiGridView.update('mejoras');
										//actualizarCheck(idorden);
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
function cargar(){
var data=<?php echo $total?>;
if(data==0){
	$('#factura').show();
	$('#detalle').hide();
}
else{
	$('#factura').hide();
	$('#detalle').show();
}
var id=<?php echo $id?>;
var dir="<?php echo Yii::app()->baseUrl."/mttoCorrectivo/agregarFactura"?>";
jQuery.ajax({
                url: dir+"/"+id,
                'data':$(this).serialize(),
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
var dirurl;
function deshacer(_url){

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


var idfac=<?php echo $idfac?>;
var idRep;
var Uurl;
function editarActividad(id,rep){
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
                                $('#dialog div.divForForm form').submit(editarActividad); 
                        }
                        else
                        {
                                //$('#dialog div.divForForm').html(data.div);
                                setTimeout("$('#dialog').dialog('close') ",0000);
                                $.fn.yiiGridView.update('rec');
								$.fn.yiiGridView.update('factu');
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
										$('#dialog4 div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        $('#dialog4 div.divForForm form').submit(addDetalle); // updatePaymentComment
                                }
                                else
                                {		
                                        $('#dialog4 div.divForForm').html(data.div);
                                        setTimeout("$('#dialog4').dialog('close') ",1000);
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
	//var idAct = $.fn.yiiGridView.getSelection('actividad');

	var url="<?php echo Yii::app()->baseUrl."/mttoCorrectivo/agregarRecursoAdicional/"?>";
	jQuery.ajax({
                url: url+idAct,
                'data':$(this).serialize()+'&idfac='+idfac,
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        $('#recurso div.divForForm').html(data.div);
                                        $('#recurso div.divForForm form').submit(agregarRecurso);
                                }
                                else{
                                        $('#recurso div.divForForm').html(data.div);
                                        $("#panelBuscar").hide();
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
function Filtrar(idrecurso,idtipo){

	jQuery.ajax({
        url: "<?php echo Yii::app()->baseUrl;?>"+"/vehiculo/seleccionarRecurso",
        'data':$(this).serialize()+"&idrecurso="+idrecurso+"&idtipo="+idtipo,
        'type':'post',
        'dataType':'json',
        'success':function(data){
        		if(data.idTipo==1){
        			$("#lista").val(data.idTipo).change();
        			$("#Tipoinsumo_tipo").val(data.idTipoIns).change();
					setTimeout(function(){ $("#_idinsumo").val(data.idInsumo).change(); }, 300);

        		}
        		if(data.idTipo==2){
        			$("#lista").val(data.idTipo).change();
        			$("#Subtiporepuesto_subTipo").val(data.idSubTipo).change();
        			setTimeout(function(){ $("#_idrepuesto").val(data.idRepuesto).change(); }, 300);
        			
        		}
        		if(data.idTipo==3){
        			$("#lista").val(data.idTipo).change();
        			$("#_idservicio").val(data.idServicio);
        		}          
        },
                'cache':false});
    return false; 
}
</script>
<style>
.ui-autocomplete { height: 130px; overflow-y: scroll; overflow-x: hidden;}
</style>