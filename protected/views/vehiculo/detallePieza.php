
<?php 

$this->breadcrumbs=array(
	'Vehiculos'=>array('index'),
	'Partes'=>array('vehiculo/'.$id),
	$id,
);
	$this->menu=array(
	array('label'=>'Registrar pieza', 'url'=>array('repuesto/create')),
	array('label'=>'Asignar pieza a grupo', 'url'=>array('asignarPiezaGrupo/AsignarPieza')),
	array('label'=>'Regresar', 'url'=>array('vehiculo/'.$id)),
);
?>
<div class='form'>
<div class='crugepanel user-assignments-role-list'>
	<h1><?php echo ucfirst(CrugeTranslator::t("Piezas de la unidad # ".$id));?></h1>
	<p><?php echo ucfirst(CrugeTranslator::t(""));?></p>
</div>
<div class='crugepanel user-assignments-detail'>
	<h6><div id='mostrarSeleccion'>Piezas Registradas:</div></h6>

<?php 	//$var='$("#mydialog").dialog("open"); return false;';
		$this->widget('zii.widgets.grid.CGridView', array(
			'htmlOptions' => array('class' => 'nueva'),
			'id'=>'lista',
			//'hideHeader'=>true,
			'enableSorting' => false,
			'emptyText' => '',
			'summaryText' => '',
			'selectableRows'=>1,
			'dataProvider'=>$vacio,
			'enablePagination' => false,
			'columns'=>array(					                       
				array(
					'header'=>'Pieza',
					'name'=>'idrepuesto',
					'value'=>'$data->idrepuesto0->repuesto',
					'headerHtmlOptions'=>array('style'=>'width:410px;'),
				),
				array(
					'header'=>'Parte de',
					'name'=>'idrepuesto',
					'value'=>'$data->idrepuesto0->idsubTipoRepuesto0->subTipo',
					'headerHtmlOptions'=>array('style'=>'width:410px;'),
				),
				array(
					'header'=>'Cantidad',
					'name'=>'cantidad',
					'headerHtmlOptions'=>array('style'=>'width:110px;'),
				),
				/*array(
                        'header'=>'Detalle',
                        'type'=>'raw',
						//'value'=>"CHtml::link(CHtml::encode('ver'), array('view', 'id'=>'id'))",
                        'value'=> 'CHtml::link(CHtml::image(Yii::app()->request->baseUrl."/imagenes/ver.png",
                                          "Ver",array("title"=>"Ver")),array("verDetalle","id"=>$data->id),array("Verdetalle","id"=>$data->id))."    ".CHtml::link(CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Ver")),array("agregarDetalle","id"=>$data->id),array("Agregardetalle","id"=>$data->id))',
						'htmlOptions'=>array('style'=>'text-align:center;width:10px'),
				),  */       
			),
		));
	?>	

<?php 	//$var='$("#mydialog").dialog("open"); return false;';
		$this->widget('zii.widgets.grid.CGridView', array(
		'htmlOptions'=>array('style'=>'cursor: pointer;'),
			'id'=>'_lista1',
			'hideHeader'=>true,
			'summaryText' => '',
			'selectableRows'=>1,
			'enableSorting' => false,
			'selectionChanged'=>'mostrarDetalles',
			'emptyText' => 'no hay piezas registradas',
			'dataProvider'=>$model,
			'enablePagination' => false,
			'columns'=>array(         
				array(
					'header'=>'Pieza',
					'name'=>'idrepuesto',
					'value'=>'$data->idrepuesto0->repuesto',
					
					'htmlOptions'=>array('style'=>'width:405px;text-align:center;'),
				),
				array(
					'header'=>'Parte de',
					'name'=>'idrepuesto',
					'value'=>'$data->idrepuesto0->idsubTipoRepuesto0->subTipo',
					'htmlOptions'=>array('style'=>'width:405px;text-align:center;'),
				),
				array(
					'header'=>'Cantidad',
					'name'=>'cantidad',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px'),
				),
				/*array(
                        'header'=>'Detalle',
                        'type'=>'raw',
						//'value'=>"CHtml::link(CHtml::encode('ver'), array('view', 'id'=>'id'))",
                        'value'=> 'CHtml::link(CHtml::image(Yii::app()->request->baseUrl."/imagenes/ver.png",
                                          "Ver",array("title"=>"Ver")),array("verDetalle","id"=>$data->id),array("Verdetalle","id"=>$data->id))."    ".CHtml::link(CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Ver")),array("agregarDetalle","id"=>$data->id),array("Agregardetalle","id"=>$data->id))',
						'htmlOptions'=>array('style'=>'text-align:center;width:120px'),
				),       */
				/*array(
					'header'=>'Detalle',
					 'type'=>'raw',
					 'value'=>"CHtml::link(CHtml::encode('ver'), array('view', 'id'=>'id'))",
					//'value'=>"CHtml::link('Ver','detalleview', array('onclick'=>'$var')).'   '.CHtml::link('Agregar','#', array('onclick'=>'$var'))",
					'htmlOptions'=>array('style'=>'text-align:center;width:120px;'),
				),*/
			),
			
			//'selectionChanged'=>'function(){document.getElementById("#dialogo").dialog("open");}',
		));
	?>	
