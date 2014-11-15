<?php 
	$this->breadcrumbs=array(
	'Partes y piezas'=>array('repuesto/index'),
	'Asignación',
);


	$selectedUserGetter = 'repuesto';
	$seleccionCantidad = 'cantidad';
	
	$this->menu=array(
	array('label'=>'Registrar pieza', 'url'=>array('repuesto/create')),
	array('label'=>'Crear nuevo grupo', 'url'=>array('grupo/create')),
	array('label'=>'Ver piezas asignadas', 'url'=>array('detallePiezaGrupo/detallepieza')),
	array('label'=>'Atrás', 'url'=>array('repuesto/index')),
);
?>
<div class='form'>
<div class='crugepanel user-assignments-role-list'>
	<h1><?php echo ucfirst(CrugeTranslator::t("Asignación de piezas a grupo de vehiculos"));?></h1>
	<p><?php echo ucfirst(CrugeTranslator::t("Haz click en un grupo para asignar las partes y repuestos correspondientes"));?></p>
	<strong><p><?php echo ucfirst(CrugeTranslator::t("Grupos registrados:"));?></p></strong>
	<ul class='auth-item'>
	<?php 
		$loader = "<span class='loader'></span>";		
		foreach($grupo as $datos){
			echo "<strong><li alt='".$datos->grupo."'>".$datos->grupo.$loader."</li></strong>";
		}
	?>
	</ul>
</div>
<div class='crugepanel user-assignments-detail'>
	<h6><div id='mostrarSeleccion'>Seleccione un grupo</div></h6>
	
	<div id='lista1' class='lista'>
	
		
	<div id='revocarSeleccion' class='boton'>
		<?php echo CrugeTranslator::t("Quitar piezas") ?>
		
	</div>

	<?php 
		
	//print_r($uno);
	//echo 'separoo';
	//print_r($dos);
		$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'_lista1',
			'selectableRows'=>2,
			'dataProvider'=>$piezasGrupo,
			'enablePagination' => false,
			'afterAjaxUpdate' => "actualizar",
			'template'=>"{items}\n{summary}\n{pager}",
			'ajaxUpdate' => true,
			'columns'=>array(
				
				array(
					'class'=>'CCheckBoxColumn'
				),
				
				array(
					'header'=>'Pieza agregadas',
					'name'=>'repuesto',
				),
				array(
					'header'=>'Categoría',
					'name'=>'subTipo',
					
					//'footer'=>'',
				),
				array(
					'header'=>'Cantidad',
					'name'=>'cantidad',
					'htmlOptions'=>array('style'=>'text-align:center;width:20px'),
				),
			),
		));
	?>	
	</div>
		
	<div id='lista2' class='lista'>
	<div id='asignarSeleccion' class='boton'>
		<?php 
		echo CrugeTranslator::t("Agregar piezas");?></div>

	<?php 
	
		$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'_lista2',
			'filter'=>$model,
			'selectableRows'=>2,
			'ajaxUpdate' => true,
			'afterAjaxUpdate' => "actualizar",
			'dataProvider'=>$DataProvider,
			'enablePagination' => false,
			'template'=>"{items}{summary}{pager}",
			'columns'=>array(	
			
			array(
					'class'=>'CCheckBoxColumn'
				),
				array(
					'header'=>'Pieza',
					'name'=>'repuesto',
					'filter'=>CHtml::activeTextField($model, 'repuesto',array("placeholder"=>"Búsqueda..")),
					'htmlOptions'=>array('style'=>'width: 140px;'),
					//'footer'=>'',
				),
				array(
					'header'=>'Categoría',
					'name'=>'idsubTipoRepuesto',
					'value'=>'$data->idsubTipoRepuesto0->subTipo',
					'filter' => false,
					//'footer'=>'',
				),
			
				array(
					'header'=>'Cantidad',
					'value'=>'CHTML::textField("campo",1,array(\'id\'=>"campo$data->id",\'width\'=>4,\'maxlength\'=>2,\'onblur\'=>"return validar($data->id)",\'onkeypress\'=>"return justNumbers(event,$data->id)",\'onmousedown\'=>"return seleccion($data->id)",\'style\'=>\'width: 40px;height:16px;margin: 0 auto;text-align: center;\' ))',
					'type'=>'raw',
					'htmlOptions'=>array('style'=>'width: 50px;'),
				),
				
			),
		));
	?>	
	</div>
</div>
</div>
<style type="text/css">

