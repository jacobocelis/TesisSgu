<?php 
	$this->breadcrumbs=array(
	'Mantenimiento preventivo'=>array('mttoPreventivo/index'),
	'Crear orden preventiva',
);
	$this->menu=array(
	array('label'=>'Registrar mantenimiento realizado', 'url'=>array('')),
	array('label'=>'Ver órdenes abiertas <span class="badge badge- pull-right">0</span>', 'url'=>array('')),
	array('label'=>'Actualizar órdenes <span class="badge badge- pull-right">0</span>', 'url'=>array('')),
	array('label'=>'Cerrar órdenes', 'url'=>array('')),
	array('label'=>'Regresar', 'url'=>array('mttoPreventivo')),
);
?>

<div class='crugepanel user-assignments-role-list'>
	<h1>Seleccione las actividades a incluir en la orden de mantenimiento</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'actividades',
				'selectionChanged'=>'validar',
				'summaryText'=>'',
			    'enableSorting' => true,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>2,
				'emptyText'=>'No hay mantenimientos registrados',
                'dataProvider'=>$dataProvider,
				'ajaxUpdate'=>false,
				'columns'=>array(
				array(
					//'header'=>'Seleccione las actividades a incluir',
					'class'=>'CCheckBoxColumn',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'headerHtmlOptions'=>array('style'=>'width:7%'),
					'header'=>'Unidad',
					'name'=>'idplan',
					'value'=>'$data->idplan0->idvehiculo0->numeroUnidad',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:10px'),
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
								"style"=>"width:80%; height:20px; float:right;background:#".$data->obtColor($data->diasRestantes($data->proximoFecha)))))->run()',
					'htmlOptions'=>array('style'=>'width:110px;text-align:center;'),
				),
				
			)
        ));
		?>
		</div>
<div id='formulario' class='crugepanel user-assignments-role-list'>
<?php 
	$this->renderPartial('_formCrearOrden',array('model'=>$modeloOrdenMtto));?>
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
h1 {
    font-size: 250%;
    line-height: 40px;
}
.grid-view table.items th {
	color: rgba(0, 0, 0, 1);
    text-align: center;
    background: none repeat scroll 0% 0% rgba(0, 138, 255, 0.15);
}
.grid-view table.items th a {
    color: #000;
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
$('#formulario').hide();
function validar(){
var idAct = $.fn.yiiGridView.getSelection('actividades');
	if(idAct=="")
		$('#formulario').hide(500);
	else
		$('#formulario').show(500);

}

</script>