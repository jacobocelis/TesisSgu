<?php
/* @var $this RepuestoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mantenimiento preventivo',
);
$this->menu=array(
	//if(Yii::app()->user->checkAccess('xxx')):
	array('label'=>'<div id="menu"><strong>Opciones de mantenimiento</strong></div>' , 'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_planes')),
	array('label'=>'      Registrar actividades de mantenimiento', 'url'=>array('planes') , 'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_planes')),
	array('label'=>'      Registrar matenimientos iniciales <span class="badge badge-'.$color.' pull-right">'.$mi.'</span>', 'url'=>array('mttoPreventivo/iniciales/') , 'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_iniciales')),
	array('label'=>'      Ajuste de fechas en calendario', 'url'=>array('calendario') , 'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_calendario')),
	//endif;
	
	array('label'=>'<div id="menu"><strong>Órdenes de mantenimiento</strong></div>'),
	array('label'=>'      Crear orden de mantenimiento', 'url'=>array('crearOrdenPreventiva') ,'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_crearOrdenPreventiva')),
	array('label'=>'      Ver órdenes abiertas <span class="badge badge-'.$Colorabi.' pull-right">'.$abiertas.'</span>', 'url'=>array('verOrdenes') ,'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_verOrdenes')),
	array('label'=>'      Órdenes listas para cerrar <span class="badge badge-'.$Colorli.' pull-right">'.$listas.'</span>', 'url'=>array('cerrarOrdenes'),'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_cerrarOrdenes')),
	
	array('label'=>'<div id="menu"><strong>Gestión de coordinadores</strong></div>' , 'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_coordinadores')),
	array('label'=>'      Coordinador operativo y de transporte', 'url'=>array('empleados/coordinadores') , 'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_coordinadores')),
	
	
	array('label'=>'<div id="menu"><strong>Historial</strong></div>'),
	array('label'=>'      Histórico de mantenimientos', 'url'=>array('historicoPreventivo') ,'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_historicoPreventivo')),
	array('label'=>'      Histórico de gastos', 'url'=>array('historicoGastos'),'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_historicoGastos')),
	array('label'=>'      Histórico de ordenes', 'url'=>array('historicoOrdenes'),'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_historicoOrdenes')),
);
?>
<div class='crugepanel user-assignments-role-list'>
<h1>Próximas actividades de mantenimiento a realizarse</h1>
<div id="filtro">
<select id="lista" >
			<option value="1">Éste mes</option>
			<option value="4">Atrasadas</option>
			<option value="2">En progreso</option>
			<option value="3">Todas</option>
		</select>
</div>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'head',
				'summaryText'=>'',
			    'enableSorting' => true,
				'emptyText'=>'No hay actividades de mantenimiento registradas',
                'dataProvider'=>$dataProvider,
				'rowCssClassExpression'=>'$this->dataProvider->data[$row]->diasRestantes($this->dataProvider->data[$row]->proximoFecha)<=5 || ($this->dataProvider->data[$row]->kmRestantes($this->dataProvider->data[$row]->idvehiculo,$this->dataProvider->data[$row]->proximoKm))<=50?"rojo":"even"',
				'ajaxUpdate'=>false,
				'columns'=>array(
				array(
					'header'=>'Unidad',
					'name'=>'idvehiculo',
					'value'=>'str_pad((int) $data->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:60px'),
				),
				array(
					'header'=>'Actividad',
					'name'=>'idactividadMtto',
					'value'=>'$data->idactividadMtto0->actividad',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px'),
				),
				array(
					'type'=>'raw',
					'header'=>'Último<br>mantenimiento realizado ',
					'name'=>'ultimoFecha',
					'value'=>'number_format($data->ultimoKm).\' Km<br> \'.date("d/m/Y",strtotime($data->ultimoFecha))',
					'htmlOptions'=>array('style'=>'width:100px;text-align:center;'),
					'headerHtmlOptions'=>array('style'=>'width:100px;font-size: 5px;line-height: 15px;'),
				),
				/*array(
					'header'=>'Último mantenimiento realizado',
					'name'=>'ultimoKm',
					'value'=>'$data->ultimoKm.\' Km \'',
					'htmlOptions'=>array('style'=>'width:100px;text-align:center;'),
				),*/
				array(
					'type'=>'raw',
					'header'=>'+Frecuencia=',
					'name'=>'frecuenciaKm',
					'value'=>'number_format($data->frecuenciaKm).\' Km \'.(number_format($data->frecuenciaMes) ? \'<br>ó \'.number_format($data->frecuenciaMes).\' \'.$data->idtiempof0->tiempo :\'\')',
					'htmlOptions'=>array('style'=>'width:50px;text-align:center;'),
				),
				array(
					'type'=>'raw',
					'header'=>'Próximo mantenimiento',
					'name'=>'proximoFecha',
					'value'=>'number_format($data->proximoKm).\' Km<br> \'.date("d/m/Y",strtotime($data->proximoFecha))',
					'htmlOptions'=>array('style'=>'width:100px;text-align:center;'),
				),
				/*array(
					'header'=>'Fecha de próximo mantenimiento',
					'name'=>'proximoFecha',
					'htmlOptions'=>array('style'=>'width:100px;text-align:center;'),
				),*/
				array(
					'type'=>'raw',
					'header'=>'Atraso',
					'name'=>'atraso',
					'value'=>'\'<b><span style="color:red">\'.$data->atraso($data->proximoFecha).\'</span></b><br><b><span style="color:red">\'.$data->atrasoKm($data->idvehiculo,$data->proximoKm).\'</span></b>\'',
					'htmlOptions'=>array('style'=>'width:60px;text-align:center;'),
				),
				array(
					'header'=>'Prioridad',
					'name'=>'idprioridad',
					'value'=>'$data->idprioridad0->prioridad',
					'htmlOptions'=>array('style'=>'width:70px;text-align:center;'),
				),
				
				array(
					'type'=>'raw',
					'header'=>'Kms restantes',
					'name'=>'frecuenciaKm',
					'value'=>'$data->kmRestantes($data->idvehiculo,$data->proximoKm)<=50?\'<strong><span style="color:red">\'.$data->kmRestantes($data->idvehiculo,$data->proximoKm).\'</span></strong>\':number_format($data->kmRestantes($data->idvehiculo,$data->proximoKm))',
					'htmlOptions'=>array('style'=>'width:60px;text-align:center;'),
				),
				array(
					'type'=>'raw',
					'header'=>'Días restantes',
					'name'=>'proximoKm',
					'value'=>'$data->diasRestantes($data->proximoFecha).$this->grid->Controller->createWidget("zii.widgets.jui.CJuiProgressBar",array(
								"value"=>intval($data->porcentaje($data->ultimoFecha,$data->proximoFecha)),
								"htmlOptions"=>array(
								"style"=>"width:80px; height:20px; float:right;background:#".$data->obtColor($data->diasRestantes($data->proximoFecha)))))->run()',
					'htmlOptions'=>array('style'=>'width:110px;text-align:center;'),
				),
				array(
					'header'=>'Estatus',
					'name'=>'idestatus',
					'value'=>'($data->idestatus==2 and ($data->proximoFecha<=date("Y-m-d") or $data->kmRestantes($data->idvehiculo,$data->proximoKm)<=0))?\'Retrasada\':$data->idestatus0->estatus',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px'),
				),
			)
        ));
		?>
</div>
<style>
#filtro{
	
	float:right;
}
select {
    width: 130px;
    background-color: #FFF;
    border: 1px solid #CCC;
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
background: none repeat scroll 0% 0% #FFD6D6;
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
<script>
var va="<?php echo $ca?>";
	$("#lista").val(va).change();
$( "#lista" ).change(function(){ 
	$.fn.yiiGridView.update('head',{ data : "filtro="+$(this).val()});
});
</script>