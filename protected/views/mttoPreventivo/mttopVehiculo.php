<?php 
$this->breadcrumbs=array(
	'Vehiculos'=>array('vehiculo/index'),
	'Mantenimiento preventivo unidad '.$id,
	
);
	$this->menu=array(
		
	array('label'=>'Registrar matenimientos iniciales <span class="badge badge-'.$color.' pull-right">'.$mi.'</span>', 'url'=>array('mttoPreventivo/mttopIniciales/'.$id)),
	array('label'=>'Registrar mantenimientos realizados', 'url'=>array(''),),
	array('label'=>'Mantenimientos proximos a realizarse','url'=>array('')),
	array('label'=>'Histórico de mantenimientos', 'url'=>array('')),
	array('label'=>'Regresar', 'url'=>array('vehiculo/'.$id)),
);

?>
<div class='crugepanel user-assignments-role-list'>
	<h1><?php echo ucfirst(CrugeTranslator::t("Próximos mantenimientos a realizarse"));?></h1>
</div>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'head',
				'summaryText'=>'',
			    'enableSorting' => true,
				'emptyText'=>'No hay mantenimientos registrados',
                'dataProvider'=>$dataProvider,
				'ajaxUpdate'=>false,
				'columns'=>array(
				array(
					'header'=>'Parte',
					'name'=>'idplan',
					'value'=>'Plangrupo::model()->parte($data->idplan0->idplanGrupo)',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:150px'),
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
					'value'=>'\'<b><span style="color:red">\'.$data->atraso($data->proximoFecha).\'</span></b>\'',
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
					'header'=>'Días restantes',
					'name'=>'proximoKm',
					'value'=>'$data->diasRestantes($data->proximoFecha).$this->grid->Controller->createWidget("zii.widgets.jui.CJuiProgressBar",array(
								"value"=>intval($data->porcentaje($data->ultimoFecha,$data->proximoFecha)),
								"htmlOptions"=>array(
								"style"=>"width:80px; height:20px; float:right;background:#".$data->obtColor($data->diasRestantes($data->proximoFecha)))))->run()',
					'htmlOptions'=>array('style'=>'width:110px;text-align:center;'),
				),
			)
        ));
		?>

<style>
.ui-progressbar .ui-widget-header {
	background: #FFF;
}
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
<style>
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
    margin-bottom: 20px;
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