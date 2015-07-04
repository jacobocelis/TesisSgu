<div class='crugepanel user-assignments-role-list'>
	<div style="margin: 0px auto 0px;width:50px;">
	<IMG SRC="imagenes/logounet.png" style="width:50px;height:50px" ALT="">
	</div>
	<p>Universidad Nacional Experimental del Táchira</p>
	<p>Dirección de servicios generales</p>
	<p>Gerencia de negocios</p>
	<p>Departamento de transporte</p>
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
					'type'=>'raw',
					'headerHtmlOptions'=>array('style'=>'width:7%'),
					'header'=>'<PRE>Orden #</PRE>',
					//'name'=>'id',
					'value'=>'str_pad((int) $data->id,6,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:150px'),
				),
				array(
					'type'=>'raw',
					'header'=>'<PRE>Fecha y hora</PRE>',
					//'name'=>'fecha',
					'value'=>'date("d/m/Y h:i A",strtotime($data->fecha))',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px'),
				),
				/*array(
					'header'=>'Estado',
					//'name'=>'idestatus',
					'value'=>'$data->idestatus0->estatus',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px'),
				),*/
				array(
					'type'=>'raw',
					'header'=>'<PRE>Coordinador operativo</PRE>',
					//'name'=>'cOperativo',
					'value'=>'$data->cOperativo0->nombre.\'  \'.$data->cOperativo0->apellido',
					'htmlOptions'=>array('style'=>'text-align:center;width:80px'),
				),
				array(
					'type'=>'raw',
					'header'=>'<PRE>Coordinador de transporte</PRE>',
					//'name'=>'cTaller',
					'value'=>'$data->cTaller0->nombre.\'  \'.$data->cTaller0->apellido',
					'htmlOptions'=>array('style'=>'text-align:center;width:80px'),
				),
				array(
					'type'=>'raw',
					'header'=>'<PRE>Taller asignado</PRE>',
					//'name'=>'taller',
					'value'=>'$data->taller0->nombre',
					'htmlOptions'=>array('style'=>'text-align:center;width:80px'),
				),
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
				'htmlOptions'=>array('style'=>'width:100%'),
				'columns'=>array(
				array(
					'type'=>'raw',
					'headerHtmlOptions'=>array('style'=>'width:100%;text-align:left;background:#F3FDA4'),
					'header'=>'Vehiculo',
					'value'=>'\'<strong>Unidad: </strong> #0\'.$data->numeroUnidad.\' \'.$data->idmodelo0->idmarca0->marca.\'  \'.$data->idmodelo0->modelo.\' \'.$data->anno.\' \'.$data->idcolor0->color',
					'htmlOptions'=>array('style'=>'text-align:left;width:100%;background:#F3FDA4'),
			),
		)
    ));
	for($j=0;$j<$idvehiculoAver[$i]["totAct"];$j++){
	$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'fallas',
				//'selectionChanged'=>'validar',
				'summaryText'=>'',
				//'hideHeader'=>true,
			    'enableSorting' => true,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>0,
				'emptyText'=>'',
                'dataProvider'=>$actividadesAver[$i][$j],
				'columns'=>array(
					array(
					'type'=>'raw',
					'header'=>'Fecha avería',
					'value'=>'date("d/m/Y",strtotime($data->fechaFalla))',
					'htmlOptions'=>array('style'=>'text-align:center;width:80px'),
				),
				array(
					'type'=>'raw',
					'header'=>'Avería reportada',
					
					'value'=>'$data->idfallaCaucho==null?\' \':$data->idfallaCaucho0->falla',
					'htmlOptions'=>array('style'=>'text-align:center;width:200px'),
				),
				array(
					'type'=>'raw',
					'header'=>'Serial',
					
					'value'=>'$data->idhistoricoCaucho0->serial',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px'),
				),
				array(
					'type'=>'raw',
					'header'=>'Medida',
					'value'=>'$data->idhistoricoCaucho0->idcaucho0->idmedidaCaucho0->medida.\' R\'.$data->idhistoricoCaucho0->idcaucho0->idrin0->rin.\' \'.$data->idhistoricoCaucho0->idcaucho0->idpiso0->piso',
					'name'=>'idcaucho',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'type'=>'raw',
					'header'=>'Eje',
					'value'=>'$data->idhistoricoCaucho0->iddetalleRueda0->iddetalleEje0->idposicionEje0->posicionEje',
					
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'type'=>'raw',
					'header'=>'Lado',
					'value'=>'$data->idhistoricoCaucho0->iddetalleRueda0->idposicionRueda0->posicionRueda',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				
				array(
					'type'=>'raw',
					'header'=>'Reportó',
					'value'=>'$data->idempleado==""?\' \':$data->idempleado0->nombre.\' \'.$data->idempleado0->apellido',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px'),
				),
	
				array(
					'type'=>'raw',
					'header'=>'Comentario',
					'value'=>'$data->comentario',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px'),
				),
		)
    ));
	/*
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
						'headerHtmlOptions'=>array('style'=>'width:35%;text-align:left;'),
						'header'=>'<PRE>Recursos',
						'value'=>'\'\'.(($data->idinsumo == null?\'\':$data->idinsumo0->insumo).\'\'.($data->idrepuesto == null?\'\':$data->idrepuesto0->repuesto).\'\'.($data->idservicio == null?\'\':$data->idservicio0->servicio)).\'\'',
						'htmlOptions'=>array('style'=>'text-align:left;width:150px'),
					),
					array(
					'headerHtmlOptions'=>array('style'=>'text-align:left;'),
					'header'=>'<PRE>Tipo',
					'value'=>'(($data->idinsumo == null?\'\':\'Insumo\').\'\'.($data->idrepuesto == null?\'\':\'Repuesto\').\'\'.($data->idservicio == null?\'\':\'Servicio\')).\' \'',
					'htmlOptions'=>array('style'=>'width:40px;'),
					//'footer'=>'',
				),
					array(
					'headerHtmlOptions'=>array('style'=>'text-align:left;'),
					'header'=>'<PRE>Cantidad',
					'value'=>'$data->cantidad',
					'htmlOptions'=>array('style'=>'width:40px;'),
					
					//'footer'=>'',
					),
					array(
					'headerHtmlOptions'=>array('style'=>'text-align:left;'),
					'header'=>'<PRE>Unidad',
					'value'=>'$data->idunidad0->unidad',
					'htmlOptions'=>array('style'=>'width:40px;'),
					//'footer'=>'',
					),
					array(
					'headerHtmlOptions'=>array('style'=>'text-align:left; width:50px;'),
					'header'=>'<PRE>Costo unitario',
					'value'=>'number_format($data->costoUnitario, 2,",",".").\' Bs.\'',
					'htmlOptions'=>array('style'=>'width:50px;'),
					//'footer'=>'',
					),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:right;'),
					'header'=>'<PRE>Total',
					'value'=>'$data->costoTotal',
					'value'=>'number_format($data->costoTotal, 2,",",".").\' Bs.\'',
					'htmlOptions'=>array('style'=>'width:50px;text-align:right;'),
					//'footer'=>'',
				),
			)
		));
	}*/
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
			    'enableSorting' => false,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>0,
				'emptyText'=>'No hay ordenes listas para cerrar',
                'dataProvider'=>$vehiculosMont[$i],
				'columns'=>array(
				array(
					'type'=>'raw',
					'headerHtmlOptions'=>array('style'=>'width:100%;text-align:left;background:#F3FDA4'),
					'header'=>'Vehiculo',
					'value'=>'\'<strong>Unidad: </strong> #0\'.$data->numeroUnidad.\' \'.$data->idmodelo0->idmarca0->marca.\'  \'.$data->idmodelo0->modelo.\' \'.$data->anno.\' \'.$data->idcolor0->color',
					'htmlOptions'=>array('style'=>'text-align:left;width:100%;background:#F3FDA4'
				),
			),
		)
    ));
	
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
    ));	
}
?>
</div>
<?php }?>
<?php if($totalRot>0){?>
<div class='crugepanel user-assignments-role-list'>
<h2>Rotaciones</h2>
<?php
for($i=0;$i<$totalRot;$i++){
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'rota',
				'hideHeader'=>true,
				//'selectionChanged'=>'validar',
				'summaryText'=>'',
			    'enableSorting' => false,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>0,
				'emptyText'=>'No hay ordenes listas para cerrar',
                'dataProvider'=>$Rotaciones[$i],
				'htmlOptions'=>array('style'=>'padding: 0px 0px 15px;'),
				'columns'=>array(
				/*array(
					'type'=>'raw',
					'headerHtmlOptions'=>array('style'=>'width:7%;text-align:left;background:#F3FDA4'),
					'header'=>'Vehiculo',
					'value'=>'\'<strong>Unidad: </strong> #0\'.$data->numeroUnidad.\' \'.$data->idmodelo0->idmarca0->marca.\'  \'.$data->idmodelo0->modelo.\' \'.$data->anno.\' \'.$data->idcolor0->color',
					'htmlOptions'=>array('style'=>'text-align:left;width:100px;background:#F3FDA4'
				),
			),*/
			array(
					'header'=>'Nombre',
					'type'=>'raw',
					'name'=>'nombre',
					'value'=>'\' <strong>\'.$data->nombre.\'</strong>\'',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px;background:#F3FDA4'),
				),
				array(
					'type'=>'raw',
					'header'=>'Detalle',
					'value'=>'\' <strong>Detalle: </strong>\'.$data->descripcion',
					'name'=>'descripcion',
					'htmlOptions'=>array('style'=>'text-align:center;background:#F3FDA4'),
				),
		)
    ));?>
	<i><strong>Movimientos a realizar:</strong></i><?php
	$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'detallerot',
				//'selectionChanged'=>'validar',
				'summaryText'=>'',
				//'hideHeader'=>true,
			    'enableSorting' => true,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>0,
				'emptyText'=>'',
                'dataProvider'=>$actividadesRot[$i],
				'htmlOptions'=>array('style'=>'padding: 0px 0px 20px;'),
				'columns'=>array(
				array(
					'header'=>'Unidad',
					'value'=>'str_pad((int) $data->cauchoOrigen0->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:40px'),
				),
				array(
					'header'=>'Eje',
					'value'=>'$data->posicionOrigen==null?\'-\':$data->posicionOrigen0->iddetalleEje0->idposicionEje0->posicionEje',
					
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'header'=>'Lado',
					'value'=>'$data->posicionOrigen==null?\'Repuesto\':$data->posicionOrigen0->idposicionRueda0->posicionRueda',
					
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				/*array(
					'type'=>'raw',
					'header'=>'',
					'value'=>'\'<strong>Destino</strong>\'',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),*/
				array(
					'type'=>'raw',
					'header'=>'Movimiento',
					'value'=>'
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/arrow_right.png",
                                          "Movimiento",array("title"=>"desde->hacia"))',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'header'=>'Unidad',
					
					'value'=>'str_pad((int) $data->cauchoDestino0->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:40px'),
				),
				array(
					'header'=>'Eje',
					'value'=>'$data->posicionDestino==null?\'-\':$data->posicionDestino0->iddetalleEje0->idposicionEje0->posicionEje',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'header'=>'Lado',
					'value'=>'$data->posicionDestino==null?\'Repuesto\':$data->posicionDestino0->idposicionRueda0->posicionRueda',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
			)
    ));
}
?>
</div>
<?php }?>

