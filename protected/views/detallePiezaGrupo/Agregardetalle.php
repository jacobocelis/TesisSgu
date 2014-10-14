<?php
/* @var $this GrupoController */
/* @var $model Grupo */
/* @var $form CActiveForm */
?>
<?php 
	$this->menu=array(
	array('label'=>'Volver', 'url'=>array('detallepiezagrupo/detallepieza')),
//	array('label'=>'Crear nuevo grupo', 'url'=>array('')),
);
?>
<div class='crugepanel user-assignments-role-list'>
	<h1><?php echo ucfirst(CrugeTranslator::t("Agregar detalle de pieza en grupo"));?></h1>
	
	
	<ul class='auth-item'>
	
	</ul>
</div>
<div class='form'>
<?php $grupo=$grupo->getData();?>
<div class='crugepanel user-assignments-detail'>
	<h6><div id='mostrarSeleccion'><?php echo $grupo['grupo'];?></div></h6>
	<?php 
		$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'_lista1',
			'selectableRows'=>0,
			'dataProvider'=>$model,
			'enablePagination' => false,
			'columns'=>array(
			array(
					'class'=>'CCheckBoxColumn',
					'htmlOptions'=>array('style'=>'visibility:hidden'),
					
				),
				array(
					'header'=>'Repuesto',
					//'name'=>'repuesto',
					'value'=>'$data->idCaracteristicaVehGrupo0->idrepuesto0->repuesto',
					'htmlOptions'=>array('style'=>'width:400px;'),
				),
				array(
					'header'=>'Detalle',
					'name'=>'detallePieza',
					'value'=>'CHTML::textField("campo",$data->detallePieza,array(\'width\'=>200,\'maxlength\'=>200,\'style\'=>\'width: 350px;\' ))',
					'type'=>'raw',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'class'=>'CCheckBoxColumn',
					'htmlOptions'=>array('style'=>'visibility:hidden'),
					
				),
			),
		));
		
			
?>


<div class="derecha">
<?php 
	echo CHtml::button('Agregar',array('submit' =>array('detallePiezaGrupo/Verdetalle/id/'.$id)),array('class'=>'derecha')); ?></div>
</div>
</div>
<style type="text/css">
.derecha {
	
    text-align: right;

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
	max-width: 820px;
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
    width: 40%;
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
    background-image: url("/yii/sgu/protected/modules/cruge/resources/hand-off.png");
}
div.user-assignments-detail #lista2 .boton {
    background-image: url("/yii/sgu/protected/modules/cruge/resources/hand.png");
}
</style>
<script>
$(".derecha").click(function () {
		var total = geTotal();
		$.fn.yiiGridView.update('_lista1',
				{ data : "total="+total });
				alert('Informacion agregada');
			return true;
});
function geTotal(){
		var otherInputs;
		var values = [];
		var data;
		$('.grid-view table.items').children('tbody').children().each(function () {
						$(this).closest('tr').find("input").each(function() {
						otherInputs = $(this).parents('td').siblings().find('input');
							//alert(otherInputs[2]);
							data = $(otherInputs[0]).val();
							//alert(data);
							values.push(data);
							return false;
						});
		});
			return values;
    }
	
</script>