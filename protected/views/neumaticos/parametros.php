<?php
/* @var $this CombustibleController */
/* @var $model Historicocombustible */

$this->breadcrumbs=array(
	'Neumáticos'=>array('index'),
	'Parámetros',
);

$this->menu=array(

array('label'=>'<div id="menu"><strong>Neumáticos</strong></div>'),
    array('label'=>'      Neumáticos actuales', 'url'=>array('neumaticos/index')),
    array('label'=>'      Plantillas de montaje', 'url'=>array('plantilla')),
    array('label'=>'      Montajes iniciales <span id="mi" title="hay '.$iniciales.' montajes iniciales por definir" class="badge badge-'.$this->Color($iniciales).' pull-right">'.$iniciales.'</span>', 'url'=>array('neumaticos/montajeInicial')),
    
    array('label'=>'<div id="menu"><strong>Averías</strong></div>'),
    array('label'=>'      Registro de averías', 'url'=>array('averiaNeumatico')),
    
    array('label'=>'      Averías por atender <span title="hay '.$totalFalla.' averías en neumaticos por atender" class="badge badge-'.$this->Color($totalFalla).' pull-right">'.$totalFalla.'</span>', 'url'=>array('neumaticos/listaAveriaNeumatico')),
    
    
    array('label'=>'<div id="menu"><strong>Órdenes de neumaticos</strong></div>'),
    
    array('label'=>'      Crear orden de neumaticos', 'url'=>array('neumaticos/crearOrdenNeumaticos')  , 'visible'=>Yii::app()->user->checkAccess('action_neumaticos_crearordenneumaticos')),
    array('label'=>'      Ver órdenes abiertas <span class="badge badge-'.$this->Color($abiertas).' pull-right">'.$abiertas.'</span>', 'url'=>array('neumaticos/verOrdenes')),
    array('label'=>'      Órdenes listas para cerrar <span class="badge badge-'.$this->Color($listas).' pull-right">'.$listas.'</span>', 'url'=>array('neumaticos/cerrarOrdenes')  , 'visible'=>Yii::app()->user->checkAccess('action_neumaticos_cerrarordenes')),
    
    array('label'=>'<div id="menu"><strong>Historial</strong></div>'),
    array('label'=>'      Histórico de averías', 'url'=>array('historicoAverias')),
    array('label'=>'      Histórico de montajes', 'url'=>array('historicoMontajes')),
    //array('label'=>'      Histórico de rotaciones', 'url'=>array('historicoRotaciones')),
    array('label'=>'      Histórico de gastos', 'url'=>array('historicoGastos')),
    array('label'=>'      Histórico de ordenes', 'url'=>array('historicoOrdenes')),
    
    array('label'=>'<div id="menu"><strong>Administrar</strong></div>', 'visible'=>Yii::app()->user->checkAccess('action_neumaticos_parametros')),
    array('label'=>'      Parámetros y datos maestros', 'url'=>array('neumaticos/parametros'), 'visible'=>Yii::app()->user->checkAccess('action_neumaticos_parametros')),
);
?>
<div class='crugepanel'>
<h1>Chasis</h1>
<?php 
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'chasis',
                'summaryText'=>'',
               // 'enableSorting' => false,
                'template'=>"{items}\n{summary}\n{pager}",
                'selectableRows'=>0,
                'emptyText'=>'No hay registros',
                'dataProvider'=>$gridChasis,
                'htmlOptions'=>array('style'=>'clear:both;margin-top: 10px;'),
                'columns'=>array(
                array(
                    'headerHtmlOptions'=>array('style'=>'width:25%'),
                    'header'=>'Nombre',
                    'name'=>'nombre',
                    'htmlOptions'=>array('style'=>'text-align:center;width:100px'),
                     'sortable'=>false,
                ),
                array(
                    'headerHtmlOptions'=>array('style'=>'width:25%'),
                    'header'=>'# Ejes',
                    'name'=>'nroEjes',
                    'htmlOptions'=>array('style'=>'text-align:center;width:100px'),
                     'sortable'=>false,
                ),
                array(
                'headerHtmlOptions'=>array('style'=>'width:30%'),
                    'header'=>'Neumáticos de Uso',
                    'name'=>'cantidadNormales',
                    'value'=>'$data->cantidadNormales',
                    'htmlOptions'=>array('style'=>'text-align:center;width:100px'),
                     'sortable'=>false,
                ),
                array(
                'headerHtmlOptions'=>array('style'=>'width:40%'),
                    'header'=>'Neumáticos de Repuesto',
                    'name'=>'cantidadRepuesto',
                    'htmlOptions'=>array('style'=>'text-align:center;width:50px'),
                     'sortable'=>false,
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
                            \'onclick\'=>\'{agregar("/chasis/actualizar/\'.$data["id"].\'","chasis");}\'
                    )
                );',),
                array(
                    'headerHtmlOptions'=>array('style'=>'width:50px'),
                    'header'=>'Eliminar',
                    'class'=>'CButtonColumn',
                     'template'=>'{delete}',
                      'afterDelete'=>'function(link,success,data){
                                   
                            }',
                            
                         'buttons'=>array(
                         
                            'delete' => array(
                                'url'=>'Yii::app()->createUrl("chasis/delete", array("id"=>$data->id))',
                        ),
                    ),
                ),
            )
        ));
        ?>