<?php if(!isset($correo)){?>
<div class='crugepanel user-assignments-role-list' id="ob">Observaciones:<hr><hr><hr><hr><hr><hr></div>
<?php }?>

<style>
body {
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 14px;
    line-height: 20px;
    color: #333;
}
.list-view div.view {
    background: none repeat scroll 0% 0% rgba(54, 255, 41, 0.19);
}
.grid-view .summary {
    margin: 0px 0px 0px;
    text-align: right;
}
hr{
	margin-top: 10px;
}
#ob{
	height:150px;
}
strong {
    font-weight: bold;
    font-size: 115%;
}
pre {
    display: block;
    padding: 5.5px;
    margin: 0px 0px 10px;
    font-size: 13px;
    line-height: 20px;
    word-break: break-all;
    word-wrap: break-word;
    white-space: pre-wrap;
    background-color: #F5F5F5;
    border: 1px solid rgba(0, 0, 0, 0.15);
    border-radius: 4px;
}
.grid-view {
    padding: 0px 0px;
}
#menu{
	font-size:15px;
}
.grid-view table.items tr.selected {
    background: none repeat scroll 0% 0% rgba(0, 249, 3, 0.3);
}
.crugepanel {
    background-color: #FFF;
    border: 1px solid #AAA;
    border-radius: 1px;
    box-shadow: 3px 3px 5px #EEE;
    display: block;
    margin-top: 10px;
    padding: 10px;
}
p{
	text-align:center;
}
h1 {
    font-size: 150%;
    line-height: 40px;
	text-align:center;
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
    border: 1px solid #000;
    padding: 0.3em;
}
.grid-view table.items th, .grid-view table.items td {
    font-size: 0.9em;
    border: 1px solid #A8C5F0;
    padding: 0.3em;
}
.grid-view
{
	padding: 0px 0px;
}

