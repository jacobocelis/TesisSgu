<?php
/* @var $this ViajesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Viajes'=>array('viajes/index'),
	'Viajes rutinarios',
);

$this->menu=array(
	
	array('label'=>'<div id="menu"><strong>Historial</strong></div>'),
	array('label'=>'      Histórico de conductores', 'url'=>array('admin')),
	array('label'=>'      Estadísticas de conductores', 'url'=>array('admin')),
);
?>
<div class='crugepanel user-assignments-detail'>
<h1>Registro y asignación de conductores</h1>
		

<div id="viaje" class='crugepanel user-assignments-detail'></div>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'viajes',
				'summaryText'=>'',
				'selectableRows'=>1,
				'template'=>"{items}\n{summary}\n{pager}",
			    'enableSorting' => true,
				'emptyText'=>'no hay viajes registrados para ésta fecha',
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
				array(
					'header'=>'Fecha de retiro',
					'name'=>'fechaFin',
					'value'=>'$data->fechaFin=="0000-00-00"?\'  \':$date("d/m/Y", strtotime($data->fechaFin));',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px;'),
				),
				
				array(
						'headerHtmlOptions'=>array('style'=>'text-align:center;width:10px;'),
						'htmlOptions'=>array('style'=>'text-align:center;width:30px;'),
						'header'=>'Modificar',
						'type'=>'raw',
						'value'=>'CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{editarViaje("\'.Yii::app()->createUrl("Viajes/update",array("id"=>$data["id"])).\'"); $("#modificar").dialog("open");}\'
                        )
                );',),
				array(
					'header'=>'Eliminar',
					'class'=>'CButtonColumn',
					 'template'=>'{delete}',
					     'buttons'=>array(
							'delete' => array(
								'url'=>'Yii::app()->createUrl("empleado/delete", array("id"=>$data->id))',
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
    'id'=>'modificar',
    'options'=>array(
        'title'=>'modificar datos del viaje',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>390,
		'position'=>array(500,100),
		'resizable'=>false
    ),
));?>
<div class="divForForm"></div>
 
<?php $this->endWidget();?>
<style>
.badge {
    margin-left: 3px;
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
#menu {
    font-size: 15px;
}
#etiqueta{
	width: auto;
	float: left;
    height: 35px;
}
</style>
<style>
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
                                        $('#viaje').html(data.div);
                                        //setTimeout("$('#viaje').dialog('close') ",1000);
                                        window.setTimeout('agregarChoferRuta()', 2000);
										$.fn.yiiGridView.update('viajes');
                                }
                        },
                'cache':false});
    return false; 
}
</script>