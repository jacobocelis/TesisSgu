<?php
/* @var $this RepuestoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Neumáticos'=>array('neumaticos/index'),
	'Histórico de averías reparadas',
);
$this->menu=array(
	array('label'=>'<div id="menu"><strong>Neumáticos</strong></div>'),
	array('label'=>'      Plantillas de montaje', 'url'=>array('plantilla')),
	array('label'=>'      Montajes iniciales <span title="hay '.$iniciales.' montajes iniciales por definir" class="badge badge-'.$this->Color($iniciales).' pull-right">'.$iniciales.'</span>', 'url'=>array('montajeInicial')),
	
	array('label'=>'<div id="menu"><strong>Averías</strong></div>'),
	array('label'=>'      Registro de averías', 'url'=>array('averiaNeumatico')),
	
	array('label'=>'      Averías por atender <span title="hay '.$totalFalla.' averías en neumaticos por atender" class="badge badge-'.$this->Color($totalFalla).' pull-right">'.$totalFalla.'</span>', 'url'=>array('crearOrdenNeumaticos')),
	
	
	array('label'=>'<div id="menu"><strong>Órdenes de neumaticos</strong></div>'),
	
	array('label'=>'      Crear órden de neumaticos', 'url'=>array('crearOrdenNeumaticos')),
	array('label'=>'      Ver órdenes abiertas <span class="badge badge-'.$this->Color($abiertas).' pull-right">'.$abiertas.'</span>', 'url'=>array('verOrdenes')),
	array('label'=>'      Órdenes listas para cerrar <span class="badge badge-'.$this->Color($listas).' pull-right">'.$listas.'</span>', 'url'=>array('cerrarOrdenes')),
	
	
	array('label'=>'<div id="menu"><strong>Historial</strong></div>'),
	array('label'=>'      Histórico de averías', 'url'=>array('historicoAverias')),
	array('label'=>'      Histórico de montajes', 'url'=>array('historicoMontajes')),
	array('label'=>'      Histórico de rotaciones', 'url'=>array('historicoRotaciones')),
	array('label'=>'      Histórico de gastos', 'url'=>array('historicoGastos')),
	array('label'=>'      Histórico de ordenes', 'url'=>array('historicoOrdenes')),
	
	array('label'=>'<div id="menu"><strong>Parámetros</strong></div>'),
	array('label'=>'      Admin. de parámetros', 'url'=>array('')),
);
?>
<div class='crugepanel user-assignments-role-list'>
<h1>Histórico de averías reparadas</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'head',
				'summaryText'=>'',
			    'enableSorting' => true,
				'emptyText'=>'No hay averías reparadas',
                'dataProvider'=>$dataProvider,
				
				'columns'=>array(
				array(
					'header'=>'Unidad',
					'name'=>'idvehiculo',
					'value'=>'str_pad((int) $data->idhistoricoCaucho0->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:40px'),
				),
				array(
					'header'=>'Fecha reporte',
					'name'=>'fechaFalla',
					'value'=>'date("d/m/Y",strtotime($data->fechaFalla))',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px'),
				),
			
				array(
					'header'=>'Falla reportada',
					'name'=>'idfalla',
					'value'=>'$data->idfallaCaucho0->falla',
					'htmlOptions'=>array('style'=>'text-align:center;width:250px'),
				),
				array(
					'header'=>'Reportó',
					'name'=>'idempleado',
					'value'=>'$data->idempleado0->nombre.\' \'.$data->idempleado0->apellido',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px'),
				),
				array(
					'header'=>'Fecha reparada',
					'name'=>'fechaRealizada',
					'value'=>'date("d/m/Y",strtotime($data->fechaRealizada))',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px'),
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
