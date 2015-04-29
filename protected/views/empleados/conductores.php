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
<div class='crugepanel '>
<div id="viaje" ></div>
</div>

<div class='crugepanel'>
<h1>Conductores asignados </h1>
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
					'header'=>'Fecha inicio',
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
					'headerHtmlOptions'=>array('style'=>'text-align:center;width:10px;'),
					'htmlOptions'=>array('style'=>'text-align:center;width:30px;'),
					'header'=>'Cambiar conductor',
					'type'=>'raw',
					'value'=>'CHtml::link(
                    CHtml::image(Yii::app()->request->baseUrl."/imagenes/cambiar.png",
                                      "Agregar",array("title"=>"Editar")),
                    "",
                    array(
                            \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                            \'onclick\'=>\'{cambiar("\'.Yii::app()->createUrl("empleados/cambiar",array("id"=>$data["id"])).\'");}\'
                    )
                );',),
				array(
					'header'=>'Eliminar',
					'class'=>'CButtonColumn',
					'deleteConfirmation'=>'¿Desea dejar la unidad sin conductor?',
					 'template'=>'{delete}',
					     'buttons'=>array(
							'delete' => array(
								'url'=>'Yii::app()->createUrl("Empleados/deleteAsignados", array("id"=>$data->id))',
								 
						),
					),
				),
			)
        ));
?>

</div>
<div class='crugepanel'>
<h1>Conductores registrados</h1>
<?php $this->widget('ext.selgridview.SelGridView', array(
                'id'=>'listaConductores',
				'summaryText'=>'',
				'selectableRows'=>1,
				'template'=>"{items}\n{summary}\n{pager}",
			    'enableSorting' => true,
				'emptyText'=>'no hay conductores asignados',
                'dataProvider'=>$empleados,
				'htmlOptions'=>array('style'=>'font-size: 1.0em;'),
				
				'columns'=>array(
				array(
					'header'=>'Nombre',
					'name'=>'nombre',
					//'value'=>'str_pad((int) $data->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT)',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center; '),
				),
				array(
					'header'=>'Apellido',
					'name'=>'apellido',
					//'value'=>'$data->idempleado0->nombre.\'  \'.$data->idempleado0->apellido',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center; '),
				),
				array(
					'header'=>'Cédula',
					'name'=>'cedula',
					//'value'=>'$data->idempleado0->nombre.\'  \'.$data->idempleado0->apellido',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center; '),
				),
				 array(
				 	'type'=>'raw',
					'header'=>'Activo',
					'name'=>'activo',
					'value'=>'$data->activo?\'<b><div style="color:green">Sí</div></b>\':\'<b><div style="color:red">No</div></b>\'',
					//'value'=>'$data->idempleado0->nombre.\'  \'.$data->idempleado0->apellido',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center; '),
				),
				/*array(
					'header'=>'Fecha de retiro',
					'name'=>'fechaFin',
					'value'=>'$data->fechaFin=="0000-00-00"?\'  \':$date("d/m/Y", strtotime($data->fechaFin));',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px;'),
				),*/
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;width:10px;'),
					'htmlOptions'=>array('style'=>'text-align:center;width:30px;'),
					'header'=>'Activo Si/No',
					'type'=>'raw',
					'value'=>'CHtml::link(
                    CHtml::image(Yii::app()->request->baseUrl."/imagenes/cambiar1.png",
                                      "Agregar",array("title"=>"Editar")),
                    "",
                    array(
                            \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                            \'onclick\'=>\'{Activo("\'.Yii::app()->createUrl("empleados/activo",array("id"=>$data["id"])).\'");}\'
                    )
                );',),
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
 
 <?php
/*ventana agregar recurso*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'renovar',
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
function Activo(id){
	if (typeof(id)=='string')
        Uurl=id;
	jQuery.ajax({
                url: Uurl,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
									alert(data.div);

                                }
                                else{
                                        
                                        //setTimeout("$('#viaje').dialog('close') ",1000);
                                        agregarChoferRuta();
										$.fn.yiiGridView.update('listaConductores');
                                }
                        },
                'cache':false});
    return false; 
}
var Uurl;
function cambiar(id){
	 $("#renovar").dialog("open");
	 if (typeof(id)=='string')
                Uurl=id;
	jQuery.ajax({
                url: Uurl,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data)
                        {
                                if (data.status == 'failure')
                                {
                                        $('#renovar div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        $('#renovar div.divForForm form').submit(cambiar); // updatePaymentComment
                                }
                                else
                                {
                                        $('#renovar div.divForForm').html(data.div);
                                        setTimeout("$('#renovar').dialog('close') ",1500);
                                        $.fn.yiiGridView.update('conductores');
                                }
                        } ,
                'cache':false});
    return false; 
}
</script>