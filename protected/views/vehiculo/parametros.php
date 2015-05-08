<?php
/* @var $this CombustibleController */
/* @var $model Historicocombustible */

$this->breadcrumbs=array(
	'Repuestos'=>array('index'),
	'Parámetros',
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
<h1>Repuestos</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'repuestos',
				'summaryText'=>'',
				'selectableRows'=>1,
				'template'=>"{items}\n{summary}\n{pager}",
				'emptyText'=>'no hay repuestos registrados',
                'dataProvider'=>$repuestos,
				'htmlOptions'=>array('style'=>'font-size: 1.0em;cursor:pointer'),
				'columns'=>array(
				array(
					'header'=>'Repuesto',
					'name'=>'repuesto',
                    'value'=>'$data->repuesto',
					'htmlOptions'=>array('style'=>'text-align:center'),
				),
				/*array(
					'header'=>'Descripción',
					'name'=>'descripcion',
					'value'=>'$data->descripcion',
					'htmlOptions'=>array('style'=>'text-align:center;width:180px'),
				),*/
                array(
                    'header'=>'Subtipo',
                    'name'=>'idsubTipoRepuesto',
                    'value'=>'$data->idsubTipoRepuesto0->subTipo',
                    'htmlOptions'=>array('style'=>'text-align:center;'),
                ),
                array(
                    'header'=>'Tipo',
                    'name'=>'idsubTipoRepuesto',
                    'value'=>'$data->idsubTipoRepuesto0->idTipoRepuesto0->tipo',
                    'htmlOptions'=>array('style'=>'text-align:center;'),
                ),
 
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;'),
					'htmlOptions'=>array('style'=>'text-align:center;'),
					'header'=>'Editar',
					'type'=>'raw',
					'value'=>'CHtml::link(
                    CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                      "Agregar",array("title"=>"Editar")),
                    "",
                    array(
                            \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                            \'onclick\'=>\'{editarRepuesto("\'.Yii::app()->createUrl("Repuesto/actualizar",array("id"=>$data["id"])).\'");}\'
                    )
                );',),
				array(
					'header'=>'Eliminar',
					'class'=>'CButtonColumn',
					 'template'=>'{delete}',
					     'buttons'=>array(
							'delete' => array(
								'url'=>'Yii::app()->createUrl("repuesto/delete", array("id"=>$data->id))',
						),
					),
				),
			)
        ));
?>

</div>
<div class='crugepanel user-assignments-detail'>
<h1>Tipo y subtipo de repuesto</h1>
<div id="combusti" style="width:48%;float:left">
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'tipo',
                'summaryText'=>'',
                'selectableRows'=>1,
                'selectionChanged'=>'tipo',
                'template'=>"{items}\n{summary}\n{pager}",
                'emptyText'=>'no hay tipos registrados',
                'dataProvider'=>$tipo,
                'htmlOptions'=>array('style'=>'font-size: 1.0em;cursor:pointer'),
                'columns'=>array(
                              array(
                    'header'=>'Tipo',
                    'name'=>'tipo',
                    //'value'=>'$data->idsubTipoRepuesto0->subTipo',
                    'htmlOptions'=>array('style'=>'text-align:center;'),
                ),
 
                array(
                    'headerHtmlOptions'=>array('style'=>'text-align:center;'),
                    'htmlOptions'=>array('style'=>'text-align:center;'),
                    'header'=>'Editar',
                    'type'=>'raw',
                    'value'=>'CHtml::link(
                    CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                      "Agregar",array("title"=>"Editar")),
                    "",
                    array(
                            \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                            \'onclick\'=>\'{editarTipo("\'.Yii::app()->createUrl("tiporepuesto/actualizar",array("id"=>$data["id"])).\'");}\'
                    )
                );',),
                array(
                    'header'=>'Eliminar',
                    'class'=>'CButtonColumn',
                     'template'=>'{delete}',
                         'buttons'=>array(
                            'delete' => array(
                                'url'=>'Yii::app()->createUrl("tiporepuesto/delete", array("id"=>$data->id))',
                        ),
                    ),
                ),
            )
        ));
