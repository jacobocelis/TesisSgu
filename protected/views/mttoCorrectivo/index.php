<?php
/* @var $this RepuestoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mantenimiento correctivo',
);
$this->menu=array(
	array('label'=>'<div id="menu"><strong>Opciones de mantenimiento</strong></div>'),
	array('label'=>'      Registrar fallas en vehiculos', 'url'=>array('registrarFalla')),
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
	array('label'=>'      Histórico de gastos', 'url'=>array('historicoGastos')),
	array('label'=>'      Histórico de ordenes', 'url'=>array('historicoOrdenes')),
);

?>
<div class='crugepanel user-assignments-role-list'>
<h1>Listado de fallas reportadas en vehiculos</h1>
<div id="filtro">
<select id="lista" >
			<option value="1">Por atender</option>
			<option value="2">En progreso</option>
			<option value="3">Ejecutadas</option>
			<option value="3">Todas</option>
		</select>
</div>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'fallas',
				'summaryText'=>'',
			    'enableSorting' => true,
				'emptyText'=>'No hay fallas registradas',
                'dataProvider'=>$dataProvider,
				
			
				'columns'=>array(
				array(
					'header'=>'Unidad',
					'name'=>'idvehiculo',
					'value'=>'str_pad((int) $data->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:40px'),
				),
				array(
					'header'=>'Fecha',
					'name'=>'fechaFalla',
					'value'=>'date("d/m/Y",strtotime($data->fechaFalla))',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px'),
				),
			
				array(
					'header'=>'Falla reportada',
					'name'=>'idfalla',
					'value'=>'$data->idfalla0->falla',
					'htmlOptions'=>array('style'=>'text-align:center;width:250px'),
				),
				array(
					'header'=>'Reportó',
					'name'=>'idempleado',
					'value'=>'$data->idempleado0->nombre.\' \'.$data->idempleado0->apellido',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px'),
				),
				array(
					'header'=>'Estatus',
					'name'=>'idestatus',
					'value'=>'$data->idestatus0->estatus',
					'htmlOptions'=>array('style'=>'text-align:center;width:60px'),
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
$( "#lista" ).change(function() { 
	$.fn.yiiGridView.update('fallas',{ data : "filtro="+$(this).val()});
});
</script>