<style>
negro{
	color: rgba(0, 0, 0, 1);
}
rojo{
	color: rgba(255, 0, 0, 1);
}
ul, ol {
    padding: 0px;
    margin: 0px 0px 10px 0px;
}
#actividades{
	font-weight: bold;
	font-size: 14px !important;
	font-family: "Carrois Gothic",sans-serif;
	text-align: center;
	padding: 3px;
	margin-bottom: 0px;
	color: #000;
	background: none repeat scroll 0% 0% #C6DDED;
	text-align: center;
	border: 1px solid #94A8FF;
}
#recursos{
	font-weight: bold;
	font-size: 14px !important;
	font-family: "Carrois Gothic",sans-serif;
	
	text-align: center;
	padding: 5px;
	margin-bottom: 10px;
	color: #000;
	background: none repeat scroll 0% 0% #BCF4CA;
	text-align: center;
	border: 1px solid #32EA35;
}
#activi{
	font-weight: bold;
	
	text-align: left;
	padding: 5px;
	color: rgba(255, 0, 0, 1);
	font-size:120%;
	border: 1px solid #F2B3B3;
	background-color: #EFEFEF;
}
#list-auth-items ul.detallar-referencias {
    display: none;
    list-style: none outside none;
    overflow: auto;
}
#list-auth-items ul.detallar-referencias li {
    float: left;
    margin-right: 10px;
}
ul.auth-item {
    list-style: none outside none;
    overflow: auto;
    text-align: left;
}
ul.auth-item input {
    float: left;
    margin-right: 10px;
}
ul.auth-item li {
    border: 1px dotted #aaa;
    border-radius: 0px;
    box-shadow: 3px 3px 5px #eee;
    float: left;
    margin-bottom: 10px;
    margin-right: 10px;
    min-width: 150px;
    padding: 5px;
	text-align: center;
}
ul.auth-item li .loader {
    float: right;
}

ul.auth-item li.checked {
    background-color: rgb(200, 255, 240);
}
ul.auth-item li.selected {
    background-color: #B6FCBB;
}
ul.auth-item li.loop {
    background-color: #ddd;
}
#auth-item-tree ul ul li {
}
#auth-item-tree ul ul ul li {
}
#auth-item-tree ul ul .itemtext {
}
#auth-item-tree ul ul ul .itemchildtext {
}
#auth-item-tree ul ul .checked {
    color: blue;
}
#auth-item-tree ul ul ul .checked {
    color: blue;
}

</style>
<?php 
	$this->breadcrumbs=array(
	'Mantenimiento preventivo'=>array('mttoPreventivo/index'),
	'Actividades de mantenimiento preventivo',
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
	
 
	
	array('label'=>'<div id="menu"><strong>Historial</strong></div>'),
	array('label'=>'      Histórico de mantenimientos', 'url'=>array('mttoPreventivo/historicoPreventivo') ,'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_historicoPreventivo')),
	array('label'=>'      Histórico de gastos', 'url'=>array('mttoPreventivo/historicoGastos'),'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_historicoGastos')),
	array('label'=>'      Histórico de ordenes', 'url'=>array('mttoPreventivo/historicoOrdenes'),'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_historicoOrdenes')),

	array('label'=>'<div id="menu"><strong>Administrar</strong></div>' , 'visible'=>'1'),
	array('label'=>'      Parámetros y datos maestros', 'url'=>array('mttoPreventivo/parametros')),
);
?>
<div class='form'>
<div class='crugepanel user-assignments-role-list'>
	<h1>Actividades para el mantenimiento preventivo</h1>
	<strong><p>Grupos registrados:</p></strong>
	<ul class='auth-item'>
	<?php 
		$loader = "<span class='loader'></span>";		
		foreach($grupo as $datos){
			echo "<strong><li alt='".$datos->grupo."' id='".$datos->id."'>".$datos->grupo.$loader."</li></strong>";
		}
	?>
	</ul>
<h6><div id='mostrarSeleccion'>Seleccione un grupo para asignarle actividades de mantenimiento</div></h6>
	</div>