?>
<?php echo CHtml::link('Registrar tipo(+)', "",  // the link for open the dialog
    array(
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregarTipo(); $('#agregarTipo').dialog('open');}"));
		?>	
</div>
<div id="costo" style="width:48%;float:right">
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'subtipo',
                'summaryText'=>'',
                'selectableRows'=>1,
                'template'=>"{items}\n{summary}\n{pager}",
                'emptyText'=>'no hay tipos registrados',
                'dataProvider'=>$subtipo,
                'htmlOptions'=>array('style'=>'font-size: 1.0em;cursor:pointer'),
                'columns'=>array(
                array(
                    'header'=>'Subtipo',
                    'name'=>'subTipo',
                    //'value'=>'$data->idsubTipoRepuesto0->subTipo',
                    'htmlOptions'=>array('style'=>'text-align:center;'),
                ),
 
                array(
                    'headerHtmlOptions'=>array('style'=>'text-align:center;'),
                    'htmlOptions'=>array('style'=>'text-align:center;'),
                    'header'=>'Editar',
                    'type'=>'raw',
                    'value'=>'CHtml::link(
                    CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                      "Agregar",array("title"=>"Editar")),
                    "",
                    array(
                            \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                            \'onclick\'=>\'{editarSubTipo("\'.Yii::app()->createUrl("subtiporepuesto/actualizar",array("id"=>$data["id"])).\'");}\'
                    )
                );',),
                array(
                    'header'=>'Eliminar',
                    'class'=>'CButtonColumn',
                     'template'=>'{delete}',
                         'buttons'=>array(
                            'delete' => array(
                                'url'=>'Yii::app()->createUrl("subtiporepuesto/delete", array("id"=>$data->id))',
                        ),
                    ),
                ),
            )
        ));
?>
<?php echo CHtml::link('Registrar subtipo(+)', "",  // the link for open the dialog
    array(
		'id'=>'regSubtipo',
        'style'=>'cursor: pointer; text-decoration: underline;display:none;',
        'onclick'=>"{agregarSubTipo();}"));
		?>	