<br>
<?php 
		$this->widget('zii.widgets.grid.CGridView', array(
			'htmlOptions' => array('class' => 'nueva'),
			'id'=>'lista',
			'selectableRows'=>1,
			'emptyText' => '',
			'summaryText' => '',
			'dataProvider'=>$detvacio,
			'enableSorting' => false,
			'enablePagination' => false,
			'columns'=>array(
				array(
					'header'=>'Pieza',
					'value'=>'$data->idCaracteristicaVehGrupo0->idrepuesto0->repuesto',
					'headerHtmlOptions'=>array('style'=>'width:200px;'),
				),
				array(
					'header'=>'Detalle',
					'name'=>'detallePieza',
					'headerHtmlOptions'=>array('style'=>'text-align:center;width:180px;'),
				),
				array(
					'header'=>'Cod. pieza en uso',
					'name'=>'codigoPiezaEnUso',
					'headerHtmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Último cambio',
					'name'=>'fechaIncorporacion',
					'headerHtmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
                        'header'=>'',
                        'type'=>'raw',
						//'value'=>"CHtml::link(CHtml::encode('ver'), array('view', 'id'=>'id'))",
                        'value'=> 'CHtml::link(CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Agregar")),array("agregarDetalle","id"=>$data->id),array("Agregardetalle","id"=>$data->id))',
						'headerHtmlOptions'=>array('style'=>'width:115px'),
				),
			),
		));	
?>
<?php 
		$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'detalle',
			'selectableRows'=>1,
			'hideHeader'=>true,
			'summaryText' => '',
			'emptyText' => 'Selecciona una pieza',
			'dataProvider'=>$detalle,
			'enablePagination' => false,
			'enableSorting' => false,
			'columns'=>array(
				array(
					'header'=>'Pieza',
					'value'=>'$data->idCaracteristicaVeh0->idrepuesto0->repuesto',
					'htmlOptions'=>array('style'=>'width:200px;text-align:center;'),
				),
				array(
					'header'=>'Detalle',
					'name'=>'detallePieza',
					'htmlOptions'=>array('style'=>'text-align:center;width:183px;'),
				),
				array(
					'header'=>'Cod. pieza en uso',
					'name'=>'codigoPiezaEnUso',
					'htmlOptions'=>array('style'=>'text-align:center;width:145px;'),
				),
				array(
					'header'=>'Último cambio',
					'name'=>'fechaIncorporacion',
					 //'value'=>'Yii::app()->dateFormatter->format("d MMM y",strtotime($data->fechaIncorporacion))',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
						'type'=>'raw',
						'value'=>'CHtml::link(CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png","Agregar",array("title"=>"Agregar")),"",
                        array(
                                \'style\'=>\'cursor: pointer; width:50px;text-decoration: underline;\',
                                \'onclick\'=>\'{addDetalle("\'.Yii::app()->createUrl("vehiculo/agregardetalle",array("id"=>$data["id"],"fila"=>$row+1,"veh"=>$data->idCaracteristicaVeh0->idrepuesto0->repuesto)
								).\'"); $("#dialog").dialog("open");}\'
                        )
                );',
				'htmlOptions'=>array('style'=>'width:115px;text-align:center;'),
				),
			),
		));	
?>
<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'dialog',
    'options'=>array(
        'title'=>'Agregar registro',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>420,
        'height'=>270,
		'resizable'=>false
    ),
));?>
<div class="divForForm"></div>
<?php $this->endWidget();?>
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
<style>
.nueva
{
	padding: 0px 0px;
}

.nueva table.items
{
	background: white;
	border-collapse: collapse;
	width: 100%;
	border: 1px #D0E3EF solid;
}