<div id='activ' style="display:none" class='crugepanel user-assignments-detail'>
			<div id='actividades'>Actividades</div>
			<?php 
			$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'act',
			'selectableRows'=>1,
			'dataProvider'=>$actividades,
			'enablePagination' => false,
			'template'=>"{items}{summary}{pager}",
			'emptyText' => 'no hay actividades agregadas',
			'summaryText' => '',
			
			//'selectionChanged'=>'mostrarRecursos',
			'afterAjaxUpdate'=>'actualizarSpan',
			//'beforeAjaxUpdate'=>'itemGridBeforeAjaxUpdate',
			//'afterAjaxUpdate'=>'itemGridAfterAjaxUpdate',

			'columns'=>array(	
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:left;'),
					'header'=>'Actividad',
					'name'=>'idactividadMtto',
					'value'=>'$data->idactividadMtto0->actividad',
					//'footer'=>'',
				),
				array(
					'type'=>'raw',
					'headerHtmlOptions'=>array('style'=>'text-align:left;width:25%'),
					'header'=>'Frecuencia',
					'name'=>'frecuenciaKm',
					'value'=>'number_format($data->frecuenciaKm).\' Km \'.($data->frecuenciaMes ? \'ó máximo cada \'.$data->frecuenciaMes.\' \'.$data->idtiempof0->tiempo :\'\')',
					//'footer'=>'',
				),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:left;'),
					'header'=>'Prioridad',
					'name'=>'idprioridad',
					'value'=>'$data->idprioridad0->prioridad',
					//'footer'=>'',
				),
				/*array(
					'headerHtmlOptions'=>array('style'=>'text-align:left;'),
					'header'=>'Procedimiento',
					'name'=>'procedimiento',
					
					//'footer'=>'',
				),*/
				array(
						'headerHtmlOptions'=>array('style'=>'text-align:left;width:12px;'),
						'htmlOptions'=>array('style'=>'text-align:center;'),
						'header'=>'Recursos',
						'type'=>'raw',
						'value'=>'($data->totalRecursos($data->id)==0?\'-\':$data->totalRecursos($data->id)).CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/ver.png",
                                          "Agregar",array("title"=>"Agregar recurso")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{mostrarRecursos("\'.$data["id"].\'");}\'
                        )
                );',),

				array(
						'headerHtmlOptions'=>array('style'=>'text-align:left;width:30px;'),
						'htmlOptions'=>array('style'=>'text-align:center;'),
						'header'=>'Editar',
						'type'=>'raw',
						'value'=>'CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{editarActividad("\'.Yii::app()->createUrl("actividadesgrupo/update",array("id"=>$data["id"])).\'"); $("#agregarAct").dialog("open");}\'
                        )
                );',),
				array(
					'header'=>'Eliminar',
					'class'=>'CButtonColumn',
					 'template'=>'{delete}',
					     'buttons'=>array(
							'delete' => array(
								'url'=>'Yii::app()->createUrl("actividadesgrupo/delete", array("id"=>$data->id))',
						),
					),
				),
			),
		));?>
		<div id="link">
