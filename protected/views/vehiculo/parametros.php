<?php
/* @var $this CombustibleController */
/* @var $model Historicocombustible */

$this->breadcrumbs=array(
	'Vehiculos'=>array('index'),
	'Parámetros',
);

$this->menu=array(

    array('label'=>'<div id="menu"><strong>Vehiculos</strong></div>' , 'visible'=>'1'),
    array('label'=>'      Vehiculos registrados', 'url'=>array('vehiculo/index')),
    array('label'=>'      Registrar vehiculo', 'url'=>array('vehiculo/create')),
    array('label'=>'      Histórico de vehiculos', 'url'=>array('vehiculo/historico')),
    //array('label'=>'Administrar vehiculos', 'url'=>array('admin')),
    array('label'=>'<div id="menu"><strong>Grupos</strong></div>' , 'visible'=>'1'),
    array('label'=>'      Ver grupos', 'url'=>array('grupo/index')),
    array('label'=>'      Crear grupo', 'url'=>array('grupo/create')),

    array('label'=>'<div id="menu"><strong>Administrar</strong></div>' , 'visible'=>'1'),
    array('label'=>'      Parámetros y datos maestros', 'url'=>array('vehiculo/parametros')),

);
?>
<div class='crugepanel'>
<h1>Marcas y modelos</h1>
<div  style="width:48%;float:left">
<?php
$this->widget('ext.selgridview.SelGridView', array(
                'id'=>'marca',
                'summaryText'=>'',
                'selectableRows'=>1,
                'selectionChanged'=>'verModelo',
                'template'=>"{items}\n{summary}\n{pager}",
                'emptyText'=>'no hay marcas registradas',
                'dataProvider'=>$gridMarca,
                'htmlOptions'=>array('style'=>'font-size: 1.0em;cursor:pointer'),
                'columns'=>array(
                array(
                    'header'=>'Marca',
                    'name'=>'marca',
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
                            \'onclick\'=>\'{agregar("/marca/actualizar/\'.$data["id"].\'","marca");}\'
                    )
                );',),
                array(
                    'header'=>'Eliminar',
                    'class'=>'CButtonColumn',
                     'template'=>'{delete}',
                         'buttons'=>array(
                            'delete' => array(
                                'url'=>'Yii::app()->createUrl("marca/delete", array("id"=>$data->id))',
                        ),
                    ),
                ),
            )
        ));
?>
<?php echo CHtml::link('Registrar marca(+)', "",  // the link for open the dialog
    array(
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregar('/marca/nuevaMarca','marca');}"));
		?>	
</div>
<div  style="width:48%;float:right">
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'modelo',
                'summaryText'=>'',
                'selectableRows'=>1,
                'template'=>"{items}\n{summary}\n{pager}",
                'emptyText'=>'no hay modelos registrados',
                'dataProvider'=>$gridModelo,
                'htmlOptions'=>array('style'=>'font-size: 1.0em;cursor:pointer'),
                'columns'=>array(
                array(
                    'header'=>'Modelo',
                    'name'=>'modelo',
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
                            \'onclick\'=>\'{agregar("\'.Yii::app()->createUrl("subtiporepuesto/actualizar",array("id"=>$data["id"])).\'");}\'
                    )
                );',),
                array(
                    'header'=>'Eliminar',
                    'class'=>'CButtonColumn',
                     'template'=>'{delete}',
                         'buttons'=>array(
                            'delete' => array(
                                'url'=>'Yii::app()->createUrl("modelo/delete", array("id"=>$data->id))',
                        ),
                    ),
                ),
            )
        ));
?>
<?php echo CHtml::link('Registrar modelo(+)', "",  // the link for open the dialog
    array(
		'id'=>'regModelo',
        'style'=>'cursor: pointer; text-decoration: underline;display:none;',
        'onclick'=>"{auxiliar('/modelo/nuevoModelo/','marca','modelo');}"));
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
function verModelo(){
	
	var id = $.fn.yiiGridView.getSelection('marca');
	if(id=="")
		$("#regModelo").hide(500);
	else
		$("#regModelo").show(500);
	$.fn.yiiGridView.update('modelo',{ data : "idmarca="+id});
}
</script>
