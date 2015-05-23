<?php
/* @var $this CombustibleController */
/* @var $model Historicocombustible */

$this->breadcrumbs=array(
	'Mantenimiento preventivo'=>array('index'),
	'Parámetros',
);
$this->menu=array(
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
    
    array('label'=>'<div id="menu"><strong>Historial</strong></div>'),
    array('label'=>'      Histórico de mantenimientos', 'url'=>array('mttoPreventivo/historicoPreventivo') ,'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_historicoPreventivo')),
    array('label'=>'      Histórico de gastos', 'url'=>array('mttoPreventivo/historicoGastos'),'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_historicoGastos')),
    array('label'=>'      Histórico de ordenes', 'url'=>array('mttoPreventivo/historicoOrdenes'),'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_historicoOrdenes')),

    array('label'=>'<div id="menu"><strong>Administrar</strong></div>' , 'visible'=>'1'),
    array('label'=>'      Parámetros y datos maestros', 'url'=>array('mttoPreventivo/parametros')),

    );
?>
<div class='crugepanel'>
<h1>Actividades de mantenimiento</h1>
<?php
$this->widget('ext.selgridview.SelGridView', array(
                'id'=>'actividades',
                'summaryText'=>'',
                'selectableRows'=>1,
                'template'=>"{items}\n{summary}\n{pager}",
                'emptyText'=>'no hay actividades',
                'dataProvider'=>$gridActividades,
                'htmlOptions'=>array('style'=>'font-size: 1.0em;cursor:pointer'),
                'columns'=>array(
                array(
                    'header'=>'Actividades',
                    'name'=>'actividad',
                    //'value'=>'$data->idsubTipoRepuesto0->subTipo',
                    'htmlOptions'=>array('style'=>'text-align:center;'),
                ),
 
                array(
                    'headerHtmlOptions'=>array('style'=>'text-align:center;width:80px'),
                    'htmlOptions'=>array('style'=>'text-align:center;'),
                    'header'=>'Editar',
                    'type'=>'raw',
                    'value'=>'CHtml::link(
                    CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                      "Agregar",array("title"=>"Editar")),
                    "",
                    array(
                            \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                            \'onclick\'=>\'{agregar("/actividadmtto/actualizar/\'.$data["id"].\'","actividades");}\'
                    )
                );',),
                array(
                    'header'=>'Eliminar',
                    'class'=>'CButtonColumn',
                     'template'=>'{delete}',
                         'buttons'=>array(
                            'delete' => array(
                                'url'=>'Yii::app()->createUrl("actividadmtto/delete", array("id"=>$data->id))',
                        ),
                    ),
                ),
            )
        ));
?>
<?php echo CHtml::link('Registrar actividad(+)', "",  // the link for open the dialog
    array(
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregar('/actividadmtto/agregar','actividades');}"));
		?>	
</div>
<div class='crugepanel'>
<h1>Servicios</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'servicios',
                'summaryText'=>'',
                //'selectableRows'=>1,
                'template'=>"{items}\n{summary}\n{pager}",
                'emptyText'=>'no hay servicios registrados',
                'dataProvider'=>$gridServicios,
                'htmlOptions'=>array('style'=>'font-size: 1.0em;cursor:pointer'),
                'columns'=>array(
                array(
                    'header'=>'Servicios',
                    'name'=>'servicio',
                    //'value'=>'$data->idsubTipoRepuesto0->subTipo',
                    'htmlOptions'=>array('style'=>'text-align:center;'),
                ),
 
                array(
                    'headerHtmlOptions'=>array('style'=>'text-align:center;width:80px'),
                    'htmlOptions'=>array('style'=>'text-align:center;'),
                    'header'=>'Editar',
                    'type'=>'raw',
                    'value'=>'CHtml::link(
                    CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                      "Agregar",array("title"=>"Editar")),
                    "",
                    array(
                            \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                            \'onclick\'=>\'{agregar("/servicio/actualizar/\'.$data["id"].\'","servicios");}\'
                    )
                );',),
                array(
                    'header'=>'Eliminar',
                    'class'=>'CButtonColumn',
                     'template'=>'{delete}',
                         'buttons'=>array(
                            'delete' => array(
                                'url'=>'Yii::app()->createUrl("servicios/delete", array("id"=>$data->id))',
                        ),
                    ),
                ),
            )
        ));
