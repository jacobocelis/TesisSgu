<?php
/* @var $this ViajesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Viajes'=>array('viajes/index'),
	'Viajes rutinarios',
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
	array('label'=>'      Coordinadores', 'url'=>array('empleados/coordinadores')),
	array('label'=>'      Proveedores', 'url'=>array('empleados/proveedores')),
);
?>
<div class='crugepanel user-assignments-detail'>
<h1>Coordinadores</h1>
	
<div id="viaje" style='width:500px'></div>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'coordinadores',
				'summaryText'=>'',
				'selectableRows'=>1,
				'template'=>"{items}\n{summary}\n{pager}",
			    'enableSorting' => true,
				'emptyText'=>'no hay coordinadores registrados',
                'dataProvider'=>$dataProvider,
				'htmlOptions'=>array('style'=>'font-size: 1.0em;'),
				
				'columns'=>array(
				array(
					'header'=>'Nombre',
					'name'=>'nombre',
					'value'=>'$data->nombre.\' \'.$data->apellido',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
			

				array(
					'header'=>'Cédula',
					'name'=>'cedula',
					'value'=>'number_format($data->cedula, 0,",",".")',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Cargo',
					'name'=>'idtipoEmpleado',
					'value'=>'$data->idtipoEmpleado0->tipo',
					'htmlOptions'=>array('style'=>'text-align:center;'),
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
                                \'onclick\'=>\'{editar("\'.Yii::app()->createUrl("empleados/actualizarCoordinador",array("id"=>$data["id"])).\'"); $("#coordinador").dialog("open");}\'
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
    'id'=>'coordinador',
    'options'=>array(
        'title'=>'modificar datos',
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
	var dir="<?php echo Yii::app()->baseUrl."/empleados/agregarCoordinador/"?>";
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
                                        //$('#viaje').html(data.div);
                                        //setTimeout("$('#viaje').dialog('close') ",1000);
                                        agregarChoferRuta();
										$.fn.yiiGridView.update('coordinadores');
                                }
                        },
                'cache':false});
    return false; 
}
function editar(id){

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
                                        $('#coordinador div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        //$('#dialog div.divForForm form').submit(agregarActividad); // updatePaymentComment
										$('#coordinador div.divForForm form').submit(editar);
                                }
                                else
                                {
                                        $('#coordinador div.divForForm').html(data.div);
                                        //setTimeout("agregarActividad()",1000);
                                        $('#coordinador').dialog('close');
                                        $.fn.yiiGridView.update('coordinadores');
										
                                }
                        } ,
                'cache':false});
    return false; 
}
</script>