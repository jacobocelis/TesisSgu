<?php
/* @var $this RepuestoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Repuestos'=>array('repuesto/index'),
	'Histórico',
);

$this->menu=array(
	array('label'=>'<div id="menu"><strong>Repuestos</strong></div>' , 'visible'=>'1'),
	array('label'=>'      Repuestos y partes', 'url'=>array('repuesto/index')),
	
	array('label'=>'      Registrar repuesto', 'url'=>array('repuesto/create')),
	array('label'=>'      Asignación de repuestos', 'url'=>array('repuesto/AsignarPiezaGrupo')),
	array('label'=>'      Registrar repuestos iniciales <span class="badge badge- pull-right">0</span>', 'url'=>array('repuesto/iniciales/')),
	
	array('label'=>'<div id="menu"><strong>Histórial</strong></div>' , 'visible'=>'1'),
	array('label'=>'      Histórico de repuestos', 'url'=>array('repuesto/historico')),

	array('label'=>'<div id="menu"><strong>Administrar</strong></div>' , 'visible'=>'1'),
	array('label'=>'      Parámetros y datos maestros', 'url'=>array('repuesto/parametros')),
);
?>
<div class='crugepanel user-assignments-role-list'>
<h1>Histórico de repuestos</h1>

<div id="filtro" style="width:20%">
<i>Por # de unidad: </i>

		<?php $model=new Vehiculo;	
		echo CHtml::dropDownList('vehiculo',$model,CHtml::listData(Vehiculo::model()->findAll(),'id','numeroUnidad'),
              array('empty' => 'Todos',
                   'style'=>"width:80px;")); 
        ?>
</div>
<div id="fechas" style="float:left;">
<i>Por repuesto: </i>
<?php
$this->widget('zii.widgets.jui.CJuiAutoComplete',array(
    'name'=>'ajaxrequest',
	'id'=>'repuesto',
    // additional javascript options for the autocomplete plugin
    'options'=>array(
        'minLength'=>'1',
		
    ),
    'source'=>$this->createUrl("repuesto/buscarRepuesto"),
    'htmlOptions'=>array(
        'style'=>'height:20px;',
		'placeholder'=>"Ejemplo: Batería",
    ),
));
?>
		<?php echo CHtml::submitButton('Buscar',array("id"=>"boton","onclick"=>"Filtrar()","style"=>"float:right;margin-top:2px;margin-left:10px;")); ?>
</div>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'repdetalle',
				'summaryText'=>'',
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>1,
				'emptyText'=>'No hay repuestos asignados',
                'dataProvider'=>$det,
				'htmlOptions'=>array('style'=>'cursor:pointer;'),
				'columns'=>array(
				array(
					'header'=>'Unidad',
					'name'=>'idvehiculo',
					'value'=>'str_pad((int) $data->idCaracteristicaVeh0->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:20px'),
				),
				array(
					'header'=>'Placa',
					'name'=>'idvehiculo',
					'value'=>'$data->idCaracteristicaVeh0->idvehiculo0->placa',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:20px'),
				),
				array(
					'header'=>'Marca',
					'name'=>'idvehiculo',
					'value'=>'$data->idCaracteristicaVeh0->idvehiculo0->idmodelo0->idmarca0->marca',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:20px'),
				),
				array(
					'header'=>'Modelo',
					'name'=>'idvehiculo',
					'value'=>'$data->idCaracteristicaVeh0->idvehiculo0->idmodelo0->modelo',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:20px'),
				),
				array(
					'header'=>'Color',
					'name'=>'idvehiculo',
					'value'=>'$data->idCaracteristicaVeh0->idvehiculo0->idcolor0->color',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:20px'),
				),
				
				array(
					'header'=>'Repuesto',
					//'name'=>'codigoPiezaEnUso',
					//'value'=>'str_pad((int) $data->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					'value'=>'$data->idCaracteristicaVeh0->idrepuesto0->repuesto',
					'htmlOptions'=>array('style'=>'text-align:center;width:20px;color:green;'),
				),
				
				array(
					'header'=>'Detalle',
					'name'=>'detallePieza',
					//'value'=>'str_pad((int) $data->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:20px;color:green'),
				),
				array(
					'header'=>'Número de serial',
					'name'=>'codigoPiezaEnUso',
					//'value'=>'str_pad((int) $data->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:20px'),
				),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;width:50px;'),
					'header'=>'Evento',
					'name'=>'evento',
					'value'=>'$data->evento',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:20px'),
				),
				array(
					'header'=>'Fecha de evento',
					'name'=>'codigoPiezaEnUso',
					//'value'=>'str_pad((int) $data->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					'value'=>'$data->fechaIncorporacion=="0000-01-01"?"-":date("d/m/Y",strtotime($data->fechaIncorporacion))',
					'htmlOptions'=>array('style'=>'text-align:center;width:20px'),
				),
				/*array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;width:50px;'),
					'header'=>'Estado',
					'name'=>'estado',
					'value'=>'$data->estado',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:20px'),
				),*/


			)
        ));		?>
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
</style>
<script>
function Filtrar(){
	$.fn.yiiGridView.update('repdetalle',{ data : "&repuesto="+$("#repuesto").val()+"&vehiculo="+$("#vehiculo").val()});
}
</script>