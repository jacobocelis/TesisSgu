<?php
/* @var $this CombustibleController */
/* @var $model Historicocombustible */

$this->breadcrumbs=array(
	'Combustible'=>array('index'),
	'Histórico',
);

$this->menu=array(

    array('label'=>'<div id="menu"><strong>Combustible</strong></div>'),
    array('label'=>'      Reposiciónes', 'url'=>array('combustible/index')),
    array('label'=>'      Registrar reposición', 'url'=>array('combustible/registrarReposicion')),
    
    array('label'=>'<div id="menu"><strong>Historial</strong></div>'),
    array('label'=>'      Histórico de reposiciónes', 'url'=>array('combustible/historicoReposicion')),
    array('label'=>'      Histórico de gastos', 'url'=>array('combustible/historicoGastos')),
    array('label'=>'<div id="menu"><strong>Parámetros</strong></div>' , 'visible'=>Yii::app()->user->checkAccess('action_combustible_parametros')),
    array('label'=>'      Administración de parámetros', 'url'=>array('combustible/parametros'), 'visible'=>Yii::app()->user->checkAccess('action_combustible_parametros')),    
);
?>
<div class='crugepanel user-assignments-detail'>
<h1>Estaciones de servicio</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'estaciones',
				'summaryText'=>'',
				'selectableRows'=>1,
				'template'=>"{items}\n{summary}\n{pager}",
				'emptyText'=>'no se han registrado reposiciones',
                'dataProvider'=>$dataProvider,
				'htmlOptions'=>array('style'=>'font-size: 1.0em;cursor:pointer'),
				'columns'=>array(
				array(
					'header'=>'Nombre',
					'name'=>'nombre',
					'htmlOptions'=>array('style'=>'text-align:center;width:40%'),
				),
				array(
					'header'=>'Ubicación',
					'name'=>'direccion',
					//'value'=>'$data->idfalla0->falla',
					'htmlOptions'=>array('style'=>'text-align:center;width:40%'),
				),
				array(
						'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;'),
						'htmlOptions'=>array('style'=>'text-align:center;'),
						'header'=>'Editar',
						'type'=>'raw',
						'value'=>'CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{editarEstacion("\'.Yii::app()->createUrl("Estacionservicio/actualizar",array("id"=>$data["id"])).\'");}\'
                        )
                );',),
				array(
					'header'=>'Eliminar',
					'class'=>'CButtonColumn',
					 'template'=>'{delete}',
					     'buttons'=>array(
							'delete' => array(
								'url'=>'Yii::app()->createUrl("Estacionservicio/delete", array("id"=>$data->id))',
						),
					),
				),
			)
        ));
?>
<?php echo CHtml::link('Registrar estación(+)', "",  // the link for open the dialog
    array(
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregarEstacion(); $('#agregarEstacion').dialog('open');}"));
		?>	

</div>
<div class='crugepanel user-assignments-detail'>
<h1>Combustible y costo</h1>
<div id="combusti" style="width:48%;float:left">
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'combustible',
				'summaryText'=>'',
				'selectableRows'=>1,
				'selectionChanged'=>"tipo",
				'template'=>"{items}\n{summary}\n{pager}",
				'emptyText'=>'no se han registrado reposiciones',
                'dataProvider'=>$combustible,
				'htmlOptions'=>array('style'=>'font-size: 1.0em;cursor:pointer'),
				'columns'=>array(
				array(
					'header'=>'Combustible',
					'name'=>'combustible',
					'htmlOptions'=>array('style'=>'text-align:center;width:70%'),
				),
				
				array(
						'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;'),
						'htmlOptions'=>array('style'=>'text-align:center;'),
						'header'=>'Editar',
						'type'=>'raw',
						'value'=>'CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{editarCombustible("\'.Yii::app()->createUrl("Tipocombustible/actualizar",array("id"=>$data["id"])).\'");}\'
                        )
                );',),
				array(
					'header'=>'Eliminar',
					'class'=>'CButtonColumn',
					 'template'=>'{delete}',
					     'buttons'=>array(
							'delete' => array(
								'url'=>'Yii::app()->createUrl("Tipocombustible/delete", array("id"=>$data->id))',
						),
					),
				),
			)
        ));
