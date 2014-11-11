<?php 
	$this->breadcrumbs=array(
	'Mantenimiento preventivo'=>array('mttoPreventivo/index'),
	'Crear plan',
);
	$this->menu=array(
	array('label'=>'Ver planes de mantenimiento', 'url'=>array('')),
);
?>
<div class='form'>
<div class='crugepanel user-assignments-role-list'>
	<h1><?php echo ucfirst(CrugeTranslator::t("crear un plan asociado a un grupo de vehiculos"));?></h1>
	<p><?php echo ucfirst(CrugeTranslator::t("Haz click en un grupo para crear un plan de mantenimiento"));?></p>
	<strong><p><?php echo ucfirst(CrugeTranslator::t("Grupos registrados:"));?></p></strong>
	<ul class='auth-item'>
	<?php 
		$loader = "<span class='loader'></span>";		
		foreach($grupo as $datos){
			echo "<strong><li alt='".$datos->grupo."'>".$datos->grupo.$loader."</li></strong>";
		}
	?>
	</ul>
<h6><div id='mostrarSeleccion'>Seleccione un grupo</div></h6>
	</div>
	<?php 
	
		if(isset($seleccion)){
				$this->renderPartial('_vista', array('dataProvider'=>$dataProvider,'actividades'=>$actividades,'vacio'=>$vacio,'grupoSel'=>$seleccion));
				//print_r($dataProvider);
				//print_r( $actividades);
				//print_r($vacio);
				
				?>
				<script>$('#mostrarSeleccion').html("<?php echo $seleccion;?>");
				$('.user-assignments-role-list ul').find('li').each(function(){
					if($(this).attr("alt")=="<?php echo $seleccion;?>")
					$(this).addClass('selected');
				});
				</script>
		<?php
			
			}?>

</div>
<form id="formulario" action="<?php echo Yii::app()->createUrl('/mttoPreventivo/crearPlan'); ?>" method="post">
<input id="grupo" type="hidden" name="grupo" />
</form>
<style type="text/css">
.grid-view table.items th a {
    color: rgba(0, 0, 0, 1);
    font-weight: bold;
    text-decoration: none;
}
.grid-view table.items th {
    color: #AAA;
    background: none repeat scroll 0% 0% #C6DDED;
    text-align: center;
}
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
.grid-view table.items tbody tr:hover {
    background: none repeat scroll 0 0 #b6fcbb;
}

.grid-view table.items tr.selected:hover {
    background: none repeat scroll 0 0 #b6fcbb;
}
.grid-view table.items tr.selected {
    background: none repeat scroll 0 0 #b6fcbb;
}
table.treetable tr.selected {
    background-color: #b6fcbb;
    color: #111;
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
</style>
<script>
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
			$('#formulario').submit();
			$('.user-assignments-role-list ul').find('li').each(function(){
				$(this).removeClass('selected');
			});
			$(this).addClass('selected');
			_setSelectedItemName(itemName);
		});
	});
</script>