<?php echo CHtml::link('Registrar chasis(+)', "",  // the link for open the dialog
    array(
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregar('/chasis/agregar','chasis');}"));
?>
</div>
<div class='crugepanel'>
<h1>Posición de ejes</h1>
<?php 
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'posEje',
                'summaryText'=>'',
               // 'enableSorting' => false,
                'template'=>"{items}\n{summary}\n{pager}",
                'selectableRows'=>0,
                'emptyText'=>'No hay registros',
                'dataProvider'=>$gridPosEje,
                'htmlOptions'=>array('style'=>'clear:both;margin-top: 10px;'),
                'columns'=>array(

                array(
                    'header'=>'Posición',
                    'name'=>'posicionEje',
 
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
                            \'onclick\'=>\'{agregar("/posicioneje/actualizar/\'.$data["id"].\'","posEje");}\'
                    )
                );',),
                array(
                    'headerHtmlOptions'=>array('style'=>'width:50px'),
                    'header'=>'Eliminar',
                    'class'=>'CButtonColumn',
                     'template'=>'{delete}',
                      'afterDelete'=>'function(link,success,data){
                                   
                            }',
                            
                         'buttons'=>array(
                         
                            'delete' => array(
                                'url'=>'Yii::app()->createUrl("posicioneje/delete", array("id"=>$data->id))',
                        ),
                    ),
                ),
            )
        ));
        ?>
<?php echo CHtml::link('Registrar posición de eje(+)', "",  // the link for open the dialog
    array(
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregar('/posicioneje/AgregarPosicionNueva','posEje');}"));
?>
</div>
<div class='crugepanel'>
<h1>Posición de neumáticos</h1>
<?php 
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'posRueda',
                'summaryText'=>'',
               // 'enableSorting' => false,
                'template'=>"{items}\n{summary}\n{pager}",
                'selectableRows'=>0,
                'emptyText'=>'No hay registros',
                'dataProvider'=>$gridPosRueda,
                'htmlOptions'=>array('style'=>'clear:both;margin-top: 10px;'),
                'columns'=>array(

                array(
                    'header'=>'Posición',
                    'name'=>'posicionRueda',
 
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
                            \'onclick\'=>\'{agregar("/posicionrueda/actualizar/\'.$data["id"].\'","posRueda");}\'
                    )
                );',),
                array(
                    'headerHtmlOptions'=>array('style'=>'width:50px'),
                    'header'=>'Eliminar',
                    'class'=>'CButtonColumn',
                     'template'=>'{delete}',
                      'afterDelete'=>'function(link,success,data){
                                   
                            }',
                            
                         'buttons'=>array(
                         
                            'delete' => array(
                                'url'=>'Yii::app()->createUrl("posicionrueda/delete", array("id"=>$data->id))',
                        ),
                    ),
                ),
            )
        ));
        ?>
<?php echo CHtml::link('Registrar posición de neumático(+)', "",  // the link for open the dialog
    array(
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregar('/posicionrueda/Agregar','posRueda');}"));
?>
</div>
<div class='crugepanel'>
<h1>Neumáticos</h1>
<?php 
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'neumaticos',
                'summaryText'=>'',
               // 'enableSorting' => false,
                'template'=>"{items}\n{summary}\n{pager}",
                'selectableRows'=>0,
                'emptyText'=>'No hay registros',
                'dataProvider'=>$gridNeumaticos,
                'htmlOptions'=>array('style'=>'clear:both;margin-top: 10px;'),
                'columns'=>array(

                array(
                    'header'=>'Medida',
                    'name'=>'idmedidaCaucho',
                    'value'=>'$data->idmedidaCaucho0->medida',
                    'htmlOptions'=>array('style'=>'text-align:center;'),
                ),
                array(
                    'header'=>'Rin',
                    'name'=>'idrin',
                    'value'=>'$data->idrin0->rin',
                    'htmlOptions'=>array('style'=>'text-align:center;width:140px'),
                ),
                array(
                    'header'=>'Piso',
                    'name'=>'idpiso',
                    'value'=>'$data->idpiso0->piso',
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
                            \'onclick\'=>\'{agregar("/Caucho/actualizar/\'.$data["id"].\'","neumaticos");}\'
                    )
                );',),
                array(
                    'headerHtmlOptions'=>array('style'=>'width:50px'),
                    'header'=>'Eliminar',
                    'class'=>'CButtonColumn',
                     'template'=>'{delete}',
                      'afterDelete'=>'function(link,success,data){
                                   
                            }',
                            
                         'buttons'=>array(
                         
                            'delete' => array(
                                'url'=>'Yii::app()->createUrl("caucho/delete", array("id"=>$data->id))',
                        ),
                    ),
                ),
            )
        ));
        ?>
