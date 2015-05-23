<?php
/* @var $this CombustibleController */
/* @var $model Historicocombustible */

$this->breadcrumbs=array(
	'Grupos'=>array('index'),
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

    array('label'=>'<div id="menu"><strong>Administrar datos maestros</strong></div>' , 'visible'=>'1'),
    array('label'=>'      Vehiculos', 'url'=>array('vehiculo/parametros')),
    array('label'=>'      Grupos', 'url'=>array('grupo/parametros')));
?>
<div class='crugepanel'>
<h1>Grupos</h1>
<?php
$this->widget('ext.selgridview.SelGridView', array(
                'id'=>'grupo',
                'summaryText'=>'',
                'selectableRows'=>1,
                'template'=>"{items}\n{summary}\n{pager}",
                'emptyText'=>'no hay grupos',
                'dataProvider'=>$gridGrupo,
                'htmlOptions'=>array('style'=>'font-size: 1.0em;cursor:pointer'),
                'columns'=>array(
                array(
                    'header'=>'Grupo',
                    'name'=>'grupo',
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
                            \'onclick\'=>\'{agregar("/grupo/actualizar/\'.$data["id"].\'","grupo");}\'
                    )
                );',),
                array(
                    'header'=>'Eliminar',
                    'class'=>'CButtonColumn',
                     'template'=>'{delete}',
                         'buttons'=>array(
                            'delete' => array(
                                'url'=>'Yii::app()->createUrl("grupo/delete", array("id"=>$data->id))',
                        ),
                    ),
                ),
            )
        ));
?>
<?php echo CHtml::link('Registrar grupo(+)', "",  // the link for open the dialog
    array(
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregar('/grupo/nuevoGrupo','grupo');}"));
		?>
</div>
<div  class="crugepanel">
<h1>Tipo</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'tipo',
                'summaryText'=>'',
                'selectableRows'=>1,
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
                            \'onclick\'=>\'{agregar("/tipo/actualizar/\'.$data["id"].\'","tipo");}\'
                    )
                );',),
                array(
                    'header'=>'Eliminar',
                    'class'=>'CButtonColumn',
                     'template'=>'{delete}',
                         'buttons'=>array(
                            'delete' => array(
                                'url'=>'Yii::app()->createUrl("tipo/delete", array("id"=>$data->id))',
                        ),
                    ),
                ),
            )
        ));
?>
<?php echo CHtml::link('Registrar tipo(+)', "",  // the link for open the dialog
    array(
        'id'=>'regColor',
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregar('/tipo/nuevoTipo/','tipo');}"));
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
