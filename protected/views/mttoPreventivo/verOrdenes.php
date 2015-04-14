<?php 
	$this->breadcrumbs=array(
	'Mantenimiento preventivo'=>array('mttoPreventivo/index'),
	'Órdenes abiertas',
);
$this->menu=array(
	//if(Yii::app()->user->checkAccess('xxx')):
	array('label'=>'<div id="menu"><strong>Opciones de mantenimiento</strong></div>' , 'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_planes')),
	array('label'=>'      Actividades de mantenimiento', 'url'=>array('mttoPreventivo/index') , 'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_index')),
	array('label'=>'      Registrar actividades de mantenimiento', 'url'=>array('mttoPreventivo/planes') , 'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_planes')),
	array('label'=>'      Registrar matenimientos iniciales <span id="mi" class="badge badge-'.$color.' pull-right">'.$mi.'</span>', 'url'=>array('mttoPreventivo/iniciales/') , 'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_iniciales')),
	array('label'=>'      Ajuste de fechas en calendario', 'url'=>array('mttoPreventivo/calendario') , 'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_calendario')),
	//endif;
	
	array('label'=>'<div id="menu"><strong>Órdenes de mantenimiento</strong></div>'),
	array('label'=>'      Crear orden de mantenimiento', 'url'=>array('mttoPreventivo/crearOrdenPreventiva') ,'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_crearOrdenPreventiva')),
	array('label'=>'      Ver órdenes abiertas <span class="badge badge-'.$Colorabi.' pull-right">'.$abiertas.'</span>', 'url'=>array('mttoPreventivo/verOrdenes') ,'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_verOrdenes')),
	array('label'=>'      Órdenes listas para cerrar <span class="badge badge-'.$Colorli.' pull-right">'.$listas.'</span>', 'url'=>array('mttoPreventivo/cerrarOrdenes'),'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_cerrarOrdenes')),
	
	array('label'=>'<div id="menu"><strong>Gestión de coordinadores</strong></div>' , 'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_coordinadores')),
	array('label'=>'      Coordinador operativo y de transporte', 'url'=>array('empleados/coordinadores') , 'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_coordinadores')),
	
	
	array('label'=>'<div id="menu"><strong>Historial</strong></div>'),
	array('label'=>'      Histórico de mantenimientos', 'url'=>array('mttoPreventivo/historicoPreventivo') ,'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_historicoPreventivo')),
	array('label'=>'      Histórico de gastos', 'url'=>array('mttoPreventivo/historicoGastos'),'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_historicoGastos')),
	array('label'=>'      Histórico de ordenes', 'url'=>array('mttoPreventivo/historicoOrdenes'),'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_historicoOrdenes')),
);
?>
<div class='crugepanel user-assignments-role-list'>
	<h1>Ordenes de mantenimiento abiertas</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'orden',
				'summaryText'=>'',
			    'enableSorting' => true,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>1,
				'emptyText'=>'No hay ordenes abiertas',
                'dataProvider'=>$dataProvider,
				'htmlOptions'=>array('style'=>'cursor:pointer'),
				'columns'=>array(
				array(
					'headerHtmlOptions'=>array('style'=>'width:7%'),
					'header'=>'Orden #',
					'name'=>'id',
					'value'=>'str_pad((int) $data->id,6,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px'),
				),	
				array(
					'header'=>'Fecha y hora de creada',
					'name'=>'fecha',
					'value'=>'date("d/m/Y h:i A",strtotime($data->fecha))',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px'),
				),
				array(
					'type'=>"raw",
					'header'=>'Estado',
					'name'=>'idestatus',
					'value'=>'$data->color($data->idestatus,$data->idestatus0->estatus)',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px'),
				),
				array(
					'header'=>'Coordinador operativo',
					'name'=>'cOperativo',
					'value'=>'$data->cOperativo0->nombre.\'  \'.$data->cOperativo0->apellido',
					'htmlOptions'=>array('style'=>'text-align:center;width:80px'),
				),
				array(
					'header'=>'Coordinador de transporte',
					'name'=>'cTaller',
					'value'=>'$data->cTaller0->nombre.\'  \'.$data->cTaller0->apellido',
					'htmlOptions'=>array('style'=>'text-align:center;width:80px'),
				),
				array(
					'header'=>'Taller asignado',
					'name'=>'taller',
					'value'=>'$data->taller0->nombre',
					'htmlOptions'=>array('style'=>'text-align:center;width:80px'),
				),
				array(
						'headerHtmlOptions'=>array('style'=>'text-align:center;width:50px;'),
						'htmlOptions'=>array('style'=>'text-align:center;'),
						'header'=>'Ver PDF',
						'type'=>'raw',
						'value'=>'CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/pdf.png",
                                          "Ver detalle",array("title"=>"Ver")),
										  
                        Yii::app()->createUrl("mttoPreventivo/vistaPreviaPDF", array("id"=>$data->id)),
                        array(
								
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                
                        )
                );',),
						array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;'),
					'htmlOptions'=>array('style'=>'text-align:center;'),
					'header'=>'Enviar',
					'type'=>'raw',
					'value'=>'CHtml::link(
                     CHtml::image(Yii::app()->request->baseUrl."/imagenes/correo.png",
                                          "Agregar",array("title"=>"Editar")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{enviar("\'.Yii::app()->createUrl("mttoPreventivo/correo",array("id"=>$data["id"])).\'"); $("#dialog").dialog("open");}\'
                        )
                );',),
				array(
						'headerHtmlOptions'=>array('style'=>'text-align:center;width:50px;'),
						'htmlOptions'=>array('style'=>'text-align:center;'),
						'header'=>'Detalle',
						'type'=>'raw',
						'value'=>'CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/ver.png",
                                          "Ver detalle",array("title"=>"Ver")),
										  
                        Yii::app()->createUrl("mttoPreventivo/vistaPrevia", array("id"=>$data->id,"nom"=>"Órdenes abiertas","dir"=>"mttoPreventivo/verOrdenes")),
                        array(
								
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                
                        )
                );',),
				array(
						'headerHtmlOptions'=>array('style'=>'text-align:left;width:20px;text-align:center;'),
						'htmlOptions'=>array('style'=>'text-align:center;width:30px;'),
						'header'=>'Actualizar',
						'type'=>'raw',
						'value'=>'CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
										  
                        Yii::app()->createUrl("mttoPreventivo/mttopRealizados", array("id"=>$data->id,"nom"=>"Órdenes abiertas","dir"=>"mttoPreventivo/verOrdenes")),
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                        )
                );',),
					array(
					'header'=>'Eliminar',
					'class'=>'CButtonColumn',
					 'template'=>'{delete}',
					 'afterDelete'=>'function(link,success,data){
	                               window.setTimeout("location.reload()");
	                  }',
					     'buttons'=>array(
							'delete' => array(
								'url'=>'Yii::app()->createUrl("ordenmtto/delete", array("id"=>$data->id))',
								'options'=>array(
									'confirm'=>'¿Desea cancelar la órden? Todas las actividades volverán a su estado anterior'
									),
						),
					),
				),
			)
        ));
		?>
<?php
/*ventana agregar informacion*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'dialog',
    'options'=>array(
        'title'=>'Enviar orden por correo electrónico',
        'autoOpen'=>false,
		'position'=>array(null,100),
        'modal'=>true,
        'width'=>400,
        //'height'=>255,
		'resizable'=>false
    ),
));?>
<div class="divForForm"></div>
 
<?php $this->endWidget();?>
</div>
<style>
#menu{
	font-size:15px;
}
.grid-view table.items tr.selected {
    background: none repeat scroll 0% 0% rgba(0, 249, 3, 0.3);
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

var Uurl;
function enviar(id){
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
                                        $('#dialog div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        $('#dialog div.divForForm form').submit(enviar); // updatePaymentComment
                                }
                                else
                                {
                                        $('#dialog div.divForForm').html(data.div);
                                        setTimeout("$('#dialog').dialog('close') ",1000);
                                        $.fn.yiiGridView.update('final');
                                }
                        } ,
                'cache':false});
    return false; 
}
</script>