.grid-view table.items
{
	background: white;
	border-collapse: collapse;
	width: 100%;
	border: 1px #D0E3EF solid;
}


.grid-view table.items th, .grid-view table.items td
{
	color: #000;
	font-size: 0.9em;
	border: 1px white solid;
	padding: 0.3em;
	border: 1px solid #94A8FF;
}

.grid-view table.items th
{
	color: black;
	background: #C6DDED;
	text-align: center;
}

.grid-view table.items th a
{
	color: black;
	font-weight: bold;
	text-decoration: none;
}

.grid-view table.items th a:hover
{
	color: black;
}

.grid-view table.items th a.asc
{
	background:url(up.gif) right center no-repeat;
	padding-right: 10px;
}

.grid-view table.items th a.desc
{
	background:url(down.gif) right center no-repeat;
	padding-right: 10px;
}

.grid-view table.items tr.even
{
	background: #F8F8F8;
}

.grid-view table.items tr.odd
{
	background: #E5F1F4;
}

.grid-view table.items tr.selected
{
	background: #BCE774;
}

.grid-view table.items tr:hover.selected
{
	background: #CCFF66;
}

.grid-view table.items tbody tr:hover
{
	background: #ECFBD4;
}

.grid-view .link-column img
{
	border: 0;
}

.grid-view .button-column
{
	text-align: center;
	width: 60px;
}

.grid-view .button-column img
{
	border: 0;
}

.grid-view .checkbox-column
{
	width: 15px;
}
.grid-view .pager
{
	margin: 5px 0 0 0;
	text-align: right;
}

.grid-view .empty
{
	font-style: italic;
}

.grid-view .filters input,
.grid-view .filters select
{
	width: 100%;
	border: 1px solid #ccc;
}
.grid-view table.items th {
	color: #000;
}
</style>