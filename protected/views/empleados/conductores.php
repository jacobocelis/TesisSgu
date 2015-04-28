<?php
/* @var $this ViajesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Viajes'=>array('viajes/index'),
	'Conductores',
);

$this->menu=array(
	
	array('label'=>'<div id="menu"><strong>Viajes</strong></div>'),
	array('label'=>'      Registrar viajes rutinarios', 'url'=>array('viajes/rutinarios')),
	array('label'=>'      Registrar viajes especiales', 'url'=>array('viajes/especiales')),

	
	array('label'=>'<div id="menu"><strong>Historial</strong></div>'),
	array('label'=>'      Histórico de viajes rutinarios', 'url'=>array('viajes/historicoRutinarios')),
	array('label'=>'      Histórico de viajes especiales', 'url'=>array('viajes/historicoEspeciales')),
	array('label'=>'      Histórico de conductores', 'url'=>array('empleados/historicoConductores')),
	array('label'=>'<div id="menu"><strong>Administrar</strong></div>' , 'visible'=>'1'),
	array('label'=>'      Parámetros y datos maestros', 'url'=>array('viajes/parametros')),
	array('label'=>'      Gestión de conductores', 'url'=>array('empleados/conductores')),
);
?>
<div class='crugepanel user-assignments-detail'>
<div id="viaje" ></div>
</div>
<div class='crugepanel user-assignments-detail'>
<h1>Lista de conductores asignados a cada unidad</h1>
<?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'conductores',
				'summaryText'=>'',
				'selectableRows'=>1,
				'template'=>"{items}\n{summary}\n{pager}",
			    'enableSorting' => true,
				'emptyText'=>'no hay conductores asignados',
                'dataProvider'=>$dataProvider,
				'htmlOptions'=>array('style'=>'font-size: 1.0em;'),
				
				'columns'=>array(
				array(
					'header'=>'Unidad',
					'name'=>'idvehiculo',
					'value'=>'str_pad((int) $data->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT)',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px;'),
				),
				array(
					'header'=>'Conductor asignado',
					'name'=>'idempleado',
					'value'=>'$data->idempleado0->nombre.\'  \'.$data->idempleado0->apellido',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px;'),
				),

				array(
					'header'=>'Fecha de asignación',
					'name'=>'fechaInicio',
					'value'=>'date("d/m/Y", strtotime($data->fechaInicio));',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px;'),
				),
				/*array(
					'header'=>'Fecha de retiro',
					'name'=>'fechaFin',
					'value'=>'$data->fechaFin=="0000-00-00"?\'  \':$date("d/m/Y", strtotime($data->fechaFin));',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px;'),
				),*/
 
				array(
					'header'=>'Eliminar',
					'class'=>'CButtonColumn',
					 'template'=>'{delete}',
					     'buttons'=>array(
							'delete' => array(
								'url'=>'Yii::app()->createUrl("historicoempleados/delete", array("id"=>$data->id))',
						),
					),
				),
			)
        ));
?>

</div>

<?php
/*ventana agregar recurso*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'conductor',
    'options'=>array(
        'title'=>'Datos del conductor',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>390,
		'position'=>array(500,100),
		'resizable'=>false
    ),
));?>
<div class="divForForm"></div>
 
<?php $this->endWidget();?>
 
<script>
agregarChoferRuta();
function agregarChoferRuta(){
	var dir="<?php echo Yii::app()->baseUrl."/empleados/agregarConductorRuta/"?>";
	jQuery.ajax({
                url: dir,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
								
                                        $('#viaje').html(data.div);
                                        $('#viaje form').submit(agregarChoferRuta);
                                }
                                else{
                                        
                                        //setTimeout("$('#viaje').dialog('close') ",1000);
                                        agregarChoferRuta();
										$.fn.yiiGridView.update('conductores');
                                }
                        },
                'cache':false});
    return false; 
}
</script>