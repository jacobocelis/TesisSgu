<?php
/* @var $this NeumaticosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Neumáticos'=>array('index'),
	'Plantillas de montaje',
);

$this->menu=array(
	array('label'=>'      Plantillas de montaje', 'url'=>array('plantilla')),
	array('label'=>'      Montajes-Desmontajes', 'url'=>array('')),
	array('label'=>'      Rotaciones', 'url'=>array('')),
	array('label'=>'      Admin. de parámetros', 'url'=>array('')),
);
?>

<div class='crugepanel user-assignments-role-list'>
<h1>Plantillas de montaje</h1>
<div id="desplegable">
		<?php
		echo CHtml::dropDownList("plantilla","",CHtml::listData(Chasis::model()->findAll(),'id','nombre'),array(
			'prompt'=>"Seleccione: ",'style' => 'width:150px;')); ?>
			
<?php 
//echo $chasis->getTotalItemCount();
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'chasis',
				'summaryText'=>'',
			   // 'enableSorting' => false,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>0,
				'emptyText'=>'seleccione una plantilla',
                'dataProvider'=>$chasis,
				'htmlOptions'=>array('style'=>'width:500px;float:right'),
				'columns'=>array(
				array(
					'headerHtmlOptions'=>array('style'=>'width:15%'),
					'header'=>'# Ejes',
					'name'=>'nroEjes',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px'),
				),
				array(
				'headerHtmlOptions'=>array('style'=>'width:30%'),
					'header'=>'Neumáticos de Uso',
					'name'=>'cantidadNormales',
					'value'=>'$data->cantidadNormales',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px'),
				),
				array(
				'headerHtmlOptions'=>array('style'=>'width:40%'),
					'header'=>'Neumáticos de Repuesto',
					'name'=>'cantidadRepuesto',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px'),
				),
				array(
					'headerHtmlOptions'=>array('style'=>'width:50px'),
					'header'=>'Eliminar',
					'class'=>'CButtonColumn',
					 'template'=>'{delete}',
					     'buttons'=>array(
						 
							'delete' => array(
								'url'=>'Yii::app()->createUrl("chasis/delete", array("id"=>$data->id))',
						),
					),
				),
			)
        ));
		?>
		<?php echo CHtml::link('Agregar nueva plantilla', "",array('title'=>'una plantilla valida la cantidad de neumáticos que posee un vehiculo',
        'style'=>'cursor: pointer;font-size:13px;margin-left:0px;',
        'onclick'=>"{
		nuevoChasis();}"));?>
</div>
<br>
<div id="llantas">
<div id='activi'><negro>
			Plantilla seleccionada:
			</negro>
			<rojo>
			</rojo>
			</div>
<div id="uno">
<?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'ejes',
				'summaryText'=>'',
			   // 'enableSorting' => false,
			   //'afterAjaxUpdate'=>'mostrar',
			    'selectionChanged'=>'mostrarRuedas',
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>1,
				'emptyText'=>'seleccione una plantilla',
                'dataProvider'=>$llantas,
				'htmlOptions'=>array('style'=>'cursor:pointer;margin-top:10px'),
				'columns'=>array(
				
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;width:80px'),
					'header'=>'Eje',
					'name'=>'nombre',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Posición de eje',
					'name'=>'idposicionEje',
					'value'=>'$data->idposicionEje0->posicionEje',
					'htmlOptions'=>array('style'=>'text-align:center;width:140px'),
				),
				array(
					'header'=>'Neumáticos por eje',
					'name'=>'nroRuedas',
					'htmlOptions'=>array('style'=>'text-align:center;width:160px'),
				),
				array(
						'headerHtmlOptions'=>array('style'=>'text-align:center;width:10px;'),
						'htmlOptions'=>array('style'=>'text-align:center;width:10px'),
						'header'=>'Editar',
						'type'=>'raw',
						'value'=>'CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{editarActividad("\'.Yii::app()->createUrl("actividadesgrupo/update",array("id"=>$data["id"])).\'"); $("#dialog").dialog("open");}\'
                        )
                );',),
			),
        ));
		?>
		<div id="eje">
		<?php echo CHtml::link('Agregar eje', "",array('title'=>'',
        'style'=>'cursor: pointer;font-size:13px;margin-left:0px;background:#A6FFB6',
        'onclick'=>"{
		nuevoEje();}"));?>
		</div>
		<div id="nuevoEje"></div>
</div>
<div id="dos">
	<?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'cauchos',
				'summaryText'=>'',
			   // 'enableSorting' => false,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>0,
				'emptyText'=>'seleccione un eje',
                'dataProvider'=>$ruedas,
				'htmlOptions'=>array('style'=>'margin-top:10px;width:100%'),
				'columns'=>array(
				
				array(
					'header'=>'Posición del neumático',
					'name'=>'idposicionRueda',
					'value'=>'$data->idposicionRueda0->posicionRueda',
					'htmlOptions'=>array('style'=>'text-align:center;width:200px'),
				),
				array(
					'header'=>'Detalle de neumático',
					'value'=>'$data->idcaucho0->idmedidaCaucho0->medida.\' R\'.$data->idcaucho0->idrin0->rin.\' \'.$data->idcaucho0->idpiso0->piso',
					'name'=>'idcaucho',
					'htmlOptions'=>array('style'=>'text-align:center;width:185px'),
				),
				array(
						'headerHtmlOptions'=>array('style'=>'text-align:center;width:10px;'),
						'htmlOptions'=>array('style'=>'text-align:center;'),
						'header'=>'Editar',
						'type'=>'raw',
						'value'=>'CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{editarActividad("\'.Yii::app()->createUrl("actividadesgrupo/update",array("id"=>$data["id"])).\'"); $("#dialog").dialog("open");}\'
                        )
                );',),
			),
        ));
		?>
		<div id="caucho">
		<?php echo CHtml::link('Agregar neumático', "",array('title'=>'',
        'style'=>'cursor: pointer;font-size:13px;margin-left:0px;background:#A6FFB6;',
        'onclick'=>"{
		nuevoCaucho();}"));?>
		</div>
		<div id="nuevoCaucho"></div>
</div>
</div>
</div>
<?php
/*ventana agregar actividad*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'nuevoChasis',
    'options'=>array(
        'title'=>'Nueva plantilla',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>420,
        //'height'=>480,
		'resizable'=>false,	
		'position'=>array(null,130),
    ),
));?>
<div class="divForForm"></div>
 
<?php $this->endWidget();?>

<?php
/*ventana agregar actividad*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'nuevaPos',
    'options'=>array(
        'title'=>'Nueva posición de eje',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>420,
        //'height'=>480,
		'resizable'=>false,	
		'position'=>array(null,130),
    ),
));?>
<div class="divForForm"></div>
 
<?php $this->endWidget();?>

<style>
#uno{
	float:left;
	margin-right:20px;
}
#dos{
	float:left;
	
}
negro{
	color: rgba(0, 0, 0, 1);
}
rojo{
	color: rgba(255, 0, 0, 1);
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
#llantas{
	padding:5px;
	border: 1px solid #A8C5F0;
	overflow:auto;
}
#desplegable{
	padding:5px;
	width:655px;
	border: 1px solid #A8C5F0;
	height:60px; 
}
.grid-view {
    padding: 0px 0px;
}
#menu{
	font-size:15px;
}
.grid-view table.items tr.selected {
    background: none repeat scroll 0% 0% rgba(0, 249, 3, 0.3);
}
.crugepanel {
    background-color: #FFF;
    border: 1px dotted #AAA;
    border-radius: 1px;
    box-shadow: 3px 3px 5px #EEE;
    display: block;
    margin-top: 10px;
    padding: 10px;
	overflow: auto;
}

.grid-view table.items th {
	color: rgba(0, 0, 0, 1);
    text-align: center;
    background: none repeat scroll 0% 0% rgba(0, 138, 255, 0.15);
}
.grid-view table.items th a {
    color: #000;
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
<style>
.ui-progressbar .ui-widget-header {
	background: #FFF;
}
.ui-progressbar {
    border: 0px none;
    border-radius: 0px;
    clear: both;
	margin-bottom: 0px;
}
.progress, .ui-progressbar {
    height: 10px;
}
.ui-corner-all, .ui-corner-bottom, .ui-corner-right, .ui-corner-br {
    border-bottom-right-radius: 0px;
}
.ui-corner-all, .ui-corner-bottom, .ui-corner-left, .ui-corner-bl {
    border-bottom-left-radius: 0px;
}
.ui-corner-all, .ui-corner-top, .ui-corner-right, .ui-corner-tr {
    border-top-right-radius: 0px;
}
.ui-corner-all, .ui-corner-top, .ui-corner-left, .ui-corner-tl {
    border-top-left-radius: 0px;
}
</style>
<script>
$("#eje").hide();
$("#caucho").hide();

function mostrarLinkEje(id){
	if(id=="")
		id=0;
var dir="<?php echo Yii::app()->baseUrl;?>"+"/neumaticos/mostrarLinkEje/";
	$.ajax({  		
          url: dir+id,
        })
  	.done(function(result) {    	
    	     if(result==0)
				$("#eje").show();
			 else
				 $("#eje").hide();
  	});
}
function mostrarLinkCaucho(id){
	if(id=="")
		id=0;
var dir="<?php echo Yii::app()->baseUrl;?>"+"/neumaticos/mostrarLinkCaucho/";
	$.ajax({  		
          url: dir+id,
        })
  	.done(function(result) {    	
    	     if(result==0)
				$("#caucho").show();
			 else
				 $("#caucho").hide();
  	});
}
var va="<?php echo $ca?>";
	$("#plantilla").val(va).change();
$( "#plantilla" ).change(function(){ 
	$.fn.yiiGridView.update('chasis',{ data : "data="+$(this).val()});
	$.fn.yiiGridView.update('ejes',{ data : "data="+$(this).val()});
	$.fn.yiiGridView.update('cauchos',{ data : "idEje=0"});
	var v = $("#plantilla option:selected").val();
	 $('rojo').text($( "#plantilla option[value="+v+"]").text());
	 if(v=="")
		 $('rojo').text("");
	 mostrarLinkEje($(this).val());
});

function actualizarLista(){
var dir="<?php echo Yii::app()->baseUrl;?>"+"/neumaticos/actualizarListaPlantillas";
	$.ajax({  		
          url: dir,
        })
  	.done(function(result) {    	
    	     $('#plantilla').html(result);
			 var v = $("#plantilla option:selected").val();
			 $("#plantilla").val(va).change();
  	});
}
function mostrarRuedas(){
	var idEje = $.fn.yiiGridView.getSelection('ejes');
	$.fn.yiiGridView.update('cauchos',{ data : "idEje="+idEje});
	mostrarLinkCaucho(idEje);
}
function nuevoChasis(){
$('#nuevoChasis').dialog('open');
	jQuery.ajax({
                url: "<?php echo Yii::app()->baseUrl;?>"+"/Chasis/agregar",
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        $('#nuevoChasis div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        $('#nuevoChasis div.divForForm form').submit(nuevoChasis);
                                }
                                else{
                                        $('#nuevoChasis div.divForForm').html(data.div);
                                        setTimeout("$('#nuevoChasis').dialog('close') ",1000);
										actualizarLista();
                                }
                },
                'cache':false});
    return false; 
}
function nuevoEje(){
	$('#nuevoEje').show();
	$('#eje').hide();
	var id = $("#plantilla option:selected").val();
	jQuery.ajax({
                url: "<?php echo Yii::app()->baseUrl;?>"+"/Detalleeje/agregar/"+id,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        $('#nuevoEje').html(data.div);
                                        $('#nuevoEje form').submit(nuevoEje);
                                }
                                else{
                                        $('#nuevoEje').html(data.div);
                                        setTimeout("$('#nuevoEje').hide();",2000);
										 setTimeout("$('#plantilla').change()",2000);
										$.fn.yiiGridView.update('ejes');
										$('#caucho').hide();
										
                                }
                },
                'cache':false});
    return false; 
}
function nuevoCaucho(){
	$('#nuevoCaucho').show();
	$('#caucho').hide();
	var idEje = $.fn.yiiGridView.getSelection('ejes');
	jQuery.ajax({
                url: "<?php echo Yii::app()->baseUrl;?>"+"/Detallerueda/agregar/"+idEje,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        $('#nuevoCaucho').html(data.div);
                                        $('#nuevoCaucho form').submit(nuevoCaucho);
                                }
                                else{
                                        $('#nuevoCaucho').html(data.div);
                                        setTimeout("$('#nuevoCaucho').hide();",2000);
										setTimeout("mostrarRuedas()",2000);
										$.fn.yiiGridView.update('cauchos');
                                }
                },
                'cache':false});
    return false; 
}
</script>