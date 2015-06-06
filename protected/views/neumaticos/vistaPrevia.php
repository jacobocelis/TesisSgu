<?php 
	$this->breadcrumbs=array(
	'Neumáticos'=>array('neumaticos/index'),
	$nom=>array($dir),
	'Detalle de orden',
);
$this->menu=array(

	array('label'=>'<div id="menu"><strong>Opciones de orden</strong></div>'),
	array('itemOptions'=>array('id' => 'mDetalle'), 'label'=>'      Detalle de orden', 'url'=>array('neumaticos/vistaPrevia/'.$id.'?nom='.$nom.'&dir='.$dir.'')),
	array('label'=>'      Actualizar orden', 'url'=>array('neumaticos/mttonRealizados/'.$id.'?nom='.$nom.'&dir='.$dir.''),'visible'=>Yii::app()->controller->estatusOrden($id)<>7),
	array('label'=>'      Registrar facturación', 'url'=>array('neumaticos/registrarFacturacion/'.$id.'?nom='.$nom.'&dir='.$dir.''),'visible'=>Yii::app()->controller->estatusOrden($id)<>7),

	array('label'=>'<div id="menu"><strong>Órdenes de mantenimiento</strong></div>'),
	array('label'=>'      Crear orden de mantenimiento', 'url'=>array('neumaticos/crearOrdenCorrectiva') ,'visible'=>Yii::app()->user->checkAccess('action_neumaticos_crearOrdenCorrectiva')),
	array('label'=>'      Ver ordenes abiertas <span class="badge badge-'.$Colorabi.' pull-right">'.$abiertas.'</span>', 'url'=>array('neumaticos/verOrdenes') ,'visible'=>Yii::app()->user->checkAccess('action_neumaticos_verOrdenes')),
	array('label'=>'      Ordenes listas para cerrar <span class="badge badge-'.$Colorli.' pull-right">'.$listas.'</span>', 'url'=>array('neumaticos/cerrarOrdenes'),'visible'=>Yii::app()->user->checkAccess('action_neumaticos_cerrarOrdenes')),
	);
?>
<div class='crugepanel user-assignments-role-list'>
	<h1>Detalle de orden de neumáticos</h1>
	
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
					'header'=>'Cerrar órden',
					'value'=>'CHTML::checkBox("campo",0,array(\'id\'=>"campo$data->id",\'width\'=>4,\'maxlength\'=>2,\'onchange\'=>"return cerrar($data->id)"))',
					'type'=>'raw',
					'visible'=>$nom=='Cerrar órdenes'?true:false,
					'htmlOptions'=>array('style'=>'width: 50px;text-align: center'),
				),
				array(
					'type'=>'raw',
					'header'=>'Estado',
					//'name'=>'idestatus',
					'value'=>'$data->color($data->idestatus,$data->idestatus0->estatus)',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px'),
				),
				/*array(
						'headerHtmlOptions'=>array('style'=>'text-align:left;width:20px;text-align:center;'),
						'htmlOptions'=>array('style'=>'text-align:center;width:30px;'),
						'header'=>'Actualizar',
						'type'=>'raw',
						'value'=>'CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
										  
                        Yii::app()->createUrl("neumaticos/mttonRealizados", array("id"=>$data->id,"nom"=>"Órdenes abiertas","dir"=>"neumaticos/verOrdenes")),
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                        )
                );',),*/
			)
        ));
		?>