?>
<?php echo CHtml::link('Registrar servicio(+)', "",  // the link for open the dialog
    array(
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregar('/servicio/agregar','servicios');}"));
    ?>	
</div>
<div class='crugepanel'>
<h1>Insumos</h1>
<div style="width:48%;float:left">
<?php
$this->widget('ext.selgridview.SelGridView', array(
                'id'=>'tipos',
                'summaryText'=>'',
                'selectableRows'=>1,
                'selectionChanged'=>'verInsumo',
                'template'=>"{items}\n{summary}\n{pager}",
                'emptyText'=>'no hay tipos registrados',
                'dataProvider'=>$gridTipo,
                'htmlOptions'=>array('style'=>'font-size: 1.0em;cursor:pointer'),
                'columns'=>array(
                array(
                    'header'=>'Tipo',
                    'name'=>'tipo',
                    //'value'=>'$data->idsubTipoRepuesto0->subTipo',
                    'htmlOptions'=>array('style'=>'text-align:center;'),
                ),
 
                array(
                    'headerHtmlOptions'=>array('style'=>'text-align:center;width:80px'),
                    'htmlOptions'=>array('style'=>'text-align:center;'),
                    'header'=>'Editar',
                    'type'=>'raw',
                    'value'=>'CHtml::link(
                    CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                      "Agregar",array("title"=>"Editar")),
                    "",
                    array(
                            \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                            \'onclick\'=>\'{agregar("/tipoinsumo/actualizar/\'.$data["id"].\'","tipos");}\'
                    )
                );',),
                array(
                    'header'=>'Eliminar',
                    'class'=>'CButtonColumn',
                     'template'=>'{delete}',
                         'buttons'=>array(
                            'delete' => array(
                                'url'=>'Yii::app()->createUrl("tipoinsumo/delete", array("id"=>$data->id))',
                        ),
                    ),
                ),
            )
        ));
?>
<?php echo CHtml::link('Registrar tipo(+)', "",  // the link for open the dialog
    array(
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregar('/tipoinsumo/agregar','tipos');}"));
        ?>  
</div>
<div  style="width:48%;float:right">
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'insumo',
                'summaryText'=>'',
                'selectableRows'=>1,
                'template'=>"{items}\n{summary}\n{pager}",
                'emptyText'=>'no hay lugares registrados',
                'dataProvider'=>$gridInsumo,
                'htmlOptions'=>array('style'=>'font-size: 1.0em;cursor:pointer'),
                'columns'=>array(
                array(
                    'header'=>'Insumo',
                    'name'=>'insumo',
                    //'value'=>'$data->idsubTipoRepuesto0->subTipo',
                    'htmlOptions'=>array('style'=>'text-align:center;'),
                ),
 
                array(
                    'headerHtmlOptions'=>array('style'=>'text-align:center;width:80px'),
                    'htmlOptions'=>array('style'=>'text-align:center;'),
                    'header'=>'Editar',
                    'type'=>'raw',
                    'value'=>'CHtml::link(
                    CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                      "Agregar",array("title"=>"Editar")),
                    "",
                    array(
                            \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                            \'onclick\'=>\'{agregar("/insumo/actualizar/\'.$data["id"].\'","insumo");}\'
                    )
                );',),
                array(
                    'header'=>'Eliminar',
                    'class'=>'CButtonColumn',
                     'template'=>'{delete}',
                         'buttons'=>array(
                            'delete' => array(
                                'url'=>'Yii::app()->createUrl("insumo/delete", array("id"=>$data->id))',
                        ),
                    ),
                ),
            )
        ));
?>
<?php echo CHtml::link('Registrar insumo(+)', "",  // the link for open the dialog
    array(
        'id'=>'regInsumo',
        'style'=>'cursor: pointer; text-decoration: underline;display:none;',
        'onclick'=>"{auxiliar('/insumo/agregar/','tipos','insumo');}"));
        ?>  
</div>
</div>
<?php
/*ventana agregar recurso*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'dialog',
    'options'=>array(
        //'title'=>'Editar Repuesto',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>420,
     
		'position'=>array(null,100),
		'resizable'=>false
    ),
));?>
<div class="divForForm"></div>
 
<?php $this->endWidget();?>

<script>
var Uurl,Grid;
function agregar(dir,grid){
    if (typeof(dir)=='string'){
        Uurl=dir;
        Grid=grid;
    }
        
 $('#dialog').dialog('open');
	jQuery.ajax({
                url: "<?php echo Yii::app()->baseUrl;?>"+Uurl,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                    if (data.status == 'failure'){
                            //$('#dialog div.divForForm').html(data.div);
							$('#dialog div.divForForm').html(data.div);
                            // Here is the trick: on submit-> once again this function!
                            //$('#dialog div.divForForm form').submit(agregarActividad); // updatePaymentComment
							$('#dialog div.divForForm form').submit(agregar);
					
							//$('body').scrollTo('#agreAct',{duration:'slow', offsetTop : '50'});
							//$.scrollTo($('#agreAct').offset().top-100, { duration:300});
                    }
                    else{
                            //$('#dialog div.divForForm').html(data.div);
							$('#dialog div.divForForm').html(data.div);
                            //setTimeout("agregarActividad()",1000);
                            $('#dialog').dialog('close');
							$.fn.yiiGridView.update(Grid);
                    }
                        } ,
                'cache':false});
    return false; 
}
function verInsumo(){
    
    var id = $.fn.yiiGridView.getSelection('tipos');
    if(id=="")
        $("#regInsumo").hide(500);
    else
        $("#regInsumo").show(500);
    $.fn.yiiGridView.update('insumo',{ data : "idtipo="+id});
}
function auxiliar(dir,grid,act){
    
    var id = $.fn.yiiGridView.getSelection(grid);
    agregar(dir+id,act);
}
</script>
