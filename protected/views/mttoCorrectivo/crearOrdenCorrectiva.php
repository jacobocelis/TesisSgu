<?php 
	$this->breadcrumbs=array(
	'Mantenimiento preventivo'=>array('mttoCorrectivo/index'),
	'Crear orden correctiva',
);
$this->menu=array(
	array('label'=>'<div id="menu"><strong>Opciones de mantenimiento</strong></div>'),
	array('label'=>'      Incidentes reportados', 'url'=>array('mttoCorrectivo/index')),
	array('label'=>'      Registro de incidentes', 'url'=>array('registrarFalla')),
	array('label'=>'      Registro de mejoras', 'url'=>array('registrarMejora')),
	//array('label'=>'      Registrar matenimientos iniciales <span class="badge badge-'.$color.' pull-right">'.$mi.'</span>', 'url'=>array('mttoPreventivo/iniciales/')),
	//array('label'=>'      Ajuste de fechas en calendario', 'url'=>array('calendario')),
	
	
	array('label'=>'<div id="menu"><strong>Órdenes de mantenimiento</strong></div>'),
	array('label'=>'      Crear orden de mantenimiento', 'url'=>array('mttoCorrectivo/crearOrdenCorrectiva')),
	array('label'=>'      Ver órdenes abiertas <span class="badge badge-'.$Colorabi.' pull-right">'.$abiertas.'</span>', 'url'=>array('verOrdenes')),
	array('label'=>'      Órdenes listas para cerrar <span class="badge badge-'.$Colorli.' pull-right">'.$listas.'</span>', 'url'=>array('cerrarOrdenes')),
	 
	
	array('label'=>'<div id="menu"><strong>Historial</strong></div>'),
	
	array('label'=>'      Histórico de incidentes', 'url'=>array('mttoCorrectivo/historicoCorrectivo')),
	array('label'=>'      Histórico de mejoras', 'url'=>array('mttoCorrectivo/historicoMejoras')),
	array('label'=>'      Histórico de gastos', 'url'=>array('historicoGastos')),
	array('label'=>'      Histórico de ordenes', 'url'=>array('historicoOrdenes')),

	array('label'=>'<div id="menu"><strong>Administrar</strong></div>' , 'visible'=>'1'),
	array('label'=>'      Parámetros y datos maestros', 'url'=>array('mttoCorrectivo/parametros')),
);
?>
<div class='crugepanel user-assignments-role-list'>
<h1>Crear órden de mantenimiento correctivo</h1>
<i>Para crear una órden de mantenimiento correctivo seleccione un incidente o una mejora de las listadas abajo.</i>
</div>
<div class='crugepanel user-assignments-role-list'>
	<i>*Incidentes reportados</i>
<?php
$this->widget('ext.selgridview.SelGridView', array(
                'id'=>'fallas',
				'selectionChanged'=>'validar',
				'summaryText'=>'',
			    'enableSorting' => true,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>2,
				'emptyText'=>'No hay incidentes registrados',
				'htmlOptions'=>array('style'=>'cursor:pointer;'),
                'dataProvider'=>$dataProvider,
				'columns'=>array(
				array(
					//'header'=>'Seleccione las actividades a incluir',
					'class'=>'CCheckBoxColumn',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Unidad',
					'name'=>'idvehiculo',
					'value'=>'str_pad((int) $data->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Fecha',
					'name'=>'fechaFalla',
					'value'=>'date("d/m/Y",strtotime($data->fechaFalla))',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
			
				array(
					'header'=>'Incidente reportado',
					'name'=>'idfalla',
					'value'=>'$data->idfalla0->falla',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Lugar',
					'name'=>'lugar',
					//'value'=>'$data->idfalla0->falla',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Reportó',
					'name'=>'idempleado',
					'value'=>'$data->idempleado0->nombre.\' \'.$data->idempleado0->apellido',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'type'=>'raw',
					'header'=>'Estatus',
					'name'=>'idestatus',
					'value'=>'$data->color($data->idestatus)',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				
			)
        ));
		?>
		</div>
		<div class='crugepanel user-assignments-role-list'>
	<i>*Mejoras por realizar</i>
	<?php //<p><b>Nota: </b><i>Sólo se mostrarán las actividades con menos de 5 dias restantes o que posean atraso</p></i>?>
<?php
$this->widget('ext.selgridview.SelGridView', array(
                'id'=>'mejoras',
				'selectionChanged'=>'validar',
				'summaryText'=>'',
			    'enableSorting' => true,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>2,
				'emptyText'=>'No hay mejoras por realizar',
                'dataProvider'=>$mejoras,
				'htmlOptions'=>array('style'=>'cursor:pointer;'),
				'columns'=>array(
				array(
					//'header'=>'Seleccione las actividades a incluir',
					'class'=>'CCheckBoxColumn',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Unidad',
					'name'=>'idvehiculo',
					'value'=>'str_pad((int) $data->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:40px'),
				),
				array(
					'header'=>'Fecha',
					'name'=>'fechaFalla',
					'value'=>'date("d/m/Y",strtotime($data->fechaFalla))',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
			
				array(
					'header'=>'Mejora',
					'name'=>'idfalla',
					'value'=>'$data->idfalla0->falla',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Detalle',
					'name'=>'detalle',
					
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Conductor',
					'name'=>'idempleado',
					'value'=>'$data->idempleado0->nombre.\' \'.$data->idempleado0->apellido',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'type'=>'raw',
					'header'=>'Estatus',
					'name'=>'idestatus',
					'value'=>'$data->color($data->idestatus)',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				
			)
        ));
		?>
		<?php echo CHtml::button('Crear orden correctiva', array('id'=>'boton','style'=>"float:left", 'onclick'=>'mostrarOrden()','disabled'=>'disabled','class'=>'btn btn-default')); ?>
		</div>
<?php
/*ventana agregar recurso*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'formulario',
    'options'=>array(
        'title'=>'Crear orden de correctiva',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>490,
        //'height'=>360,
		'position'=>array(null,100),
		'resizable'=>false,
		
    ),
));?>
<div class="divForForm"></div>
 
<?php $this->endWidget();?>

<script>
/*$('#formulario').hide();
var ancho=$(window).width()-($(window).width()*0.20);
$('#scrollingDiv').css({
  'right':ancho,
  'bottom': '50px'
 });
*/
 function mostrarOrden(){

	
	$("#formulario").dialog('open');

}

var idmejora;
var idfalla;
function validar(){
idmejora = $("#mejoras").selGridView("getAllSelection"); 
idfalla = $("#fallas").selGridView("getAllSelection"); 

	if(idfalla=="" && idmejora=="")
		$( "#boton" ).prop( "disabled", true );
	else
		$( "#boton" ).prop( "disabled", false );
	crear();
}
function crear(){
/*var idfalla = $.fn.yiiGridView.getSelection('fallas');
	if(idfalla=="")
		$('#formulario').hide();
	else
		$('#formulario').show();*/
		
jQuery.ajax({
                url: "crearOrden",
                'data':$(this).serialize()+ '&idfalla=' + idfalla + '&idmejora=' + idmejora,
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        $('#formulario div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        $('#formulario div.divForForm form').submit(crear); // 
                                }
                                else{
                                        $('#formulario div.divForForm').html(data.div);
										window.location.replace("<?php echo Yii::app()->baseUrl."/mttoCorrectivo/verOrdenes"?>");
                                }
                        } ,
                'cache':false});
		return false; 
}

</script>