<?php echo CHtml::link('Registrar neumático(+)', "",  // the link for open the dialog
    array(
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregar('/caucho/Agregar','neumaticos');}"));
?>
</div>
<div class='crugepanel'>
<h1>Medidas</h1>
<?php 
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'medidas',
                'summaryText'=>'',
               // 'enableSorting' => false,
                'template'=>"{items}\n{summary}\n{pager}",
                'selectableRows'=>0,
                'emptyText'=>'No hay registros',
                'dataProvider'=>$gridMedidas,
                'htmlOptions'=>array('style'=>'clear:both;margin-top: 10px;'),
                'columns'=>array(

                array(
                    'header'=>'Medida',
                    'name'=>'medida',
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
                            \'onclick\'=>\'{agregar("/Medidacaucho/actualizar/\'.$data["id"].\'","medidas");}\'
                    )
                );',),
                array(
                    'headerHtmlOptions'=>array('style'=>'width:50px'),
                    'header'=>'Eliminar',
                    'class'=>'CButtonColumn',
                     'template'=>'{delete}',
                      'afterDelete'=>'function(link,success,data){
                                   
                            }',
                            
                         'buttons'=>array(
                         
                            'delete' => array(
                                'url'=>'Yii::app()->createUrl("medidacaucho/delete", array("id"=>$data->id))',
                        ),
                    ),
                ),
            )
        ));
    ?>
<?php echo CHtml::link('Registrar medida(+)', "",  // the link for open the dialog
    array(
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregar('/Medidacaucho/Agregar','medidas');}"));
?>
</div>
<div class='crugepanel'>
<h1>Rines</h1>
<?php 
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'rines',
                'summaryText'=>'',
               // 'enableSorting' => false,
                'template'=>"{items}\n{summary}\n{pager}",
                'selectableRows'=>0,
                'emptyText'=>'No hay registros',
                'dataProvider'=>$gridRin,
                'htmlOptions'=>array('style'=>'clear:both;margin-top: 10px;'),
                'columns'=>array(

                array(
                    'header'=>'Rin',
                    'name'=>'rin',
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
                            \'onclick\'=>\'{agregar("/rin/actualizar/\'.$data["id"].\'","rines");}\'
                    )
                );',),
                array(
                    'headerHtmlOptions'=>array('style'=>'width:50px'),
                    'header'=>'Eliminar',
                    'class'=>'CButtonColumn',
                     'template'=>'{delete}',
                      'afterDelete'=>'function(link,success,data){
                                   
                            }',
                            
                         'buttons'=>array(
                         
                            'delete' => array(
                                'url'=>'Yii::app()->createUrl("rin/delete", array("id"=>$data->id))',
                        ),
                    ),
                ),
            )
        ));
    ?>
<?php echo CHtml::link('Registrar rin(+)', "",  // the link for open the dialog
    array(
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregar('/rin/Agregar','rines');}"));
?>
</div>
<div class='crugepanel'>
<h1>Pisos</h1>
<?php 
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'piso',
                'summaryText'=>'',
               // 'enableSorting' => false,
                'template'=>"{items}\n{summary}\n{pager}",
                'selectableRows'=>0,
                'emptyText'=>'No hay registros',
                'dataProvider'=>$gridPiso,
                'htmlOptions'=>array('style'=>'clear:both;margin-top: 10px;'),
                'columns'=>array(

                array(
                    'header'=>'Piso',
                    'name'=>'piso',
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
                            \'onclick\'=>\'{agregar("/piso/actualizar/\'.$data["id"].\'","piso");}\'
                    )
                );',),
                array(
                    'headerHtmlOptions'=>array('style'=>'width:50px'),
                    'header'=>'Eliminar',
                    'class'=>'CButtonColumn',
                     'template'=>'{delete}',
                      'afterDelete'=>'function(link,success,data){
                                   
                            }',
                            
                         'buttons'=>array(
                         
                            'delete' => array(
                                'url'=>'Yii::app()->createUrl("piso/delete", array("id"=>$data->id))',
                        ),
                    ),
                ),
            )
        ));
    ?>
