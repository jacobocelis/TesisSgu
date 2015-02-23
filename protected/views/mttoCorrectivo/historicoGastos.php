<?php
/* @var $this RepuestoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mantenimiento correctivo'=>array('mttoCorrectivo/index'),
	'Histórico de mantenimientos',
);
$this->menu=array(
	array('label'=>'<div id="menu"><strong>Opciones de mantenimiento</strong></div>'),
	array('label'=>'      Registro de fallas', 'url'=>array('registrarFalla')),
	array('label'=>'      Registro de mejoras', 'url'=>array('registrarMejora')),
	//array('label'=>'      Registrar matenimientos iniciales <span class="badge badge-'.$color.' pull-right">'.$mi.'</span>', 'url'=>array('mttoPreventivo/iniciales/')),
	//array('label'=>'      Ajuste de fechas en calendario', 'url'=>array('calendario')),
	
	
	array('label'=>'<div id="menu"><strong>Órdenes de mantenimiento</strong></div>'),
	array('label'=>'      Crear orden de mantenimiento', 'url'=>array('crearOrdenCorrectiva')),
	array('label'=>'      Ver órdenes abiertas <span class="badge badge-'.$Colorabi.' pull-right">'.$abiertas.'</span>', 'url'=>array('verOrdenes')),
	array('label'=>'      Órdenes listas para cerrar <span class="badge badge-'.$Colorli.' pull-right">'.$listas.'</span>', 'url'=>array('cerrarOrdenes')),
	
	array('label'=>'<div id="menu"><strong>Gestión de coordinadores</strong></div>'),
	array('label'=>'      Coordinador operativo y de transporte', 'url'=>array('empleados/coordinadores')),
	
	
	array('label'=>'<div id="menu"><strong>Historial</strong></div>'),
	array('label'=>'      Histórico de mantenimientos', 'url'=>array('historicoCorrectivo')),
	array('label'=>'      Histórico de gastos', 'url'=>array('mttoCorrectivo/historicoGastos')),
	array('label'=>'      Histórico de ordenes', 'url'=>array('historicoOrdenes')),
);
?>
<div class='crugepanel user-assignments-role-list'>
<h1>Histórico de gastos y consumos</h1>
<?php 
			$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'rec',
			'selectableRows'=>1,
			'dataProvider'=>$dataProvider,
			'enablePagination' => false,
			'template'=>"{items}{summary}{pager}",
			'emptyText' => 'no hay recursos agregados',
			'summaryText' => '',
			'columns'=>array(
				array(
					'header'=>'Unidad',
					
					'value'=>'str_pad((int) $data->idreporteFalla0->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:40px'),
				),
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
					'headerHtmlOptions'=>array('style'=>'text-align:left;'),
					'header'=>'Total',
					'name'=>'costoTotal',
					'value'=>'number_format($data->costoTotal, 2,",",".").\' Bs.\'',
					'htmlOptions'=>array('style'=>'width:50px;'),
					//'footer'=>'',
				),
				
			),
	));
			
/*$this->Widget('ext.highcharts.HighchartsWidget', array(
   'options'=>array(
		'chart'=>array(
			'type'=>'column'
		),
		'title' => array(
			'text' => 'Gastos por mes realizados en todas las unidades'
		),
		'xAxis' => array(
			'categories' => array('Enero', 'Febrero', 'Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre')
		),
		'yAxis' => array(
			'title' => array('text' => 'Costo(Bs.)')
		),
		'series' => array(
			array('name' => 'Preventivo', 'data' => array(57480, 74850, 25321,11227.77)),
			array('name' => 'Correctivo', 'data' => array(14150, 9480, 8142,7324.77))
      ),
	    'tooltip'=>array(
            'headerFormat'=>'<span style="font-size:10px">{point.key}</span><table>',
            'pointFormat'=>'<tr><td style="color:{series.color};padding:0">{series.name}: </td><td style="padding:0"><b>{point.y:.1f} Bs.</b></td></tr>',
            'footerFormat'=> '</table>',
            'shared'=> true,
            'useHTML'=> true,
        ),
   )
));*/

	?>
	</div>
<style>
.grid-view table.items th {
    color: #000;
    background: url('bg.gif') repeat-x scroll left top #FFF;
    text-align: center;
}
#menu{
	font-size:15px;

}
.crugepanel {
    background-color: #FFF;
    border: 1px dotted #AAA;
    border-radius: 1px;
    box-shadow: 3px 3px 5px #EEE;
    display: block;
    margin-top: 10px;
    padding: 10px;
}

.rojo{
background: none repeat scroll 0% 0% #CDFBCC;
}
.ui-progressbar .ui-widget-header {
	background: #FFF;
}
.ui-widget-header {
    border: 1px solid #AAA;
    background-image: url("<?php echo Yii::app()->request->baseUrl;?>/imagenes/imagen.png");
    color: #222;
    font-weight: bold;
}
.ui-progressbar {
    border: 0px none;
    border-radius: 0px;
    clear: both;
}
.progress, .ui-progressbar {
    height: 10px;
}
.ui-corner-all, .ui-corner-bottom, .ui-corner-right, .ui-corner-br {
    border-bottom-right-radius: 0px;
}
.ui-corner-all, .ui-corner-bottom, .ui-corner-left, .ui-corner-bl {
    border-bottom-left-radius: 0px;
}
.ui-corner-all, .ui-corner-top, .ui-corner-right, .ui-corner-tr {
    border-top-right-radius: 0px;
}
.ui-corner-all, .ui-corner-top, .ui-corner-left, .ui-corner-tl {
    border-top-left-radius: 0px;
}
</style>
<style>
.grid-view table.items th {
    text-align: center;
    background: none repeat scroll 0% 0% rgba(0, 138, 255, 0.15);
}
.grid-view table.items th a {
    color: #000!important;
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
</style>