<?php echo CHtml::link('Registrar actividad<img src='.Yii::app()->baseUrl.'/imagenes/agregar.png alt="Agregar"/>', "",  // the link for open the dialog
    array(
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregarActividad(); $('#agregarAct').dialog('open');}"));
		?>	
		</div>
		<div id="agreAct"></div>
	</div>
<div id='recur' style="display:none" class='crugepanel user-assignments-detail'>
			<div id='recursos'>Recursos</div>
		    <div id='activi'><negro>
			Actividad seleccionada:
			</negro>
			<rojo>
			</rojo>
			</div>
		<?php 
			$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'rec',
			'selectableRows'=>1,
			'dataProvider'=>$recurso,
			'enablePagination' => false,
			'template'=>"{items}{summary}{pager}",
			'emptyText' => 'no hay recursos agregados',
			'summaryText' => '',
			'columns'=>array(	
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:left;'),
					'header'=>'Recurso',
					'name'=>'idservicio',
					'value'=>'(($data->idinsumo == null?\'\':$data->idinsumo0->insumo).\'\'.($data->idrepuesto == null?\'\':$data->idrepuesto0->repuesto).\'\'.($data->idservicio == null?\'\':$data->idservicio0->servicio)).\' \'.$data->detalle',
					'htmlOptions'=>array('style'=>'width:350px;'),
					//'footer'=>'',
				),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:left;'),
					'header'=>'Tipo',
					'value'=>'(($data->idinsumo == null?\'\':\'Insumo\').\'\'.($data->idrepuesto == null?\'\':\'Repuesto\').\'\'.($data->idservicio == null?\'\':\'Servicio\'))',
					'htmlOptions'=>array('style'=>'width:70px;'),
				),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:left;'),
					'header'=>'Cantidad',
					'name'=>'cantidad',
					'htmlOptions'=>array('style'=>'width:50px;'),
				),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:left;width:50px;'),
					'header'=>'Unidad',
					'name'=>'idunidad',
					'value'=>'$data->idunidad0->corto',
					'htmlOptions'=>array('style'=>'width:50px;'),
					//'footer'=>'',
				),
				array(
					'header'=>'Eliminar',
					'class'=>'CButtonColumn',
					 'template'=>'{delete}',
					     'buttons'=>array(
							'delete' => array(
								'url'=>'Yii::app()->createUrl("actividadrecursogrupo/delete", array("id"=>$data->id))',
						),
					),
				),
			),
	));?>		
<?php echo CHtml::link('agregar recurso<img src='.Yii::app()->baseUrl.'/imagenes/agregar.png alt="Agregar"/>', "",  // the link for open the dialog
    array(
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregarRecurso(); }"));
?>	
</div>

<?php
/*ventana agregar actividad*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'agregarAct',
    'options'=>array(
        'title'=>'Registro de actividades preventivas',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>600,
        //'height'=>480,
		'resizable'=>false,	
		'position'=>array(null,100),
    ),
));?>
<div id="ConListaActividades" style="display:none;">
<p class="note">Campos con <span class="required">*</span> obligatorios.</p>
	<?php 
			$this->widget('ext.selgridview.SelGridView', array(
			'id'=>'ListaActividades',
			'selectableRows'=>2,
			'dataProvider'=>$listaAct,
			'enablePagination' => true,
			'template'=>"{items}{summary}{pager}",
			'emptyText' => 'no hay actividades agregadas',
			'summaryText' => '',
			'htmlOptions'=>array('style'=>'cursor:pointer;padding: 0px 0;text-align:center;width:100%'),
			'columns'=>array(	

				array(
					'class'=>'CCheckBoxColumn',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;'),
					'header'=>'Actividad *',
					'name'=>'actividad',
					'value'=>'$data->actividad',
					'htmlOptions'=>array('style'=>'text-align:center;'),
					//'footer'=>'',
				),
			),
		));
?>
</div>
<div class="divForForm"></div>
<?php $this->endWidget();?>
<?php
/*ventana agregar recurso*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'recurso',
    'options'=>array(
        'title'=>'Agregar recurso',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>420,
        //'height'=>360,
		'position'=>array(null,100),
		'resizable'=>false,
    ),
));?>
<div id="panelBuscar" style="float:left;width:100%;display:none">
<i><b style="float:left;">Buscar recurso: </b></i>
<?php
$this->widget('ext.myAutoComplete.myAutoComplete',array(
    'name'=>'ajaxrequest',
	'id'=>'buscador',
    // additional javascript options for the autocomplete plugin
    'options'=>array(
        'minLength'=>'1',
        'showAnim'=>'fold',
        'open'=> 'js:function(e, ui) {
        	/*$(".ui-menu-item").css("top", $("ul.ui-autocomplete").cssUnit("top")[0] + 4);
        	$(".ui-menu-item").css("left", $("ul.ui-autocomplete").cssUnit("left")[0] - 2);
        	$(".ui-menu-item").append("<div><span>2,000</span> results found, showing <span>10</span></div>");*/

        }',
       'select'=>"js:function(event, ui) { 
        	Filtrar(ui.item.id,ui.item.tipo);
       }"
    ),
    'source'=>$this->createUrl("vehiculo/buscarRecurso"),
    'htmlOptions'=>array(
        'style'=>'width:300px;float:left',
		'placeholder'=>"Ejemplo: Aceite",
    ),
    'methodChain'=>'.data( "autocomplete" )._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<a><b>" + item.label + "</b><br>" + item.desc + "</a>" )
        .appendTo( ul );
	};'

));
?>