<?php echo CHtml::link('Registrar piso(+)', "",  // the link for open the dialog
    array(
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregar('/piso/Agregar','piso');}"));
?>
</div>
<div class='crugepanel'>
<h1>Marcas</h1>
<?php 
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'marcaCaucho',
                'summaryText'=>'',
               // 'enableSorting' => false,
                'template'=>"{items}\n{summary}\n{pager}",
                'selectableRows'=>0,
                'emptyText'=>'No hay registros',
                'dataProvider'=>$gridMarca,
                'htmlOptions'=>array('style'=>'clear:both;margin-top: 10px;'),
                'columns'=>array(

                array(
                    'header'=>'Marca',
                    'name'=>'nombre',
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
                            \'onclick\'=>\'{agregar("/marcaCaucho/actualizar/\'.$data["id"].\'","marcaCaucho");}\'
                    )
                );',),
                array(
                    'headerHtmlOptions'=>array('style'=>'width:50px'),
                    'header'=>'Eliminar',
                    'class'=>'CButtonColumn',
                     'template'=>'{delete}',
                      'afterDelete'=>'function(link,success,data){
                                   
                            }',
                            
                         'buttons'=>array(
                         
                            'delete' => array(
                                'url'=>'Yii::app()->createUrl("marcaCaucho/delete", array("id"=>$data->id))',
                        ),
                    ),
                ),
            )
        ));
    ?>
<?php echo CHtml::link('Registrar marca(+)', "",  // the link for open the dialog
    array(
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregar('/marcaCaucho/Agregar','marcaCaucho');}"));
?>
</div>
<div class='crugepanel'>
<h1>Averías</h1>
<?php 
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'averia',
                'summaryText'=>'',
               // 'enableSorting' => false,
                'template'=>"{items}\n{summary}\n{pager}",
                'selectableRows'=>0,
                'emptyText'=>'No hay registros',
                'dataProvider'=>$gridAveria,
                'htmlOptions'=>array('style'=>'clear:both;margin-top: 10px;'),
                'columns'=>array(

                array(
                    'header'=>'Avería',
                    'name'=>'falla',
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
                            \'onclick\'=>\'{agregar("/fallacaucho/actualizar/\'.$data["id"].\'","averia");}\'
                    )
                );',),
                array(
                    'headerHtmlOptions'=>array('style'=>'width:50px'),
                    'header'=>'Eliminar',
                    'class'=>'CButtonColumn',
                     'template'=>'{delete}',
                      'afterDelete'=>'function(link,success,data){
                                   
                            }',
                            
                         'buttons'=>array(
                         
                            'delete' => array(
                                'url'=>'Yii::app()->createUrl("fallacaucho/delete", array("id"=>$data->id))',
                        ),
                    ),
                ),
            )
        ));
    ?>
<?php echo CHtml::link('Registrar avería(+)', "",  // the link for open the dialog
    array(
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregar('/fallacaucho/Agregar','averia');}"));
?>
</div>
<div class='crugepanel'>
<h1>Recursos</h1>
<?php 
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'recurso',
                'summaryText'=>'',
               // 'enableSorting' => false,
                'template'=>"{items}\n{summary}\n{pager}",
                'selectableRows'=>0,
                'emptyText'=>'No hay registros',
                'dataProvider'=>$gridRecurso,
                'htmlOptions'=>array('style'=>'clear:both;margin-top: 10px;'),
                'columns'=>array(

                array(
                    'header'=>'Recurso',
                    'name'=>'recurso',
                    'htmlOptions'=>array('style'=>'text-align:center;'),
                ),
                array(
                    'header'=>'Descripción',
                    'name'=>'descripcion',
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
                            \'onclick\'=>\'{agregar("/recursocaucho/actualizar/\'.$data["id"].\'","recurso");}\'
                    )
                );',),
                array(
                    'headerHtmlOptions'=>array('style'=>'width:50px'),
                    'header'=>'Eliminar',
                    'class'=>'CButtonColumn',
                     'template'=>'{delete}',
                      'afterDelete'=>'function(link,success,data){
                                   
                            }',
                            
                         'buttons'=>array(
                         
                            'delete' => array(
                                'url'=>'Yii::app()->createUrl("recursocaucho/delete", array("id"=>$data->id))',
                        ),
                    ),
                ),
            )
        ));
    ?>
<?php echo CHtml::link('Registrar recurso(+)', "",  // the link for open the dialog
    array(
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregar('/recursocaucho/Agregar','recurso');}"));
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