.code {
    color: #666;
    font-family: monospace;
    font-style: italic;
}
.is-superadmin-note {
    background-color: rgb(255, 255, 100);
    border-radius: 5px;
    box-shadow: 3px 3px 5px #eee;
    color: black;
    left: 45%;
    padding: 3px;
    position: absolute;
    text-align: center;
    top: 0;
}
.crugepanel {
    background-color: white;
    border: 1px dotted #aaa;
    border-radius: 5px;
    box-shadow: 3px 3px 5px #eee;
    display: block;
    margin-top: 10px;
    padding: 10px;
	max-width: 800px;
}
.auth-item-error-msg {
    background-color: rgb(255, 200, 200);
    border: 2px solid white;
    color: red;
    font-weight: bold;
    padding: 5px;
    text-align: center;
    width: 50%;
}
img.iconhelp {
    background-color: white;
    border: 2px solid white;
    border-radius: 5px;
    box-shadow: 3px 3px 5px #eee;
    margin: 3px;
    width: 24px;
}
.auth-item-create-button {
    background-color: rgb(255, 255, 240);
    border: 1px dotted #aaa;
    border-radius: 5px;
    box-shadow: 3px 3px 5px #eee;
    margin: 10px 10px 10px 0;
    padding: 5px;
    text-align: center;
    width: 120px;
}
div.form .form-group {
    border: 1px dotted #aaa;
    border-radius: 5px;
    box-shadow: 3px 3px 5px #eee;
    margin-bottom: 10px;
    overflow: auto;
    padding: 10px;
}
div.form .form-group .col {
    float: left;
    margin-right: 10px;
}
div.form h6 {
    background-color: #efefef;
    border-radius: 3px;
    margin-bottom: 10px;
    padding: 5px 5px 5px 10px;
}
div.form .textfield-readonly input {
    background-color: #eee;
    border: medium none;
    color: #333;
}
div.form .item {
    overflow: auto;
}
div.form .item input {
    float: left;
}
div.form .item .hint {
    float: left;
    margin-left: 10px;
}
div.form .hint {
}
div.form .field-group {
    border: 1px dotted #eee;
    border-radius: 5px;
    clear: both;
    margin-bottom: 10px;
    overflow: auto;
    padding: 5px;
	
}
div.form .form-group-vert {
    border: 1px dotted #aaa;
    border-radius: 5px;
    box-shadow: 3px 3px 5px #eee;
    margin-bottom: 10px;
    overflow: auto;
    padding: 10px;
}
div.form .form-group-vert .col {
    float: none;
    margin-right: 10px;
}
#list-auth-items {
    border: 1px solid #efefef;
    border-radius: 5px;
    box-shadow: 3px 3px 5px #eee;
    padding: 10px;
}
#list-auth-items .row {
    background-color: #efefef;
    border-radius: 5px;
    display: block;
    margin-bottom: 10px;
    overflow: auto;
    padding: 5px;
    width: 70%;
}
#list-auth-items .col {
    margin-bottom: 3px;
    min-width: 100px;
    text-align: left;
}
#list-auth-items hr {
    margin: 0;
}
#list-auth-items .authname {
    background-color: #ddd;
    border-radius: 5px;
    font-weight: bold;
    padding: 3px;
}
#list-auth-items .operacion {
    float: left;
}
#list-auth-items .operacion-eliminar {
    float: right;
    min-width: 0;
    text-align: right;
    width: auto;
}
#list-auth-items .descr {
    clear: both;
    color: #666;
    display: block;
    font-style: italic;
    margin-top: 5px;
}
#list-auth-items .referencias {
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
    border-radius: 5px;
    box-shadow: 3px 3px 5px #eee;
    float: left;
    margin-bottom: 10px;
    margin-left: 10px;
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
#auth-item-tree .loop {
    color: red;
    font-style: italic;
}
div.user-assignments-role-list {
}
div.user-assignments-detail {
    overflow: auto;
}
div.user-assignments-detail .lista {
    border: 1px solid #eee;
    border-radius: 5px;
    float: left;
    margin-right: 10px;
    padding: 10px;
    width: 46%;
	min-width: 200px;
}
div.user-assignments-detail .boton {
    background-image: url("hand.png");
    background-repeat: no-repeat;
    color: rgb(0, 100, 255);
    font-weight: bold;
    height: 32px;
    padding: 5px 5px 5px 34px;
    text-decoration: underline;
    text-transform: capitalize;
}
div.user-assignments-detail .boton:hover {
    background-color: rgb(200, 255, 200);
}
div.user-assignments-detail #lista1 .boton {
    background-image: url("<?php echo Yii::app()->request->baseUrl;?>/imagenes/hand-off.png");
}
div.user-assignments-detail #lista2 .boton {
    background-image: url("<?php echo Yii::app()->request->baseUrl;?>/imagenes/hand.png");
}
.grid-view table.items th {
    color: #000;
    background: none repeat scroll 0% 0% #D9EDFF;
    text-align: center;
}
.grid-view table.items th a {
    color: #000;
    font-weight: bold;
    text-decoration: none;
}
</style>
<script>
	var i=0;
	var itemName=""	;
	var veces=0;
	function actualizar(lista,itemName){
	if(lista==1){
			$.fn.yiiGridView.update('_lista1',{ data : "itemName="+itemName+"&mode=select" });
			$.fn.yiiGridView.update('_lista2',{ data : "itemName="+itemName+"&mode=select" });
		}
		veces++;
	if(veces>=3){
		if(i<4){
				//$.fn.yiiGridView.update('_lista1');
				$.fn.yiiGridView.update('_lista2');
				i++;
			}
		}
	}
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
	i=0;
		var li = $(this);
		li.css("cursor","pointer");
		li.click(function(){
			itemName = $(this).attr('alt');
			_setSelectedItemName("");
			$('.user-assignments-role-list ul').find('li').each(function(){
				$(this).removeClass('selected');
			});
			$(this).addClass('selected');
			_setSelectedItemName(itemName);
			// actualiza la lista1, que contiene los usuarios que tienen la asignacion	
			//$.fn.yiiGridView.update('_lista1',{ data : "itemName="+itemName+"&mode=select" });
			//$.fn.yiiGridView.update('_lista2',{ data : "itemName="+itemName+"&mode=select" });
			actualizar(1,itemName);
		});
	});
	$('#asignarSeleccion').css("cursor","pointer");
	$('#asignarSeleccion').click(function(){
	i=0;
		var total = geTotal();
		if(!_isSelectedItemName()){
			alert('Por favor primero seleccione un grupo');
			return;
		}
		var itemName = _getSelectedItemName();
		var selectedUsers = $.fn.yiiGridView.getSelection('_lista2');
		
		if(((selectedUsers == 'undefined') || (selectedUsers==""))==false){
			$.fn.yiiGridView.update('_lista1',
				{ 
				data : "itemName="+itemName+"&id="+selectedUsers+"&mode=assign&total="+total });
		}
		//$.fn.yiiGridView.update('_lista2');
		
	});

	$('#revocarSeleccion').css("cursor","pointer");
	$('#revocarSeleccion').click(function(){
	i=0;
		if(!_isSelectedItemName())return;
		var itemName = _getSelectedItemName();
		var selectedUsers = $.fn.yiiGridView.getSelection('_lista1');
		if(((selectedUsers == 'undefined') || (selectedUsers==""))==false){
			$.fn.yiiGridView.update('_lista1',
				{ data : "itemName="+itemName+"&id="+selectedUsers+"&mode=revoke" });
		}
		//$.fn.yiiGridView.update('_lista2',{ data : "itemName="+itemName+"&mode=select" });
	});
	/*
$("input[name=campo]").focusout(function() {
	alert('focusout');
});
$( "input[name=campo]" ).click(function() {
	alert();
});*/
	function seleccion(){
		$('.grid-view table.items').children('tbody').children().each(function () {
			if($(this).hasClass('selected')) {
				
				$(this).addClass('selected');
			}
		});
	}
	function validar(id){
			if($('#campo'+id).val()==""){
				$('#campo'+id).val('1');
			}
	}			
	function justNumbers(e,id){
    var keynum = window.event ? window.event.keyCode : e.which;
	campo = document.getElementById("campo"+id).value;
    if ((keynum == 8)  || (keynum == 0) || (keynum == 13))
    return true;
    return /\d/.test(String.fromCharCode(keynum));
}
function geTotal(){
		var otherInputs;
		var values = [];
		var data;
		var total=0;
		$('.grid-view table.items').children('tbody').children().each(function () {
			if($(this).hasClass('selected')) {
						$(this).closest('tr').find("input").each(function() {
						otherInputs = $(this).parents('td').siblings().find('input');
							data = $(otherInputs[0]).val();
							values.push(data);
							total++;
							return false;
						});
			}
		});
			return values;
    }
	


</script>

