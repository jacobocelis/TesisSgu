<?php
/* @var $this CombustibleController */
/* @var $model Historicocombustible */

$this->breadcrumbs=array(
	'Combustible'=>array('index'),
	'Histórico',
);

$this->menu=array(
	array('label'=>'      Autonomía de combustible', 'url'=>array('autonomia')),
	array('label'=>'      Histórico de reposición', 'url'=>array('admin')),
	array('label'=>'      Estadísticas', 'url'=>array('admin')),
);
?>
<div class='crugepanel user-assignments-detail'>
<h1>Histórico de reposiciones</h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'comb',
				'summaryText'=>'',
				'selectableRows'=>1,
				'template'=>"{items}\n{summary}\n{pager}",
				'emptyText'=>'no se han registrado reposiciones',
                'dataProvider'=>$dataProvider,
				'htmlOptions'=>array('style'=>'font-size: 1.0em;'),
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
					'header'=>'Costo Bs.',
					'name'=>'costoTotal',
					//'value'=>'$data->idfalla0->falla',
					'htmlOptions'=>array('style'=>'text-align:center;width:25px'),
				),
				array(
					'type'=>'raw',
					'header'=>'Combustible',
					'name'=>'idcombust',
					'value'=>'$data->idcombust0->tipo',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px'),
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
					'header'=>'Fecha reposición',
					'name'=>'fecha',
					'value'=>'date("d/m/Y",strtotime($data->fecha))',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px'),
				),
			)
        ));
?>
</div>
<style>
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
#lista{
	width:50px;
}
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
