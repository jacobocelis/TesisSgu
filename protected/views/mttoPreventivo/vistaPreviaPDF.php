<div class='crugepanel user-assignments-role-list'>
	<h1>SIRCA</h1>
	<p>Empresa rental de la UNET</p>
	<p>RIF:G-200007525-2</p>
	<p>Gerencia de negocios Dpto. de transporte</p>
	<h1>Solicitud de servicio preventivo</h1>	
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
					'headerHtmlOptions'=>array('style'=>'width:100%;text-align:left;background:#F3FDA4'),
					'header'=>'Vehiculo',
					'value'=>'\'<strong>Unidad: </strong> #0\'.$data->numeroUnidad.\' \'.$data->idmodelo0->idmarca0->marca.\'  \'.$data->idmodelo0->modelo.\' \'.$data->anno.\' \'.$data->idcolor0->color',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:left;background:#F3FDA4'
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
						//'headerHtmlOptions'=>array('style'=>'width:80%;text-align:left;'),
						'header'=>'         Actividad',
						'value'=>'\'<strong>Actividad:</strong> \'.Plangrupo::model()->parte($data->idplan0->idplanGrupo).\' : \'.$data->idactividadMtto0->actividad',
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
				'columns'=>array(
					array(
						'headerHtmlOptions'=>array('style'=>'width:60%;text-align:left;'),
						'header'=>'<PRE>Recursos',
						'value'=>'\'\'.(($data->idinsumo == null?\'\':$data->idinsumo0->insumo).\'\'.($data->idrepuesto == null?\'\':$data->idrepuesto0->repuesto).\'\'.($data->idservicio == null?\'\':$data->idservicio0->servicio)).\'\'.$data->detalle',
						'htmlOptions'=>array('style'=>'text-align:left;width:200px'),
					), 
					
					array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;'),
					'header'=>'<PRE>Tipo',
					'value'=>'(($data->idinsumo == null?\'\':\'Insumo\').\'\'.($data->idrepuesto == null?\'\':\'Repuesto\').\'\'.($data->idservicio == null?\'\':\'Servicio\')).\' \'.$data->detalle',
					'htmlOptions'=>array('style'=>'text-align:center;'),
					//'footer'=>'',
				),
					array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;'),
					'header'=>'<PRE>Cantidad',
					'value'=>'$data->cantidad',
					'htmlOptions'=>array('style'=>'text-align:center;'),
					
					//'footer'=>'',
				),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;'),
					'header'=>'<PRE>Unidad',
					'value'=>'$data->idunidad0->unidad',
					'htmlOptions'=>array('style'=>'text-align:center;'),
					
					//'footer'=>'',
				),
			)
    ));
	}
}}
?>
		
</div>
<div class='crugepanel user-assignments-role-list' id="ob">
		Observaciones:<hr><hr><hr><hr><hr><hr>
		</div>
<style>
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
</style>
<style>
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

.grid-view .summary
{
	margin: 0 0 0px 0;
	text-align: right;
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