?>
<?php echo CHtml::link('Registrar combustible(+)', "",  // the link for open the dialog
    array(
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregarCombustible(); $('#agregarCombustible').dialog('open');}"));
		?>	
</div>
<div id="costo" style="width:48%;float:right">
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'costos',
				'summaryText'=>'',
				'selectableRows'=>1,
				'template'=>"{items}\n{summary}\n{pager}",
				'emptyText'=>'no se han registrado reposiciones',
                'dataProvider'=>$costo,
				'htmlOptions'=>array('style'=>'font-size: 1.0em;'),
				'columns'=>array(
				array(
					'header'=>'Tipo',
					'name'=>'tipo',
					'htmlOptions'=>array('style'=>'text-align:center;width:40%'),
				),
				array(
					'header'=>'Costo x Litro (Bs.)',
					'name'=>'costoLitro',
					//'value'=>'$data->idfalla0->falla',
					'htmlOptions'=>array('style'=>'text-align:center;width:40%'),
				),
				array(
						'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;'),
						'htmlOptions'=>array('style'=>'text-align:center;'),
						'header'=>'Editar',
						'type'=>'raw',
						'value'=>'CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{editarTipo("\'.Yii::app()->createUrl("Combust/actualizar",array("id"=>$data["id"])).\'");}\'
                        )
                );',),
				array(
					'header'=>'Eliminar',
					'class'=>'CButtonColumn',
					 'template'=>'{delete}',
					     'buttons'=>array(
							'delete' => array(
								'url'=>'Yii::app()->createUrl("Combust/delete", array("id"=>$data->id))',
						),
					),
				),
			)
        ));
?>
<?php echo CHtml::link('Registrar tipo(+)', "",  // the link for open the dialog
    array(
		'id'=>'regCosto',
        'style'=>'cursor: pointer; text-decoration: underline;display:none;',
        'onclick'=>"{agregarTipo();}"));
		?>	
</div>
</div>
<?php
/*ventana agregar recurso*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'agregarEstacion',
    'options'=>array(
        'title'=>'Registrar estación',
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
    'id'=>'agregarCombustible',
    'options'=>array(
        'title'=>'Registrar Combustible',
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
        'title'=>'Registrar Tipo de combustible',
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
function agregarEstacion(){
	jQuery.ajax({
                url: "<?php echo Yii::app()->baseUrl;?>"+"/Estacionservicio/agregarEstacion",
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        //$('#dialog div.divForForm').html(data.div);
										$('#agregarEstacion div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        //$('#dialog div.divForForm form').submit(agregarActividad); // updatePaymentComment
										$('#agregarEstacion div.divForForm form').submit(agregarEstacion);
										//$("#link").hide();
										//$("#agreAct").show();
										//$('body').scrollTo('#agreAct',{duration:'slow', offsetTop : '50'});
										//$.scrollTo($('#agreAct').offset().top-100, { duration:300});
                                }
                                else{
                                        //$('#dialog div.divForForm').html(data.div);
										$('#agregarEstacion div.divForForm').html(data.div);
                                        //setTimeout("agregarActividad()",1000);
                                        $('#agregarEstacion').dialog('close');
										$.fn.yiiGridView.update('estaciones');
                                }
                        } ,
                'cache':false});
    return false; 
}
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
function editarEstacion(id){
$('#agregarEstacion').dialog('open');
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
                                        $('#agregarEstacion div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        //$('#dialog div.divForForm form').submit(agregarActividad); // updatePaymentComment
										$('#agregarEstacion div.divForForm form').submit(editarEstacion);
                                }
                                else
                                {
                                        $('#agregarEstacion div.divForForm').html(data.div);
                                        //setTimeout("agregarActividad()",1000);
                                        $('#agregarEstacion').dialog('close');
										$.fn.yiiGridView.update('estaciones');
										
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
	var idTipo = $.fn.yiiGridView.getSelection('combustible');
	jQuery.ajax({
                url: "<?php echo Yii::app()->baseUrl;?>"+"/Combust/agregarTipo/"+idTipo,
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
										$.fn.yiiGridView.update('costos');
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
										$.fn.yiiGridView.update('costos');
                                }
                        } ,
                'cache':false});
    return false; 
}

function tipo(){
	
	var id = $.fn.yiiGridView.getSelection('combustible');
	if(id=="")
		$("#regCosto").hide(500);
	else
		$("#regCosto").show(500);
	$.fn.yiiGridView.update('costos',{ data : "id="+id});
}
</script>
