<?php
/* @var $this CombustibleController */
/* @var $model Historicocombustible */

$this->breadcrumbs=array(
	'Parámetros de viajes',
);

$this->menu=array(

    array('label'=>'<div id="menu"><strong>Viajes</strong></div>'),
    array('label'=>'      Registrar viajes rutinarios', 'url'=>array('rutinarios')),
    array('label'=>'      Registrar viajes especiales', 'url'=>array('especiales')),

    
    array('label'=>'<div id="menu"><strong>Historial</strong></div>'),
    array('label'=>'      Histórico de viajes rutinarios', 'url'=>array('viajes/historicoRutinarios')),
    array('label'=>'      Histórico de viajes especiales', 'url'=>array('viajes/historicoEspeciales')),
    array('label'=>'      Histórico de conductores', 'url'=>array('empleados/historicoConductores')),

    array('label'=>'<div id="menu"><strong>Administrar</strong></div>' , 'visible'=>'1'),
    array('label'=>'      Parámetros y datos maestros', 'url'=>array('viajes/parametros')),
    array('label'=>'      Gestión de conductores', 'url'=>array('empleados/conductores')),

);
?>
<div class='crugepanel'>
<h1>Estados y lugares  </h1>
<div  style="width:48%;float:left">
<?php
$this->widget('ext.selgridview.SelGridView', array(
                'id'=>'estados',
                'summaryText'=>'',
                'selectableRows'=>1,
                'selectionChanged'=>'verLugar',
                'template'=>"{items}\n{summary}\n{pager}",
                'emptyText'=>'no hay estados registrados',
                'dataProvider'=>$gridEstados,
                'htmlOptions'=>array('style'=>'font-size: 1.0em;cursor:pointer'),
                'columns'=>array(
                array(
                    'header'=>'Estado',
                    'name'=>'estado',
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
                            \'onclick\'=>\'{agregar("/estados/actualizar/\'.$data["id"].\'","estados");}\'
                    )
                );',),
                array(
                    'header'=>'Eliminar',
                    'class'=>'CButtonColumn',
                     'template'=>'{delete}',
                         'buttons'=>array(
                            'delete' => array(
                                'url'=>'Yii::app()->createUrl("estados/delete", array("id"=>$data->id))',
                        ),
                    ),
                ),
            )
        ));
?>
<?php echo CHtml::link('Registrar estado(+)', "",  // the link for open the dialog
    array(
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregar('/estados/agregar','estados');}"));
		?>	
</div>
<div  style="width:48%;float:right">
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'lugar',
                'summaryText'=>'',
                'selectableRows'=>1,
                'template'=>"{items}\n{summary}\n{pager}",
                'emptyText'=>'no hay lugares registrados',
                'dataProvider'=>$gridLugar,
                'htmlOptions'=>array('style'=>'font-size: 1.0em;cursor:pointer'),
                'columns'=>array(
                array(
                    'header'=>'Lugar',
                    'name'=>'lugar',
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
                            \'onclick\'=>\'{agregar("/lugar/actualizar/\'.$data["id"].\'","lugar");}\'
                    )
                );',),
                array(
                    'header'=>'Eliminar',
                    'class'=>'CButtonColumn',
                     'template'=>'{delete}',
                         'buttons'=>array(
                            'delete' => array(
                                'url'=>'Yii::app()->createUrl("lugar/delete", array("id"=>$data->id))',
                        ),
                    ),
                ),
            )
        ));
?>
<?php echo CHtml::link('Registrar lugar(+)', "",  // the link for open the dialog
    array(
		'id'=>'regLugar',
        'style'=>'cursor: pointer; text-decoration: underline;display:none;',
        'onclick'=>"{auxiliar('/lugar/agregar/','estados','lugar');}"));
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
function auxiliar(dir,grid,act){
    
    var id = $.fn.yiiGridView.getSelection(grid);
    agregar(dir+id,act);
}
function verLugar(){
	
	var id = $.fn.yiiGridView.getSelection('estados');
	if(id=="")
		$("#regLugar").hide(500);
	else
		$("#regLugar").show(500);
	$.fn.yiiGridView.update('lugar',{ data : "idestado="+id});
}
</script>
