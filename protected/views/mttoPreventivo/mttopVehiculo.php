<?php 
$this->breadcrumbs=array(
	'Vehiculos'=>array('vehiculo/index'),
	'Mantenimiento preventivo unidad '.$id,
	
);
	$this->menu=array(
		
	array('label'=>'Registrar matenimientos iniciales <span class="badge badge-important pull-right">'.$mi.'</span>', 'url'=>array('mttoPreventivo/mttopIniciales/'.$id)),
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
				'columns'=>array(
				array(
					'header'=>'Parte',
					'name'=>'idplan',
					'value'=>'Plangrupo::model()->parte($data->idplan0->idplanGrupo)',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Actividad',
					'name'=>'actividad',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				
				array(
					'header'=>'Fecha de último mantenimiento realizado ',
					'name'=>'ultimoFecha',
					'htmlOptions'=>array('style'=>'width:100px;text-align:center;'),
					'headerHtmlOptions'=>array('style'=>'width:100px;font-size: 5px;line-height: 15px;'),
				),
				array(
					'header'=>'Último mantenimiento realizado',
					'name'=>'ultimoKm',
					'value'=>'$data->ultimoKm.\' Km \'',
					'htmlOptions'=>array('style'=>'width:100px;text-align:center;'),
				),
				array(
					'header'=>'+Frecuencia=',
					'name'=>'frecuenciaKm',
					'value'=>'$data->frecuenciaKm.\' Km \'.($data->frecuenciaMes ? \'ó \'.$data->frecuenciaMes.\' \'.$data->idtiempof0->tiempo :\'\')',
					'htmlOptions'=>array('style'=>'width:100px;text-align:center;'),
				),
				array(
					'header'=>'Próximo mantenimiento',
					'name'=>'proximoKm',
					'value'=>'$data->valores($data->ultimoKm) ? $data->ultimoKm.\' Km\' : \'  \'',
					'htmlOptions'=>array('style'=>'width:100px;text-align:center;'),
				),
				array(
					'header'=>'Fecha de próximo mantenimiento',
					'name'=>'proximoFecha',
					'htmlOptions'=>array('style'=>'width:100px;text-align:center;'),
				),
				array(
					'header'=>'Atraso',
					'name'=>'atraso',
					'htmlOptions'=>array('style'=>'width:60px;text-align:center;'),
				),
				array(
					'header'=>'Prioridad',
					'name'=>'idprioridad',
					'value'=>'$data->idprioridad0->prioridad',
					'htmlOptions'=>array('style'=>'width:70px;text-align:center;'),
				),
			)
        ));
		
?>
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