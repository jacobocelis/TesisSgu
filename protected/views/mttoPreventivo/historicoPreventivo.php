<?php
/* @var $this RepuestoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mantenimiento preventivo'=>array('mttoPreventivo/index'),
	'Histórico de mantenimientos',
);
$this->menu=array(
	array('label'=>'<div id="menu"><strong>Historial</strong></div>'),
	
	array('label'=>'      Histórico de mantenimientos', 'url'=>array('historicoPreventivo')),
	array('label'=>'      Histórico de gastos', 'url'=>array('historicoGastos')),
	array('label'=>'      Histórico de ordenes', 'url'=>array('historicoOrdenes')),
);
?>
<div class='crugepanel user-assignments-role-list'>
<h1>Histórico de mantenimientos realizados</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'head',
				'summaryText'=>'',
			    'enableSorting' => true,
				'emptyText'=>'No hay mantenimientos realizados',
                'dataProvider'=>$dataProvider,
				
				
				'columns'=>array(
				array(
					'header'=>'Unidad',
					'name'=>'idplan',
					'value'=>'str_pad((int) $data->idplan0->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:60px'),
				),
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
					'header'=>'Fecha programada',
					'name'=>'proximoFecha',
					'value'=>'date("d/m/Y",strtotime($data->proximoFecha))',
					'htmlOptions'=>array('style'=>'width:100px;text-align:center;'),
					'headerHtmlOptions'=>array('style'=>'width:100px;font-size: 5px;line-height: 15px;'),
				),
				array(
					'type'=>'raw',
					'header'=>'Fecha realizada',
					'name'=>'fechaRealizada',
					'value'=>'date("d/m/Y",strtotime($data->fechaRealizada))',
					'htmlOptions'=>array('style'=>'width:100px;text-align:center;'),
					'headerHtmlOptions'=>array('style'=>'width:100px;font-size: 5px;line-height: 15px;'),
				),
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
					'header'=>'Estado',
					'name'=>'idestatus',
					'type'=>'raw',
					'value'=>'$data->color($data->idestatus,$data->idestatus0->estatus)',
					'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
				),
			)
        ));
		?>
		
		
</div>
<style>
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