</div><br>
<div class="divForForm"></div>
<?php $this->endWidget();?>
</div>


<script>
var idGrupo;
	<?php /* a cada LI del div de roles le anexa un evento click y le pone un cursor */ ?>
	//$('#_lista2').find('input[type=text],textarea,select').filter(':visible:first').attr('placeholder', 'Búsqueda..');

	//aqui se agrega el grupo seleccionado al label y se muestra en la vista
	var _setSelectedItemName = function(valor){
	//document.writeln(valor); 
		$('#mostrarSeleccion').html(valor);
		$('#mostrarSeleccion').data("itemName",valor);
	}
	//esta funcion devuelve el grupo que este seleccionado
	var _getSelectedItemName = function(){
		return $('#mostrarSeleccion').data("itemName")+"";
	}
	//devuelve el grupo seleccionado sino devuelve undefined
	var _isSelectedItemName = function(){
		return _getSelectedItemName() != 'undefined';
	}
	//se encarga de colocar el nombre del grupo en la vista llamando a setSelectedItemName
	$('.user-assignments-role-list ul').find('li').each(function(){
		var li = $(this);
		li.css("cursor","pointer");
		li.click(function(){
		var itemName = $(this).attr('alt');
			_setSelectedItemName("");
			$('#grupo').val(itemName);
			$('.user-assignments-role-list ul').find('li').each(function(){
				$(this).removeClass('selected');
			});
			$(this).addClass('selected');
			_setSelectedItemName(itemName);
			// actualiza para ver las actividades asociadas al grupo
			var id = $(this).attr('id');
			idGrupo=id;
			$('#activ').show(400);

			$.fn.yiiGridView.update('act',{ data : "idGrupo="+id});
			$("#ListaActividades").selGridView("clearAllSelection");
			$("#agreAct").hide();
			$("#link").show();
		});
	});