</div>
<?php if($totalVehAver>0){?>
<div class='crugepanel user-assignments-role-list'>
<h2>Averías</h2>
<?php
for($i=0;$i<$totalVehAver;$i++){
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'vehiculos',
				'hideHeader'=>true,
				//'selectionChanged'=>'validar',
				'summaryText'=>'',
			    'enableSorting' => true,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>0,
				'emptyText'=>'No hay ordenes listas para cerrar',
                'dataProvider'=>$vehiculosAver[$i],
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
	for($j=0;$j<$idvehiculoAver[$i]["totAct"];$j++){
	$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'fallas',
				//'selectionChanged'=>'validar',
				'summaryText'=>'',
				'hideHeader'=>true,
			    'enableSorting' => true,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>0,
				'emptyText'=>'',
                'dataProvider'=>$actividadesAver[$i][$j],
				'columns'=>array(
					array(
					'type'=>'raw',
					'header'=>'Fecha',
					'name'=>'fechaFalla',
					'value'=>'\'<strong>Fecha avería:</strong><br> \'.date("d/m/Y",strtotime($data->fechaFalla))',
					'htmlOptions'=>array('style'=>'text-align:center;width:80px'),
				),
				array(
					'type'=>'raw',
					'header'=>'Avería reportada',
					'name'=>'idfallacaucho',
					'value'=>'$data->idfallaCaucho==null?\' \':\'<strong>Avería reportada:</strong><br> \'.$data->idfallaCaucho0->falla',
					'htmlOptions'=>array('style'=>'text-align:center;width:200px'),
				),
				array(
					'type'=>'raw',
					'header'=>'Serial',
					'name'=>'idhistoricoCaucho',
					'value'=>'\'<strong>Serial:</strong><br> \'.$data->idhistoricoCaucho0->serial',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px'),
				),
				/*array(
					'type'=>'raw',
					'header'=>'Detalle',
					'value'=>'\'<strong>Medida: </strong><br>\'.$data->idhistoricoCaucho0->idcaucho0->idmedidaCaucho0->medida.\' R\'.$data->idhistoricoCaucho0->idcaucho0->idrin0->rin.\' \'.$data->idhistoricoCaucho0->idcaucho0->idpiso0->piso',
					'name'=>'idcaucho',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),*/
				array(
					'type'=>'raw',
					//'header'=>'Eje',
					'value'=>'$data->idhistoricoCaucho0->iddetalleRueda==null?\'<strong>Eje: </strong><br> - \':\'<strong>Eje: </strong><br>\'.$data->idhistoricoCaucho0->iddetalleRueda0->iddetalleEje0->idposicionEje0->posicionEje',
					'name'=>'iddetalleRueda',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'type'=>'raw',
					'header'=>'Posición',
					'value'=>'$data->idhistoricoCaucho0->iddetalleRueda==null?\'<strong>Lado: </strong><br> Repuesto \':\'<strong>Posición: </strong><br>\'.$data->idhistoricoCaucho0->iddetalleRueda0->idposicionRueda0->posicionRueda',
					'name'=>'iddetalleRueda',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				
				array(
					'type'=>'raw',
					'header'=>'Reportó',
					'name'=>'idempleado',
					'value'=>'$data->idempleado==""?\' \':\'<strong>Reportó: </strong><br>\'.$data->idempleado0->nombre.\' \'.$data->idempleado0->apellido',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px'),
				),
				array(
					'type'=>'raw',
					'header'=>'Estado',
					'name'=>'idestatus',
					'value'=>'\'<strong>Estatus: </strong><br>\'.$data->idestatus0->estatus',
					'htmlOptions'=>array('style'=>'text-align:center;width:60px'),
				),
				array(
					'type'=>'raw',
					'header'=>'Comentario',
					'name'=>'comentario',
					'value'=>'\'<strong>Comentario: </strong><br>\'.$data->comentario',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px'),
				),
		)
    ));
	if(count($recursosAver[$i][$j]->getData())>0){
	$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'recursos',
				//'selectionChanged'=>'validar',
				'summaryText'=>'',
			    'enableSorting' => true,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>0,
				'emptyText'=>'Esta actividad no tiene recursos asociados',
                'dataProvider'=>$recursosAver[$i][$j],
				'columns'=>array(
					array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;'),
					'header'=>'<PRE>Recurso</PRE>',
					'name'=>'idrecursoCaucho',
					'value'=>'$data->idrecursoCaucho0->recurso',
					'htmlOptions'=>array('style'=>'text-align:center;'),
					//'footer'=>'',
				),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;'),
					'header'=>'<PRE>Cantidad</PRE>',
					'name'=>'cantidad',
					'htmlOptions'=>array('style'=>'text-align:center;'),
					
					//'footer'=>'',
				),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;'),
					'header'=>'<PRE>Unidad</PRE>',
					'name'=>'idunidad',
					'value'=>'$data->idunidad0->corto',
					'htmlOptions'=>array('style'=>'text-align:center;'),
					//'footer'=>'',
				),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;'),
					'header'=>'<PRE>Precio unitario</PRE>',
					'value'=>'number_format($data->costoUnitario, 2,",",".").\' BsF.\'',
					'name'=>'costoUnitario',
					
					'htmlOptions'=>array('style'=>'text-align:center;'),
					//'footer'=>'',
				),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;'),
					'header'=>'<PRE>Total</PRE>',
					'name'=>'costoTotal',
					'value'=>'number_format($data->costoTotal, 2,",",".").\' Bs.\'',
					'htmlOptions'=>array('style'=>'text-align:center;'),
					//'footer'=>'',
				),
			)
		));
	}
	}
}

