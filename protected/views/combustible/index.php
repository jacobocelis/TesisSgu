<?php
/* @var $this CombustibleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Combustible',
);

$this->menu=array(
	array('label'=>'Registrar reposición', 'url'=>array('create')),
	array('label'=>'Histórico de reposición', 'url'=>array('admin')),
	array('label'=>'Estadísticas', 'url'=>array('admin')),
);
?>
<h1>Última reposición de combustible</h1>
<?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'combustible',
				'summaryText'=>'',
			   
				'emptyText'=>'No registro de reposición',
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
					'header'=>'Litros',
					'name'=>'litros',
					//'value'=>'$data->idfalla0->falla',
					'htmlOptions'=>array('style'=>'text-align:center;width:25px'),
				),
				array(
					'header'=>'Conductor',
					'name'=>'idempleado',
					'value'=>'$data->idconductor0->nombre.\' \'.$data->idconductor0->apellido',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px'),
				),
				array(
					'header'=>'Estación',
					'name'=>'idestacionServicio',
					'value'=>'$data->idestacionServicio0->nombre',
					'htmlOptions'=>array('style'=>'text-align:center;width:60px'),
				),
				array(
					'type'=>'raw',
					'header'=>'Fecha',
					'name'=>'fecha',
					'value'=>'date("d/m/Y",strtotime($data->fecha))==date("d/m/Y",strtotime("today"))?\'<div id="verde">Hoy</div>\':\'+ \'.(date("d/m/Y",strtotime("now"))-date("d/m/Y",strtotime($data->fecha))).\' Días\'',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px'),
				),
			)
        ));
?>
<style>
#verde{
	color: #0FA526;
	font-weight: bold;
}
.grid-view table.items th {
    text-align: center;
    background: none repeat scroll 0% 0% rgba(0, 138, 255, 0.15);
	color: #000;
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