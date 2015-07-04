<?php 
	$this->breadcrumbs=array(
	'Mantenimiento preventivo'=>array('mttoPreventivo/index'),
	'Cerrar órdenes',
);
$this->menu=array(
	//if(Yii::app()->user->checkAccess('xxx')):
	array('label'=>'<div id="menu"><strong>Opciones de mantenimiento</strong></div>' , 'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_planes')),
	array('label'=>'      Actividades de mantenimiento', 'url'=>array('mttoPreventivo/index') , 'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_index')),
	array('label'=>'      Registrar actividades de mantenimiento', 'url'=>array('mttoPreventivo/planes') , 'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_planes')),
	array('label'=>'      Registrar matenimientos iniciales <span id="mi" class="badge badge-'.$color.' pull-right">'.$mi.'</span>', 'url'=>array('mttoPreventivo/iniciales/') , 'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_iniciales')),
	array('label'=>'      Ajuste de fechas en calendario', 'url'=>array('mttoPreventivo/calendario') , 'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_calendario')),
	
	array('label'=>'<div id="menu"><strong>Órdenes de mantenimiento</strong></div>'),
	array('label'=>'      Crear orden de mantenimiento', 'url'=>array('mttoPreventivo/crearOrdenPreventiva') ,'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_crearOrdenPreventiva')),
	array('label'=>'      Ver órdenes abiertas <span class="badge badge-'.$Colorabi.' pull-right">'.$abiertas.'</span>', 'url'=>array('mttoPreventivo/verOrdenes') ,'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_verOrdenes')),
	array('label'=>'      Órdenes listas para cerrar <span id="listas" class="badge badge-'.$Colorli.' pull-right">'.$listas.'</span>', 'url'=>array('mttoPreventivo/cerrarOrdenes'),'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_cerrarOrdenes')),

	array('label'=>'<div id="menu"><strong>Historial</strong></div>'),
	array('label'=>'      Histórico de mantenimientos', 'url'=>array('mttoPreventivo/historicoPreventivo') ,'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_historicoPreventivo')),
	array('label'=>'      Histórico de gastos', 'url'=>array('mttoPreventivo/historicoGastos'),'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_historicoGastos')),
	array('label'=>'      Histórico de ordenes', 'url'=>array('mttoPreventivo/historicoOrdenes'),'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_historicoOrdenes')),

	array('label'=>'<div id="menu"><strong>Administrar</strong></div>' , 'visible'=>'1'),
	array('label'=>'      Parámetros y datos maestros', 'url'=>array('mttoPreventivo/parametros')),
);
?>
<div class='crugepanel user-assignments-role-list'>
	<h1>Cerrar órdenes de mantenimiento</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'ordenes',
				//'selectionChanged'=>'validar',
				'summaryText'=>'',
			    'enableSorting' => true,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>1,
				'emptyText'=>'No hay ordenes listas para cerrar',
                'dataProvider'=>$dataProvider,
				'htmlOptions'=>array('style'=>'cursor:pointer'),
				'columns'=>array(
				array(
					'headerHtmlOptions'=>array('style'=>''),
					'header'=>'Orden #',
					'name'=>'id',
					'value'=>'str_pad((int) $data->id,6,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Fecha y hora de creada',
					'name'=>'fecha',
					'value'=>'date("d/m/Y h:i A",strtotime($data->fecha))',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array( 
					"type"=>"raw",
					'header'=>'Estado',
					'name'=>'idestatus',
					'value'=>'$data->color($data->idestatus,$data->idestatus0->estatus)',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Coordinador operativo',
					'name'=>'cOperativo',
					'value'=>'$data->cOperativo0->nombre.\'  \'.$data->cOperativo0->apellido',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Coordinador de transporte',
					'name'=>'cTaller',
					'value'=>'$data->cTaller0->nombre.\'  \'.$data->cTaller0->apellido',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Taller asignado',
					'name'=>'taller',
					'value'=>'$data->taller0->nombre',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
						'headerHtmlOptions'=>array('style'=>'text-align:center;'),
						'htmlOptions'=>array('style'=>'text-align:center;'),
						'header'=>'Ver orden',
						'type'=>'raw',
						'value'=>'CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/ver.png",
                                          "Ver detalle",array("title"=>"Ver")),
										  
                        Yii::app()->createUrl("mttoPreventivo/vistaPrevia", array("id"=>$data->id,"nom"=>"Cerrar ordenes","dir"=>"mttoPreventivo/cerrarOrdenes")),
                        array(	
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                        )
                );',),
				array(
						'headerHtmlOptions'=>array('style'=>'text-align:left;text-align:center;'),
						'htmlOptions'=>array('style'=>'text-align:center;'),
						'header'=>'Actualizar',
						'type'=>'raw',
						'value'=>'CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
										  
                        Yii::app()->createUrl("mttoPreventivo/mttopRealizados", array("id"=>$data->id,"nom"=>"Cerrar órdenes","dir"=>"mttoPreventivo/cerrarOrdenes")),
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                        )
                );',),
				array(
					'header'=>'Cerrar órden',
					'value'=>'CHTML::checkBox("campo",0,array(\'id\'=>"campo$data->id",\'width\'=>4,\'maxlength\'=>2,\'onchange\'=>"return validar($data->id)"))',
					'type'=>'raw',
					'htmlOptions'=>array('style'=>'text-align: center'),
				),
			)
        ));
		?>
		
</div>
<script>
$('#formulario').hide();

function actualizarSpan(){
	var dir="<?php echo Yii::app()->baseUrl;?>"+"/mttoPreventivo/actualizarSpanListas";
	$.ajax({
		url: dir,
		'data':$(this).serialize(),
        'dataType':'json',
         'success':function( result ) {
    	     $('#listas').removeClass($('#listas').attr('class')).addClass('badge badge-'+result.color+' pull-right');
			 $('#listas').text(result.total);
			 
		},});
}
/*function validar(){		
jQuery.ajax({
                url: "crearOrden",
                'data':$(this).serialize()+ '&idAct=' + idAct,
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        $('#formulario').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        $('#formulario form').submit(validar); // 
                                }
                                else{
                                        $('#formulario').html(data.div);
                                }
                        } ,
                'cache':false});
	

		return false; 
}*/
function validar(orden){
	if(confirm('¿confirma que desea cerrar la orden?')){
	jQuery.ajax({
                url: "<?php echo Yii::app()->baseUrl."/mttoPreventivo/estatusOrden/7"?>",
                'data':$(this).serialize()+ '&id=' + orden,
                'type':'post',
                'dataType':'json',
            'cache':false});			
		$.fn.yiiGridView.update('ordenes');
		actualizarSpan();
	}
}
</script>