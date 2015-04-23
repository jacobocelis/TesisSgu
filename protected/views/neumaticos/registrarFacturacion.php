<?php 
$this->breadcrumbs=array(
	'Neumáticos'=>array('neumaticos/index'),
	$nom=>array($dir),
	'Actualizar órden'=>array('neumaticos/mttonRealizados/','id'=>$id,'nom'=>$nom,'dir'=>$dir),
	'Facturación',
);
	$this->menu=array(
	array('label'=>'<div id="menu"><strong>Historial</strong></div>'),
	array('label'=>'      Histórico de mantenimientos', 'url'=>array('historicoPreventivo')),
	array('label'=>'      Histórico de gastos', 'url'=>array('historicoGastos')),
	array('label'=>'      Histórico de ordenes', 'url'=>array('historicoOrdenes')),	
);
?>
<?php $factur=$factura->getData();
	if(isset($factur[0]["id"]))
		$idfac=$factur[0]["id"];
	else
		$idfac=0;
?>
<div id="factura" class='crugepanel'></div>

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
<?php if(count($averias->getData())>0){?>
<div id="mostrarAverias" class='crugepanel'>
<h1>Averías</h1>
<p><i>Selecciona una avería para asignar los gastos individuales por vehiculo</p></i>
<strong><p></p></strong>
	<?php
	$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'averias',
				'selectableRows'=>0,
				'summaryText'=>'',
				//'selectionChanged'=>'mostrarRecursos',
			    //'enableSorting' => true,
				'emptyText'=>'no existen averias registradas en ésta orden',
                'dataProvider'=>$averias,
				'htmlOptions'=>array('style'=>'cursor:pointer'),
				'columns'=>array(
				array(
					'header'=>'Unidad',
					'name'=>'idhistoricocaucho',
					'value'=>'str_pad((int) $data->idhistoricoCaucho0->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:60px'),
				),
				array(
					'header'=>'Fecha',
					'name'=>'fechaFalla',
					'value'=>'date("d/m/Y",strtotime($data->fechaFalla))',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
			
				array(
					'header'=>'Avería reportada',
					'name'=>'idfallacaucho',
					'value'=>'$data->idfallaCaucho==null?\' \':$data->idfallaCaucho0->falla',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Eje',
					'value'=>'$data->idhistoricoCaucho0->iddetalleRueda0->iddetalleEje0->idposicionEje0->posicionEje',
					'name'=>'iddetalleRueda',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Lado',
					'value'=>'$data->idhistoricoCaucho0->iddetalleRueda0->idposicionRueda0->posicionRueda',
					'name'=>'iddetalleRueda',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Medida',
					'value'=>'$data->idhistoricoCaucho0->idcaucho0->idmedidaCaucho0->medida.\' R\'.$data->idhistoricoCaucho0->idcaucho0->idrin0->rin.\' \'.$data->idhistoricoCaucho0->idcaucho0->idpiso0->piso',
					'name'=>'idcaucho',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Serial',
					'value'=>'$data->idhistoricoCaucho==null?\' \':$data->idhistoricoCaucho0->serial',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),

				
				array(
					'header'=>'Reportó',
					'name'=>'idempleado',
					'value'=>'$data->idempleado==""?\' \':$data->idempleado0->nombre.\' \'.$data->idempleado0->apellido',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;background:#B0E3FF'),
					'header'=>'Fecha de reparación',
					'name'=>'fechaRealizada',
					'type'=>'raw',
					'value'=>'$data->valores($data->fechaRealizada)?date("d/m/Y",strtotime($data->fechaRealizada)).CHtml::link(
                     CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{registrarMR("\'.Yii::app()->createUrl("Detalleeventoca/actualizar",array("id"=>$data["id"])).\'"); $("#dialog").dialog("open");}\'
                        )
                ):$data->noasignado().CHtml::link(
                     CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{registrarMR("\'.Yii::app()->createUrl("Detalleeventoca/actualizar",array("id"=>$data["id"])).\'"); $("#dialog").dialog("open");}\'
                        )
                )',
					'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
				),
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
					'name'=>'idrecursoCaucho',
					'value'=>'$data->idrecursoCaucho0->recurso',
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
					'headerHtmlOptions'=>array('style'=>'text-align:left;'),
					'header'=>'Total',
					'name'=>'costoTotal',
					'value'=>'number_format($data->costoTotal, 2,",",".").\' Bs.\'',
					'htmlOptions'=>array('style'=>'width:50px;'),
					//'footer'=>'',
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
                                \'onclick\'=>\'{editarActividad("\'.Yii::app()->createUrl("Detreccaucho/update",array("id"=>$data["id"])).\'"); $("#dialog").dialog("open");}\'
                        )
                );',),
				array(
					'header'=>'Eliminar',
					'class'=>'CButtonColumn',
					 'template'=>'{delete}',
					 'afterDelete'=>'function(link,success,data){
	                               $.fn.yiiGridView.update("factu");
	                        }',
					     'buttons'=>array(
							'delete' => array(
								'url'=>'Yii::app()->createUrl("detreccaucho/delete", array("id"=>$data->id,"idfac"=>'.$idfac.'))',
						),
					),
				),
			),
	));
	 echo CHtml::link('Agregar recurso', "",  // the link for open the dialog
    array(
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregarRecurso(); }"));
		?>
</div>
 
<?php $this->endWidget();?>

</div>

<?php }?>
<?php if(count($renovaciones->getData())>0){?>
<div id="mostrarRenovaciones" class='crugepanel'> 
<h1>Renovaciones</h1>
<i>Seleccione un neumático para registrar la renovación del mismo</i>
	<?php
	$this->widget('ext.selgridview.SelGridView', array(
                'id'=>'renovaciones',
				'selectableRows'=>1,
				'selectionChanged'=>'mostrarNuevoCaucho',
				'summaryText'=>'',
			    //'enableSorting' => true,
				'emptyText'=>'no existen renovaciones a realizar en ésta orden',
                'dataProvider'=>$renovaciones,
				'htmlOptions'=>array('style'=>'cursor:pointer;'),
				'columns'=>array(
				array(
					'header'=>'Unidad',
					'name'=>'idhistoricoCaucho',
					'value'=>'str_pad((int) $data->idhistoricoCaucho0->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:40px'),
				),
				array(
					'type'=>"raw",
					'header'=>'Serial',
					'value'=>'$data->idhistoricoCaucho0->serial=="0"?$data->porDefinir($data->idhistoricoCaucho0->serial):strtoupper($data->idhistoricoCaucho0->serial);',
					//'name'=>'serial',
					'htmlOptions'=>array('style'=>'text-align:center;width:65px'),
				),
				array(
					'type'=>'raw',
					'header'=>'Marca',
					'value'=>'$data->idhistoricoCaucho0->idmarcaCaucho==""?$data->porDefinir(""):$data->idhistoricoCaucho0->idmarcaCaucho0->nombre',
					'name'=>'idmarcaCaucho',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'header'=>'Detalle',
					'value'=>'$data->idhistoricoCaucho0->idcaucho0->idmedidaCaucho0->medida.\' R\'.$data->idhistoricoCaucho0->idcaucho0->idrin0->rin.\' \'.$data->idhistoricoCaucho0->idcaucho0->idpiso0->piso',
					'name'=>'idcaucho',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'header'=>'Eje',
					'value'=>'$data->idhistoricoCaucho0->iddetalleRueda0->iddetalleEje0->idposicionEje0->posicionEje',
					'name'=>'iddetalleRueda',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'header'=>'Lado',
					'value'=>'$data->idhistoricoCaucho0->iddetalleRueda0->idposicionRueda0->posicionRueda',
					'name'=>'iddetalleRueda',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				/*array(
					'header'=>'Fecha de renovación',
					'name'=>'fechaRealizada',
					'type'=>'raw',
					'value'=>'$data->valores($data->fechaRealizada)?date("d/m/Y",strtotime($data->fechaRealizada)):$data->noasignado()',
					'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
				),*/
				array(
					'header'=>'Estado',
					'name'=>'idestatus',
					'type'=>'raw',
					'value'=>'$data->color($data->idestatus,$data->idestatus0->estatus)',
					'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
				),
				/*array(
						'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;'),
						'htmlOptions'=>array('style'=>'text-align:center;'),
						'header'=>'Renovar',
						'type'=>'raw',
						'value'=>'CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Registrar renovacion")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{montarNeumatico("\'.Yii::app()->createUrl("neumaticos/montar",array("id"=>$data["id"])).\'");}\'
                        )
                );',),*/
			)
        ));
		
		
?>
<div id="divRenovacion" style="display:none">
<?php
		$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'nuevoMontaje',
				'summaryText'=>'',
				
				//se deben definir inicialmente los neumaticos que posee cada vehiculo
			   // 'enableSorting' => false,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>1,
				'emptyText'=>'No hay registros',
                'dataProvider'=>$nuevomont,
				'htmlOptions'=>array('style'=>'margin-top:10px;float: left;width:100%'),
				'columns'=>array(
				array(
					'type'=>"raw",
					'header'=>'Fecha de montaje',
					'value'=>'$data->fecha=="0000-01-01"?$data->porDefinir($data->fecha):date("d/m/Y",strtotime($data->fecha))',
					'name'=>'fecha',
					'htmlOptions'=>array('style'=>'text-align:center;width:5px'),
				),
				array(
					'type'=>"raw",
					'header'=>'Serial',
					'value'=>'$data->serial=="0"?$data->porDefinir($data->serial):strtoupper($data->serial);',
					'name'=>'serial',
					'htmlOptions'=>array('style'=>'text-align:center;width:65px'),
				),
				array(
					'type'=>'raw',
					'header'=>'Marca',
					'value'=>'$data->idmarcaCaucho==""?$data->porDefinir(""):$data->idmarcaCaucho0->nombre',
					'name'=>'idmarcaCaucho',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				
				array(
					'header'=>'Detalle',
					'value'=>'$data->idcaucho0->idmedidaCaucho0->medida.\' R\'.$data->idcaucho0->idrin0->rin.\' \'.$data->idcaucho0->idpiso0->piso',
					'name'=>'idcaucho',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'header'=>'Eje',
					'value'=>'$data->iddetalleRueda0->iddetalleEje0->idposicionEje0->posicionEje',
					'name'=>'iddetalleRueda',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'header'=>'Posición',
					'value'=>'$data->iddetalleRueda0->idposicionRueda0->posicionRueda',
					'name'=>'iddetalleRueda',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'header'=>'Costo',
					'value'=>'number_format($data->costounitario, 2,",",".").\' Bs.\'',
					'name'=>'costounitario',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'type'=>"raw",
					'headerHtmlOptions'=>array('style'=>'text-align:center;width:50px;'),
					'header'=>'Estatus',
					'value'=>'$data->coloresEstatus($data)',
					'name'=>'idestatusCaucho',
					'htmlOptions'=>array('style'=>'text-align:center;width:45px;font-weight: bold;'),
				),
				array(
						'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;'),
						'htmlOptions'=>array('style'=>'text-align:center;'),
						'header'=>'Editar',
						'type'=>'raw',
						'value'=>'CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{editarMontado("\'.Yii::app()->createUrl("neumaticos/EditarMontado",array("id"=>$data["id"])).\'");}\'
                        )
                );',),
			),
        ));
		
		echo CHtml::link('Renovar neumático', "",  // the link for open the dialog
    array(
		'id'=>"linkRenovacion",
        'style'=>'cursor: pointer; text-decoration: underline;display:none',
        'onclick'=>"{montarNeumatico(); }"));
		
		?>
