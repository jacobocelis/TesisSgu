<?php
/* @var $this CombustibleController */
/* @var $model Historicocombustible */

$this->breadcrumbs=array(
	'Mantenimiento correctivo'=>array('index'),
	'Parámetros',
);

$this->menu=array(

array('label'=>'<div id="menu"><strong>Opciones de mantenimiento</strong></div>'),
    array('label'=>'      Incidentes reportados', 'url'=>array('mttoCorrectivo/index')),
    array('label'=>'      Registro de incidentes', 'url'=>array('registrarFalla')),
    array('label'=>'      Registro de mejoras', 'url'=>array('registrarMejora')),
    //array('label'=>'      Registrar matenimientos iniciales <span class="badge badge-'.$color.' pull-right">'.$mi.'</span>', 'url'=>array('mttoPreventivo/iniciales/')),
    //array('label'=>'      Ajuste de fechas en calendario', 'url'=>array('calendario')),
    
    
    array('label'=>'<div id="menu"><strong>Órdenes de mantenimiento</strong></div>'),
    array('label'=>'      Crear orden de mantenimiento', 'url'=>array('crearOrdenCorrectiva'), 'visible'=>Yii::app()->user->checkAccess('action_mttocorrectivo_crearordencorrectiva')),
    array('label'=>'      Ver órdenes abiertas <span class="badge badge-'.$Colorabi.' pull-right">'.$abiertas.'</span>', 'url'=>array('verOrdenes')),
    array('label'=>'      Órdenes listas para cerrar <span class="badge badge-'.$Colorli.' pull-right">'.$listas.'</span>', 'url'=>array('mttoCorrectivo/cerrarOrdenes'), 'visible'=>Yii::app()->user->checkAccess('action_mttocorrectivo_cerrarorden')),
 
    
    array('label'=>'<div id="menu"><strong>Historial</strong></div>'),
    
    array('label'=>'      Histórico de incidentes', 'url'=>array('mttoCorrectivo/historicoCorrectivo')),
    array('label'=>'      Histórico de mejoras', 'url'=>array('mttoCorrectivo/historicoMejoras')),
    array('label'=>'      Histórico de gastos', 'url'=>array('mttoCorrectivo/historicoGastos')),
    array('label'=>'      Histórico de ordenes', 'url'=>array('historicoOrdenes')),

    array('label'=>'<div id="menu"><strong>Administrar</strong></div>' , 'visible'=>'1'),
    array('label'=>'      Parámetros y datos maestros', 'url'=>array('mttoCorrectivo/parametros'), 'visible'=>Yii::app()->user->checkAccess('action_mttocorrectivo_parametros')),

    );
?>
<div class='crugepanel'>
<h1>Incidentes</h1>
<?php
$this->widget('ext.selgridview.SelGridView', array(
                'id'=>'fallas',
                'summaryText'=>'',
                'selectableRows'=>1,
    
                'template'=>"{items}\n{summary}\n{pager}",
                'emptyText'=>'no hay incidentes registrados',
                'dataProvider'=>$gridFallas,
                'htmlOptions'=>array('style'=>'font-size: 1.0em;cursor:pointer'),
                'columns'=>array(
                array(
                    'header'=>'Incidentes',
                    'name'=>'falla',
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
                            \'onclick\'=>\'{agregar("/falla/actualizarFalla/\'.$data["id"].\'","fallas");}\'
                    )
                );',),
                array(
                    'header'=>'Eliminar',
                    'class'=>'CButtonColumn',
                     'template'=>'{delete}',
                         'buttons'=>array(
                            'delete' => array(
                                'url'=>'Yii::app()->createUrl("falla/delete", array("id"=>$data->id))',
                        ),
                    ),
                ),
            )
        ));
?>
<?php echo CHtml::link('Registrar incidente(+)', "",  // the link for open the dialog
    array(
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregar('/falla/agregarFalla','fallas');}"));
		?>	
</div>
<div class='crugepanel'>
<h1>Mejoras</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'mejoras',
                'summaryText'=>'',
                'selectableRows'=>1,
                'template'=>"{items}\n{summary}\n{pager}",
                'emptyText'=>'no hay modelos registrados',
                'dataProvider'=>$gridMejoras,
                'htmlOptions'=>array('style'=>'font-size: 1.0em;cursor:pointer'),
                'columns'=>array(
                array(
                    'header'=>'Mejoras',
                    'name'=>'falla',
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
                            \'onclick\'=>\'{agregar("/falla/actualizarMejora/\'.$data["id"].\'","mejoras");}\'
                    )
                );',),
                array(
                    'header'=>'Eliminar',
                    'class'=>'CButtonColumn',
                     'template'=>'{delete}',
                         'buttons'=>array(
                            'delete' => array(
                                'url'=>'Yii::app()->createUrl("falla/delete", array("id"=>$data->id))',
                        ),
                    ),
                ),
            )
        ));
?>
<?php echo CHtml::link('Registrar Mejora(+)', "",  // the link for open the dialog
    array(
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregar('/falla/agregarMejora','mejoras');}"));
    ?>	
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
</script>