</div>
</div>
<?php
/*ventana agregar recurso*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'editarRepuesto',
    'options'=>array(
        'title'=>'Editar Repuesto',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>420,
        //'height'=>360,
		'position'=>array(null,100),
		'resizable'=>false
    ),
));?>
<div class="divForForm"></div>
 
<?php $this->endWidget();?>
<?php
/*ventana agregar recurso*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'agregarSubTipo',
    'options'=>array(
        'title'=>'Registrar Subtipo',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>420,
        //'height'=>360,
		'position'=>array(null,100),
		'resizable'=>false
    ),
));?>
<div class="divForForm"></div>
 
<?php $this->endWidget();?>
<?php
/*ventana agregar recurso*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'agregarTipo',
    'options'=>array(
        'title'=>'Registrar Tipo de repuesto',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>420,
        //'height'=>360,
		'position'=>array(null,100),
		'resizable'=>false
    ),
));?>
<div class="divForForm"></div>
 
<?php $this->endWidget();?>
<style>
#menu {
    font-size: 15px;
}
.crugepanel {
    background-color: #FFF;
    border: 1px dotted #AAA;
    border-radius: 1px;
    box-shadow: 3px 3px 5px #EEE;
    display: block;
    margin-top: 10px;
    padding: 10px;
	overflow:auto;
}

.grid-view table.items th {
    text-align: center;
    background: none repeat scroll 0% 0% rgba(0, 138, 255, 0.15);
	color: #000;
}
.grid-view table.items th a {
    color: #000!important;
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

function agregarCombustible(){
	jQuery.ajax({
                url: "<?php echo Yii::app()->baseUrl;?>"+"/Tipocombustible/agregarCombustible",
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        //$('#dialog div.divForForm').html(data.div);
										$('#agregarCombustible div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        //$('#dialog div.divForForm form').submit(agregarActividad); // updatePaymentComment
										$('#agregarCombustible div.divForForm form').submit(agregarCombustible);
										//$("#link").hide();
										//$("#agreAct").show();
										//$('body').scrollTo('#agreAct',{duration:'slow', offsetTop : '50'});
										//$.scrollTo($('#agreAct').offset().top-100, { duration:300});
                                }
                                else{
                                        //$('#dialog div.divForForm').html(data.div);
										$('#agregarCombustible div.divForForm').html(data.div);
                                        //setTimeout("agregarActividad()",1000);
                                        $('#agregarCombustible').dialog('close');
										$.fn.yiiGridView.update('combustible');
                                }
                        } ,
                'cache':false});
    return false; 
}
function editarRepuesto(id){
$('#editarRepuesto').dialog('open');
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
                                        $('#editarRepuesto div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        //$('#dialog div.divForForm form').submit(agregarActividad); // updatePaymentComment
										$('#editarRepuesto div.divForForm form').submit(editarRepuesto);
                                }
                                else
                                {
                                        $('#editarRepuesto div.divForForm').html(data.div);
                                        //setTimeout("agregarActividad()",1000);
                                        $('#editarRepuesto').dialog('close');
										$.fn.yiiGridView.update('repuestos');
										
                                }
                        } ,
                'cache':false});
    return false; 
}
function editarCombustible(id){
$('#agregarCombustible').dialog('open');
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
                                        $('#agregarCombustible div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        //$('#dialog div.divForForm form').submit(agregarActividad); // updatePaymentComment
										$('#agregarCombustible div.divForForm form').submit(editarCombustible);
                                }
                                else
                                {
                                        $('#agregarCombustible div.divForForm').html(data.div);
                                        //setTimeout("agregarActividad()",1000);
                                        $('#agregarCombustible').dialog('close');
										$.fn.yiiGridView.update('combustible');
                                }
                        } ,
                'cache':false});
    return false; 
}

function agregarTipo(){
	$('#agregarTipo').dialog('open');
	//var idTipo = $.fn.yiiGridView.getSelection('tipo');
	jQuery.ajax({
                url: "<?php echo Yii::app()->baseUrl;?>"+"/tiporepuesto/agregarTipo/",
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        //$('#dialog div.divForForm').html(data.div);
										$('#agregarTipo div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        //$('#dialog div.divForForm form').submit(agregarActividad); // updatePaymentComment
										$('#agregarTipo div.divForForm form').submit(agregarTipo);
										//$("#link").hide();
										//$("#agreAct").show();
										//$('body').scrollTo('#agreAct',{duration:'slow', offsetTop : '50'});
										//$.scrollTo($('#agreAct').offset().top-100, { duration:300});
                                }
                                else{
                                        //$('#dialog div.divForForm').html(data.div);
										$('#agregarTipo div.divForForm').html(data.div);
                                        //setTimeout("agregarActividad()",1000);
                                        $('#agregarTipo').dialog('close');
										$.fn.yiiGridView.update('tipo');
                                }
                        } ,
                'cache':false});
    return false; 
}
function editarTipo(id){
$('#agregarTipo').dialog('open');
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
                                        $('#agregarTipo div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        //$('#dialog div.divForForm form').submit(agregarActividad); // updatePaymentComment
										$('#agregarTipo div.divForForm form').submit(editarTipo);
                                }
                                else
                                {
                                        $('#agregarTipo div.divForForm').html(data.div);
                                        //setTimeout("agregarActividad()",1000);
                                        $('#agregarTipo').dialog('close');
										$.fn.yiiGridView.update('tipo');
                                }
                        } ,
                'cache':false});
    return false; 
}
function agregarSubTipo(){
    $('#agregarSubTipo').dialog('open');
    var idTipo = $.fn.yiiGridView.getSelection('tipo');
    jQuery.ajax({
                url: "<?php echo Yii::app()->baseUrl;?>"+"/subtiporepuesto/agregarSubTipo/"+idTipo,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        //$('#dialog div.divForForm').html(data.div);
                                        $('#agregarSubTipo div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        //$('#dialog div.divForForm form').submit(agregarActividad); // updatePaymentComment
                                        $('#agregarSubTipo div.divForForm form').submit(agregarSubTipo);
                                        //$("#link").hide();
                                        //$("#agreAct").show();
                                        //$('body').scrollTo('#agreAct',{duration:'slow', offsetTop : '50'});
                                        //$.scrollTo($('#agreAct').offset().top-100, { duration:300});
                                }
                                else{
                                        //$('#dialog div.divForForm').html(data.div);
                                        $('#agregarSubTipo div.divForForm').html(data.div);
                                        //setTimeout("agregarActividad()",1000);
                                        $('#agregarSubTipo').dialog('close');
                                        $.fn.yiiGridView.update('subtipo');
                                }
                        } ,
                'cache':false});
    return false; 
}
function editarSubTipo(id){
$('#agregarSubTipo').dialog('open');
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
                                        $('#agregarSubTipo div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        //$('#dialog div.divForForm form').submit(agregarActividad); // updatePaymentComment
                                        $('#agregarSubTipo div.divForForm form').submit(editarSubTipo);
                                }
                                else
                                {
                                        $('#agregarSubTipo div.divForForm').html(data.div);
                                        //setTimeout("agregarActividad()",1000);
                                        $('#agregarSubTipo').dialog('close');
                                        $.fn.yiiGridView.update('subtipo');
                                }
                        } ,
                'cache':false});
    return false; 
}

function tipo(){
	
	var id = $.fn.yiiGridView.getSelection('tipo');
	if(id=="")
		$("#regSubtipo").hide(500);
	else
		$("#regSubtipo").show(500);
	$.fn.yiiGridView.update('subtipo',{ data : "idtipo="+id});
}
</script>