?>
</div><?php }?>
<?php if($totalVehMont>0){?>
<div class='crugepanel user-assignments-role-list'>
<h2>Renovaciones</h2>
<?php
for($i=0;$i<$totalVehMont;$i++){
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'vehiculos',
				'hideHeader'=>true,
				//'selectionChanged'=>'validar',
				'summaryText'=>'',
			    'enableSorting' => true,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>0,
				'emptyText'=>'',
                'dataProvider'=>$vehiculosMont[$i],
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
    ));?>
	<i>*Neumaticos anteriores:</i><?php
	$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'fallas2',
				//'selectionChanged'=>'validar',
				'summaryText'=>'',
				//'hideHeader'=>true,
			    'enableSorting' => true,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>0,
				'emptyText'=>'',
                'dataProvider'=>$actividadesMont[$i],
				'columns'=>array(
				
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
					'header'=>'Posición',
					'value'=>'$data->idhistoricoCaucho0->iddetalleRueda0->idposicionRueda0->posicionRueda',
					'name'=>'iddetalleRueda',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
			)
    ));?>
<?php if($mostrarNuevos){?>
<i>*Neumáticos nuevos:</i><?php
		$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'nuevos',
				//'selectionChanged'=>'validar',
				'summaryText'=>'',
				//'hideHeader'=>true,
			    'enableSorting' => true,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>0,
				'emptyText'=>'',
                'dataProvider'=>$actividadesMont[$i],
				'columns'=>array(
				
				array(
					'type'=>"raw",
					'header'=>'Serial',
					'value'=>'$data->idNuevoCaucho0->serial=="0"?$data->porDefinir($data->idNuevoCaucho0->serial):strtoupper($data->idNuevoCaucho0->serial);',
					//'name'=>'serial',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'type'=>'raw',
					'header'=>'Marca',
					'value'=>'$data->idNuevoCaucho0->idmarcaCaucho==""?$data->porDefinir(""):$data->idNuevoCaucho0->idmarcaCaucho0->nombre',
					'name'=>'idmarcaCaucho',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Detalle',
					'value'=>'$data->idNuevoCaucho0->idcaucho0->idmedidaCaucho0->medida.\' R\'.$data->idNuevoCaucho0->idcaucho0->idrin0->rin.\' \'.$data->idNuevoCaucho0->idcaucho0->idpiso0->piso',
					'name'=>'idcaucho',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Eje',
					'value'=>'$data->idNuevoCaucho0->iddetalleRueda0->iddetalleEje0->idposicionEje0->posicionEje',
					'name'=>'iddetalleRueda',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Posición',
					'value'=>'$data->idNuevoCaucho0->iddetalleRueda0->idposicionRueda0->posicionRueda',
					'name'=>'iddetalleRueda',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;'),
					'header'=>'Costo',
					'name'=>'costounitario',
					'value'=>'number_format($data->idNuevoCaucho0->costounitario, 2,",",".").\' Bs.\'',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
			)
    ));

}
?><?php }?>
</div>
<?php }?>



<?php
if(count($factura->getData())>0){?>
<div class='crugepanel user-assignments-role-list'>
<strong><i>*información de factura</i></strong>
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
<style>
.grid-view {
    padding: 0px 0px;
}
</style>
 
<script>

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
	var dir="<?php echo Yii::app()->baseUrl."/mttoCorrectivo/estatusOrden"?>";
		x=7;
	jQuery.ajax({
                url: dir+"/"+x,
                'data':$(this).serialize()+ '&id=' + orden,
                'type':'post',
                'dataType':'json',
				'success':function(){
					window.location.replace("<?php echo Yii::app()->baseUrl."/neumaticos/index"?>");	
				},
                'cache':false});			
	}
	$.fn.yiiGridView.update('ordenes');
}
var url="<?php echo Yii::app()->controller->action->id;?>";
if(url=="vistaPrevia")
	$("#mDetalle").addClass("active");
</script>