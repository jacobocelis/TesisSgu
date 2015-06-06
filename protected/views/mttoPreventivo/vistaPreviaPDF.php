<div class='crugepanel user-assignments-role-list'>
	<h1>Orden de mantenimiento preventivo</h1>
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
					'header'=>'Orden #',
					//'name'=>'id',
					'value'=>'str_pad((int) $data->id,6,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:80px'),
				),
				array(
					'type'=>'raw',
					'header'=>'Fecha y hora',
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
					'header'=>'Coordinador operativo',
					//'name'=>'cOperativo',
					'value'=>'$data->cOperativo0->nombre.\'  \'.$data->cOperativo0->apellido',
					'htmlOptions'=>array('style'=>'text-align:center;width:80px'),
				),
				array(
					'type'=>'raw',
					'header'=>'Coordinador de transporte',
					//'name'=>'cTaller',
					'value'=>'$data->cTaller0->nombre.\'  \'.$data->cTaller0->apellido',
					'htmlOptions'=>array('style'=>'text-align:center;width:80px'),
				),
				array(
					'type'=>'raw',
					'header'=>'Taller asignado',
					//'name'=>'taller',
					'value'=>'$data->taller0->nombre',
					'htmlOptions'=>array('style'=>'text-align:center;width:80px'),
				),
			)
        ));
		?>
</div>
<div class='crugepanel user-assignments-role-list'>
<h1>Actividades de mantenimiento a ejecutar</h1>
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
				'htmlOptions'=>array('style'=>'margin-top:1%'),
                'dataProvider'=>$vehiculos[$i],
				'columns'=>array(
				array(
					'type'=>'raw',
					'headerHtmlOptions'=>array('style'=>'width:7%;text-align:left;background:#F3FDA4'),
					'header'=>'Vehiculo',
					'value'=>'\'<strong>Unidad: </strong> #0\'.$data->numeroUnidad.\' \'.$data->idmodelo0->idmarca0->marca.\'  \'.$data->idmodelo0->modelo.\' \'.$data->anno.\' \'.$data->idcolor0->color',
					'htmlOptions'=>array('style'=>'text-align:left;width:100px;background:#F3FDA4'),
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
				'htmlOptions'=>array('style'=>'margin-left:0%'),
				'columns'=>array(
					array(
						'type'=>'raw',
						//'headerHtmlOptions'=>array('style'=>'width:10%;text-align:left;'),
						'header'=>'         Actividad',
						'value'=>'\'<strong>Actividad:</strong> \'.$data->idactividadMtto0->actividad',
						'htmlOptions'=>array('style'=>'text-align:left'),
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
				'htmlOptions'=>array('style'=>'margin-left:0%'),
				'columns'=>array(
					array(
						'headerHtmlOptions'=>array('style'=>'width:35%;text-align:left;'),
						'header'=>'<PRE>Recursos</PRE>',
						'value'=>'\'\'.(($data->idinsumo == null?\' \':$data->idinsumo0->insumo).\' \'.($data->idrepuesto == null?\' \':$data->idrepuesto0->repuesto).\' \'.($data->idservicio == null?\' \':$data->idservicio0->servicio)).\' \'.$data->detalle',
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
			)
    ));
	}
}}
?>
	
</div>
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