.nueva table.items th, .grid-view table.items td
{
	font-size: 0.9em;
	border: 1px white solid;
	padding: 0.3em;
}

.nueva table.items th
{
	color: black;
	background: #C6DDED;
	text-align: center;
}

.nueva table.items th a
{
	color: black;
	font-weight: bold;
	text-decoration: none;
}

.nueva table.items th a:hover
{
	color: black;
}

.nueva table.items th a.asc
{
	background:url(up.gif) right center no-repeat;
	padding-right: 10px;
}

.nueva table.items th a.desc
{
	background:url(down.gif) right center no-repeat;
	padding-right: 10px;
}

.nueva table.items tr.even
{
	background: #F8F8F8;
}

.nueva table.items tr.odd
{
	background: #E5F1F4;
}

.nueva table.items tr.selected
{
	background: #BCE774;
}

.nueva table.items tr:hover.selected
{
	background: #CCFF66;
}

.nueva table.items tbody tr:hover
{
	background: #ECFBD4;
}

.nueva .link-column img
{
	border: 0;
}

.nueva .button-column
{
	text-align: center;
	width: 60px;
}

.nueva .button-column img
{
	border: 0;
}

.nueva .checkbox-column
{
	width: 15px;
}

.nueva .summary
{
	margin: 0 0 5px 0;
	text-align: right;
}

.nueva .pager
{
	margin: 5px 0 0 0;
	text-align: right;
}

.nueva .empty
{
	font-style: italic;
}

.nueva .filters input,
.nueva .filters select
{
	width: 100%;
	border: 1px solid #ccc;
}
</style>
<style>

.grid-view
{
	padding: 10px 0px;
	overflow-x: auto;
	height: 150px;
}

.grid-view table.items
{
	background: white;
	border-collapse: collapse;
	width: 100%;
	border: 1px #D0E3EF solid;
}

.grid-view table.items th, .grid-view table.items td
{
	font-size: 0.9em;
	border: 1px white solid;
	padding: 0.3em;
}

.grid-view table.items th
{
	color: black;
	background: #C6DDED;
	text-align: center;
}

.grid-view table.items th a
{
	color: black;
	font-weight: bold;
	text-decoration: none;
}

.grid-view table.items th a:hover
{
	color: black;
}

.grid-view table.items th a.asc
{
	background:url(up.gif) right center no-repeat;
	padding-right: 10px;
}

.grid-view table.items th a.desc
{
	background:url(down.gif) right center no-repeat;
	padding-right: 10px;
}

.grid-view table.items tr.even
{
	background: #F8F8F8;
}

.grid-view table.items tr.odd
{
	background: #E5F1F4;
}

.grid-view table.items tr.selected
{
	background: #B6FCBB;
}

.grid-view table.items tr:hover.selected
{
	background: #CCFF66;
}

.grid-view table.items tbody tr:hover
{
	background: #B6FCBB;
}

.grid-view .link-column img
{
	border: 0;
}

.grid-view .button-column
{
	text-align: center;
	width: 60px;
}

.grid-view .button-column img
{
	border: 0;
}

.grid-view .checkbox-column
{
	width: 15px;
}

.grid-view .summary
{
	margin: 0 0 5px 0;
	text-align: right;
}

.grid-view .pager
{
	margin: 5px 0 0 0;
	text-align: right;
}

.grid-view .empty
{
	font-style: italic;
}

.grid-view .filters input,
.grid-view .filters select
{
	width: 100%;
	border: 1px solid #ccc;
}
</style>
<script>
var _updatePaymentComment_url;
function addDetalle(_url){
//$.fn.yiiGridView.update('detalle');
        // If its a string then set the global variable, if its an object then don't set
        if (typeof(_url)=='string')
                _updatePaymentComment_url=_url;

        jQuery.ajax({
                url: _updatePaymentComment_url,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
				
                                if (data.status == 'failure')
                                {   
										$('#dialog div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        $('#dialog div.divForForm form').submit(addDetalle); // updatePaymentComment
                                }
                                else
                                {		
                                        $('#dialog div.divForForm').html(data.div);
                                        setTimeout("$('#dialog').dialog('close') ",1000);
                                        $.fn.yiiGridView.update('detalle');
                                }

                        } ,
                'cache':false});
        return false;
}
function mostrarDetalles(){

var idetalle = $.fn.yiiGridView.getSelection('_lista1');
$.fn.yiiGridView.update('detalle',{ data: "idetalle="+idetalle });
}
</script>