</div>
</div> 
<?php }?>

 
 

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
        'width'=>390,
		'position'=>array(null,100),
        //'height'=>260,
		'resizable'=>false
    ),
));?>
<div class="divForForm"></div> 
<?php $this->endWidget();?>

<?php
/*ventana agregar recurso*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'recurso',
    'options'=>array(
        'title'=>'Agregar recurso',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>390,
		'position'=>array(null,100),
		'resizable'=>false
    ),
));?>
<div class="divForForm"></div>
 
<?php $this->endWidget();?>

<?php
/*ventana agregar recurso*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'montaje',
    'options'=>array(
        'title'=>'Registrar información de neumático nuevo',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>390,
		'position'=>array(null,100),
		'resizable'=>false
    ),
));?>
<div class="divForForm"></div>
<?php $this->endWidget();?>

<?php
/*ventana agregar recurso*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'montajeN',
    'options'=>array(
        'title'=>'Actualizar información',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>390,
		'position'=>array(null,100),
		'resizable'=>false
    ),
));?>
<div class="divForForm"></div>
<?php $this->endWidget();?>
<style>
.crugepanel {
    background-color: #FFF;
    border: 1px dotted #AAA;
    border-radius: 1px;
    box-shadow: 3px 3px 5px #EEE;
    display: block;
    margin-top: 10px;
    padding: 10px;
	overflow:auto;
}
.grid-view table.items tr.selected {
    background: none repeat scroll 0% 0% rgba(0, 249, 3, 0.3);
}
.grid-view table.items th {
	color: rgba(0, 0, 0, 1);
    text-align: center;
    background: none repeat scroll 0% 0% rgba(0, 138, 255, 0.15);
}
.grid-view table.items th a {
    color: #000;
    font-weight: bold;
    text-decoration: none;
}
.grid-view table.items td {
    font-size: 0.9em;
    border: 1px solid #5877C3;
    padding: 0.3em;
}
.grid-view table.items th, .grid-view table.items td {
    font-size: 0.9em;
    border: 1px solid #A8C5F0;
    padding: 0.3em;
}
.grid-view {
    padding: 10px 0;
}
</style>
<script>

var idfac=<?php echo $idfac?>;
var idAct;
var Uurl;
function editarMontado(id){
	
	$('#montajeN').dialog('open');
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
                                        $('#montajeN div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        $('#montajeN div.divForForm form').submit(editarMontado); 
                                }
                                else
                                {		
                                        $('#montajeN div.divForForm').html(data.div);
										 setTimeout("$('#montajeN').dialog('close') ",1000);
										$.fn.yiiGridView.update('nuevoMontaje');
										$.fn.yiiGridView.update('factu');
										
                                }
                        } ,
                'cache':false});
    return false; 
}
function facturarRot(id){
	
	$('#montajeN').dialog('open');
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
                                        $('#montajeN div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        $('#montajeN div.divForForm form').submit(facturarRot); 
                                }
                                else
                                {		
                                        $('#montajeN div.divForForm').html(data.div);
										 setTimeout("$('#montajeN').dialog('close') ",1000);
										$.fn.yiiGridView.update('rotaciones');
										$.fn.yiiGridView.update('factu');
										
                                }
                        } ,
                'cache':false});
    return false; 
}
function mostrarMovimientos(id){
	//idRotacion=id;
//$('#agregarRotacion').hide();
//var altura = $(document).height();
//$("html, body").animate({scrollTop:altura+"px"},500);
//$('#recur').show(500);
	$('#amovimiento').show();
	$("#rota").dialog('open');
	
	//$('#amovimiento').show(500);
	//var idr = $.fn.yiiGridView.getSelection('rotaciones');
	//if(idr=="")
		//$('#amovimiento').hide();
	$.fn.yiiGridView.update('movimientos',{ data : "idRot="+id});
	//$("html, body").animate({scrollTop:altura+"px"},1000);
}

function mostrarNuevoCaucho(){
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
function verificar(id){
	$.ajax({  		
          url: "<?php echo Yii::app()->baseUrl;?>"+"/neumaticos/verificarEstadoRenovacion/"+id,
        })
  	.done(function( result ) {    	
			if(result==3)
    	     $('#linkRenovacion').hide(500);
			if(result==4)
				$('#linkRenovacion').show(500);
  	});
}

function montarNeumatico(id){
	$('#montaje').dialog('open');
	 var idrenov = $.fn.yiiGridView.getSelection('renovaciones');
	 
	jQuery.ajax({
                url: "<?php echo Yii::app()->baseUrl."/neumaticos/montarNuevo/"?>"+idrenov,
                'data':$(this).serialize()+'&idfac='+idfac,
                'type':'post',
                'dataType':'json',
                'success':function(data)
                        {		
                                if (data.status == 'failure')
                                {
                                        $('#montaje div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        $('#montaje div.divForForm form').submit(montarNeumatico); 
                                }
                                else
                                {		
                                        $('#montaje div.divForForm').html(data.div);
										/*setTimeout(function() {
											
										}, 1000);*/
										 setTimeout("$('#montaje').dialog('close') ",1000);
										mostrarNuevoCaucho();
										$.fn.yiiGridView.update('renovaciones');
										
                                }
                        } ,
                'cache':false});
    return false; 
}
cargar();
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
var dir="<?php echo Yii::app()->baseUrl."/neumaticos/agregarFactura"?>";
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
function mostrarRecursos(id){
idAct=id;
//var altura = $(document).height();
//$("html, body").animate({scrollTop:altura+"px"},500);
$('#recur').show();
	$.fn.yiiGridView.update('rec',{ data : "idAct="+id});
	$("#dialog3").dialog("open");
}

function editarActividad(id){

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
                                        $('#dialog div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        $('#dialog div.divForForm form').submit(editarActividad); // updatePaymentComment
                                }
                                else
                                {
                                        $('#dialog div.divForForm').html(data.div);
                                        setTimeout("$('#dialog').dialog('close') ",1000);
                                        $.fn.yiiGridView.update('rec');
										$.fn.yiiGridView.update('factu');
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
	
	var url="<?php echo Yii::app()->baseUrl."/neumaticos/agregarRecursoAveria/"?>";
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
var Uurl;
function registrarMR(id){

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
                                        $('#dialog div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        $('#dialog div.divForForm form').submit(registrarMR); // updatePaymentComment
                                }
                                else
                                {
                                        $('#dialog div.divForForm').html(data.div);
										$.fn.yiiGridView.update('averias');
										$.fn.yiiGridView.update('renovaciones');
                                        setTimeout("$('#dialog').dialog('close') ",1000);
										//actualizarCheck(idorden);
                                }
                        } ,
                'cache':false});
    return false; 
}
</script>