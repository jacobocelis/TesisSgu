<?php 
$this->breadcrumbs=array(
	'Vehiculos'=>array('vehiculo/index'),
	'Mantenimiento preventivo'=>array('vehiculo/'.$id),
	"Unidad ".$id,
);
	$this->menu=array(
	array('label'=>'Registrar matenimientos iniciales', 'url'=>array('')),
	array('label'=>'Registrar mantenimientos realizados', 'url'=>array('')),
	array('label'=>'Mantenimientos proximos a realizarse', 'url'=>array('')),
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
				'emptyText'=>'',
                'dataProvider'=>$dataProvider,
				'columns'=>array(
				array(
					'header'=>'Parte',
					'name'=>'idplan',
					'value'=>'$data->idplan0->idplanGrupo0->parte',
					//'htmlOptions'=>array('style'=>'width:380px;'),
				),
				array(
					'header'=>'Actividad',
					'name'=>'actividad',
					//'htmlOptions'=>array('style'=>'width:380px;'),
				),
				
				array(
					'header'=>'Último mantenimiento realizado fecha',
					'name'=>'ultimoFecha',
					'htmlOptions'=>array('style'=>'width:100px;'),
					'headerHtmlOptions'=>array('style'=>'width:100px;font-size: 5px;line-height: 15px;'),
				),
				array(
					'header'=>'Último mantenimiento realizado Km',
					'name'=>'ultimoKm',
					'htmlOptions'=>array('style'=>'width:100px;'),
				),
				array(
					'header'=>'+Frecuencia=',
					'name'=>'frecuenciaKm',
					//'value'=>'frecuenciaKm',
					'htmlOptions'=>array('style'=>'width:100px;'),
				),
				array(
					'header'=>'Próximo mantenimiento km',
					'name'=>'proximoKm',
					'htmlOptions'=>array('style'=>'width:100px;'),
				),
				array(
					'header'=>'Próximo mantenimiento fecha',
					'name'=>'proximoFecha',
					'htmlOptions'=>array('style'=>'width:100px;'),
				),
				array(
					'header'=>'Atraso',
					'name'=>'atraso',
					'htmlOptions'=>array('style'=>'width:100px;'),
				),
				array(
					'header'=>'Prioridad',
					'name'=>'data->idprioridad0->prioridad',
					'htmlOptions'=>array('style'=>'width:100px;'),
				),
			)
        ));
?>