/*
$('#act > table > tbody > tr').live('click',function(){
									
									if($(this).hasClass('selected'))
                                       $(this).addClass('selected') 
});
*/
function actualizarSpan(){
	var dir="<?php echo Yii::app()->baseUrl;?>"+"/mttoPreventivo/actualizarSpan";
	$.ajax({
		url: dir,
		'data':$(this).serialize(),
        'dataType':'json',
         'success':function( result ) {
    	     $('#mi').removeClass($('#mi').attr('class')).addClass('badge badge-'+result.color+' pull-right');
			 $('#mi').text(result.total);
		},});
var total="<?php  echo count($actividades->getData());?>";
if(total==0)
	$('#recur').hide();
}
function nuevaActividad(){
	$('#nuevaAct').show(500);
	$("#restante").hide(500);
	jQuery.ajax({
                url: "<?php echo Yii::app()->baseUrl;?>"+"/Actividadmtto/create",
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        $('#nuevaAct ').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        $('#nuevaAct  form').submit(nuevaActividad);
                                }
                                else{
                                        $('#nuevaAct').html(data.div);
                                        //actualizarListaActividades();
                                        $.fn.yiiGridView.update('ListaActividades',{ data : "nuevaAct="+idGrupo});
										 

										$("#restante").show(500);
                                }
                },
                'cache':false});
    return false; 

}
function actualizarListaActividades(){
var dir="<?php echo Yii::app()->baseUrl;?>"+"/mttoPreventivo/actualizarListaActividades";
	$.ajax({  		
          url: dir,
        })
  	.done(function(result) {    	
    	     $('#actividad').html(result);
  	});
}
function ObtenerActividad(id){

	//var id = $.fn.yiiGridView.getSelection('act');
	var dir="<?php echo Yii::app()->baseUrl;?>"+"/mttoPreventivo/ObtenerActividad/"+id;
	$.ajax({  		
          url: dir,
        })
  	.done(function( result ) {    	
    	     $('rojo').text(result);
  	});
}
var ida;
var Uurl;
function editarActividad(id){

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
                                        $('#agregarAct div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        $('#agregarAct div.divForForm form').submit(editarActividad); // updatePaymentComment
                                }
                                else
                                {
                                        $('#agregarAct div.divForForm').html(data.div);
                                        setTimeout("$('#agregarAct').dialog('close') ",1000);
                                        $.fn.yiiGridView.update('act');
                                }
                        } ,
                'cache':false});
    return false; 
}
function agregarActividad(){
	$('#ConListaActividades').show();
	//$.fn.yiiGridView.update('ListaActividades');
	var actividades =$("#ListaActividades").selGridView("getAllSelection");
 	$.fn.yiiGridView.update('ListaActividades',{ data : "actualizar="+idGrupo});
 	//$.fn.yiiGridView.update('ListaActividades',{ data : "activida="+actividades});
	jQuery.ajax({
                url: "agregarActividad/"+idGrupo,
                'data':$(this).serialize()+"&activi="+actividades,
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        //$('#dialog div.divForForm').html(data.div);
										$('#agregarAct div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        //$('#dialog div.divForForm form').submit(agregarActividad); // updatePaymentComment
										$('#agregarAct div.divForForm form').submit(agregarActividad);
										//$("#link").hide();
										//$("#agreAct").show();
										//$('body').scrollTo('#agreAct',{duration:'slow', offsetTop : '50'});
										//$.scrollTo($('#agreAct').offset().top-100, { duration:300});
                                }
                                else{
                                        //$('#dialog div.divForForm').html(data.div);
										$('#agreAct').html(data.div);
                                        //setTimeout("agregarActividad()",1000);
                                        $('#agregarAct').dialog('close');
										$.fn.yiiGridView.update('act');
                                }
                        } ,
                'cache':false});
    return false; 
}
var Uurl;
function editarRecurso(id){
$('#dialog').dialog('open');
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
                                        $('#dialog div.divForForm form').submit(editarRecurso); // updatePaymentComment
                                }
                                else
                                {
                                        $('#dialog div.divForForm').html(data.div);
                                        setTimeout("$('#dialog').dialog('close') ",1000);
                                        $.fn.yiiGridView.update('rec');
										
                                }
                        } ,
                'cache':false});
    return false; 
}
function agregarRecurso(){
$('#recurso').dialog('open');

	jQuery.ajax({
                url: "agregarRecurso/"+ida,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        $('#recurso div.divForForm').html(data.div);
                                        $('#recurso div.divForForm form').submit(agregarRecurso); 
                                }
                                else{
                                        $('#recurso div.divForForm').html(data.div);
                                        $("#panelBuscar").hide();
                                        setTimeout("$('#recurso').dialog('close') ",1000);
                                        $.fn.yiiGridView.update('rec');
                                }
                        },
                'cache':false});
    return false; 
}
function mostrarRecursos(id){
ida=id;
ObtenerActividad(ida);
var altura = $(document).height();
//$("html, body").animate({scrollTop:altura+"px"},500);
//$('#recur').show(500);
	//var idAct = $.fn.yiiGridView.getSelection('act');
	$('#recur').show(500);
	//if(idAct=="")
	//	$('#recur').hide();
	$.fn.yiiGridView.update('rec',{ data : "idAct="+ida});
	$("html, body").animate({scrollTop:altura+"px"},1000);
}
function nuevoInsumo(){
	$("#lista").attr('disabled', true);
	$("#nuevoInsumo").show(500);
	$("#restoFormRecurso").hide(500);
	
	jQuery.ajax({
                url: "<?php echo Yii::app()->baseUrl;?>"+"/Insumo/create",
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        $('#nuevoInsumo ').html(data.div);
                                        
										$('#Insumo_tipoInsumo').val($('#Tipoinsumo_tipo').val());
										$('#nuevoInsumo  form').submit(nuevoInsumo);
                                }
                                else{
                                        $('#nuevoInsumo').html(data.div);
										$("#nuevoInsumo").hide(500);
										$("#restoFormRecurso").show(500);
										$("#lista").attr('disabled', false);
										
										validarInsumoNuevo($('#Tipoinsumo_tipo option:selected').val());
                                }
                },
                'cache':false});
    return false; 

}
function nuevoRepuesto(){
	$("#lista").attr('disabled', true);
	$("#nuevoRepuesto").show(500);
	$("#restoFormRecurso").hide(500);
	jQuery.ajax({
                url: "<?php echo Yii::app()->baseUrl;?>"+"/Repuesto/crear",
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if(data.status == 'failure'){
                                        $('#nuevoRepuesto ').html(data.div);
                                   
										$('#Repuesto_idsubTipoRepuesto').val($('#Subtiporepuesto_subTipo option:selected').val());
										$('#nuevoRepuesto  form').submit(nuevoRepuesto);
                                }
                                else{
                                        $('#nuevoRepuesto').html(data.div);
										$("#nuevoRepuesto").hide(500);
										$("#restoFormRecurso").show(500);
										$("#lista").attr('disabled', false);
										validarRepuestoNuevo($('#Subtiporepuesto_subTipo option:selected').val());
                                }
                },
                'cache':false});
    return false; 
}
function nuevoServicio(){
	$("#lista").attr('disabled', true);
	$("#nuevoServicio").show(500);
	$("#restoFormRecurso").hide(500);
	jQuery.ajax({
                url: "<?php echo Yii::app()->baseUrl;?>"+"/Servicio/crear",
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if(data.status == 'failure'){
                                        $('#nuevoServicio').html(data.div);
										//$('#Repuesto_idsubTipoRepuesto').val($('#Subtiporepuesto_subTipo option:selected').val());
										$('#nuevoServicio  form').submit(nuevoServicio);
                                }
                                else{
                                        $('#nuevoServicio').html(data.div);
										$("#nuevoServicio").hide(500);
										$("#restoFormRecurso").show(500);
										$("#lista").attr('disabled', false);
										validarServicioNuevo();
                                }
                },
                'cache':false});
    return false; 
}
function Filtrar(idrecurso,idtipo){

	jQuery.ajax({
        url: "<?php echo Yii::app()->baseUrl;?>"+"/vehiculo/seleccionarRecurso",
        'data':$(this).serialize()+"&idrecurso="+idrecurso+"&idtipo="+idtipo,
        'type':'post',
        'dataType':'json',
        'success':function(data){
        		if(data.idTipo==1){
        			$("#lista").val(data.idTipo).change();
        			$("#Tipoinsumo_tipo").val(data.idTipoIns).change();
					setTimeout(function(){ $("#Actividadrecursogrupo_idinsumo").val(data.idInsumo).change(); }, 300);

        		}
        		if(data.idTipo==2){
        			$("#lista").val(data.idTipo).change();
        			$("#Subtiporepuesto_subTipo").val(data.idSubTipo).change();
        			setTimeout(function(){ $("#Actividadrecursogrupo_idrepuesto").val(data.idRepuesto).change(); }, 300);
        			
        		}
        		if(data.idTipo==3){
        			$("#lista").val(data.idTipo).change();
        			$("#Actividadrecursogrupo_idservicio").val(data.idServicio);
        		}          
        },
                'cache':false});
    return false; 
}
</script>
<style>
.ui-autocomplete { height: 130px; overflow-y: scroll; overflow-x: hidden;}
</style>