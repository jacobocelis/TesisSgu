<?php
/* @var $this NeumaticosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Neumáticos'=>array('index'),
	'Plantillas de montaje',
);
$this->menu=array(
	array('label'=>'<div id="menu"><strong>Neumáticos</strong></div>'),
	array('label'=>'      Plantillas de montaje', 'url'=>array('plantilla')),
	array('label'=>'      Montajes iniciales <span title="hay '.$iniciales.' montajes iniciales por definir" class="badge badge-'.$this->Color($iniciales).' pull-right">'.$iniciales.'</span>', 'url'=>array('montajeInicial')),
	
	array('label'=>'<div id="menu"><strong>Averías</strong></div>'),
	array('label'=>'      Registro de averías', 'url'=>array('averiaNeumatico')),
	
	array('label'=>'      Averías por atender <span title="hay '.$totalFalla.' averías en neumaticos por atender" class="badge badge-'.$this->Color($totalFalla).' pull-right">'.$totalFalla.'</span>', 'url'=>array('crearOrdenNeumaticos')),
	
	
	array('label'=>'<div id="menu"><strong>Órdenes de neumaticos</strong></div>'),
	
	array('label'=>'      Crear órden de neumaticos', 'url'=>array('crearOrdenNeumaticos')),
	array('label'=>'      Ver órdenes abiertas <span class="badge badge-'.$this->Color($abiertas).' pull-right">'.$abiertas.'</span>', 'url'=>array('verOrdenes')),
	array('label'=>'      Órdenes listas para cerrar <span class="badge badge-'.$this->Color($listas).' pull-right">'.$listas.'</span>', 'url'=>array('cerrarOrdenes')),
	
	
	array('label'=>'<div id="menu"><strong>Historial</strong></div>'),
	array('label'=>'      Histórico de averías', 'url'=>array('historicoAverias')),
	array('label'=>'      Histórico de montajes', 'url'=>array('historicoMontajes')),
	array('label'=>'      Histórico de rotaciones', 'url'=>array('historicoRotaciones')),
	array('label'=>'      Histórico de gastos', 'url'=>array('historicoGastos')),
	array('label'=>'      Histórico de ordenes', 'url'=>array('historicoOrdenes')),
	
	array('label'=>'<div id="menu"><strong>Parámetros</strong></div>'),
	array('label'=>'      Admin. de parámetros', 'url'=>array('')),
);
?>

<div class='crugepanel user-assignments-role-list'>
<h1>Plantillas de montaje</h1>
<div id="desplegable">
	<div id="1">
		<?php
		echo CHtml::dropDownList("plantilla","",CHtml::listData(Chasis::model()->findAll(),'id','nombre'),array(
			'prompt'=>"Seleccione: ",'style' => 'margin-right: 10px;width: 20%;margin-bottom: 0px;')); ?>
		
		<span class="nueva">
		<?php echo CHtml::link('Nueva plantilla', "",array('title'=>'una plantilla valida la cantidad de neumáticos que posee un vehiculo',
        'style'=>'cursor: pointer;font-size:13px;margin-left:0px;',
        'onclick'=>"{
		nuevoChasis();}"));?></span>
		</div>
<div id="2">
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
				'htmlOptions'=>array('style'=>'clear:both;margin-top: 10px;'),
				'columns'=>array(
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
					'headerHtmlOptions'=>array('style'=>'width:50px'),
					'header'=>'Eliminar',
					'class'=>'CButtonColumn',
					 'template'=>'{delete}',
					  'afterDelete'=>'function(link,success,data){
	                               actualizarLista();
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
		</div>
</div>
<br>
<div id="llantas">
<div id='activi'><negro>
			Plantilla seleccionada:
			</negro>
			<rojo>
			</rojo>
			<estado>
			</estado>
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
					'headerHtmlOptions'=>array('style'=>'text-align:center;width:40px'),
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
					'headerHtmlOptions'=>array('style'=>'width:50px'),
					'header'=>'Eliminar',
					
					'class'=>'CButtonColumn',
					 'template'=>'{delete}',
					 'afterDelete'=>'function(link,success,data){
	                               $("#plantilla").change();
								    alert(data);
	                        }',
							
					     'buttons'=>array(
							'delete' => array(
								'url'=>'Yii::app()->createUrl("detalleeje/delete", array("id"=>$data->id))',
						),
					),
				),
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
				'emptyText'=>'Nota:Seleccione un eje para registrar los neumáticos',
                'dataProvider'=>$ruedas,
				'htmlOptions'=>array('style'=>'margin-top:10px;'),
				'columns'=>array(
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;'),
					'header'=>'Eje',
					'name'=>'iddetalleEje',
					'value'=>'$data->iddetalleEje0->nombre',
					'htmlOptions'=>array('style'=>'text-align:center;background:#B2FDB2'),
				),
				array(
					'header'=>'Posición del neumático',
					'name'=>'idposicionRueda',
					'value'=>'$data->idposicionRueda0->posicionRueda',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Detalle',
					'value'=>'$data->idcaucho0->idmedidaCaucho0->medida.\' R\'.$data->idcaucho0->idrin0->rin.\' \'.$data->idcaucho0->idpiso0->piso',
					'name'=>'idcaucho',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					//'headerHtmlOptions'=>array('style'=>'width:50px'),
					'header'=>'Eliminar',
					'class'=>'CButtonColumn',
					 'template'=>'{delete}',
					 'afterDelete'=>'function(link,success,data){
	                               //$("#plantilla").change();
								   actualizarEstado($("#plantilla option:selected").val());
								   $("#caucho").show();
	                        }',
							
					     'buttons'=>array(
							'delete' => array(
								'url'=>'Yii::app()->createUrl("detallerueda/delete", array("id"=>$data->id))',
						),
					),
				),
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
<div id="llantaRep">
<strong>Neumático de repuesto</strong>
	<?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'rep',
				'summaryText'=>'',
			   // 'enableSorting' => false,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>0,
				'emptyText'=>'No hay registro',
                'dataProvider'=>$rep,
				'htmlOptions'=>array('style'=>'margin-top:10px;width:100%'),
				'columns'=>array(
				array(
					 'sortable'=>false,
					'header'=>'Detalle de neumático',
					'value'=>'$data->idcaucho0->idmedidaCaucho0->medida.\' R\'.$data->idcaucho0->idrin0->rin.\' \'.$data->idcaucho0->idpiso0->piso',
					'name'=>'idcaucho',
					'htmlOptions'=>array('style'=>'text-align:center;width:185px'),
				),
				array(
					 
					'headerHtmlOptions'=>array('style'=>'width:50px'),
					'header'=>'Eliminar',
					'class'=>'CButtonColumn',
					 'template'=>'{delete}',
					 'afterDelete'=>'function(link,success,data){
	                               actualizarEstado($("#plantilla option:selected").val());
								   $("#cauchoRep").show();
								  
	                        }',
					     'buttons'=>array(
						 
							'delete' => array(
								'url'=>'Yii::app()->createUrl("cauchorep/delete", array("id"=>$data->id))',
								
						),
					),
				),
			),
        ));
		?>
		<div id="cauchoRep">
		<?php echo CHtml::link('Agregar', "",array('title'=>'',
        'style'=>'cursor: pointer;font-size:13px;margin-left:0px;background:#A6FFB6;',
        'onclick'=>"{
		nuevoCauchoRep();}"));?>
		</div>
		<div id="nuevoCauchoRep"></div>
</div>
<div id="agregarAgrupo"></div>
<div id="divGrupo">
<strong>Plantilla asociada al grupo:</strong>
<?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'grup',
				'summaryText'=>'',
			   // 'enableSorting' => false,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>0,
				'emptyText'=>'No hay registro',
                'dataProvider'=>$grup,
				'htmlOptions'=>array('style'=>'margin-top:10px;width:100%'),
				'columns'=>array(
				array(
					 'sortable'=>false,
					'header'=>'Grupo',
					'value'=>'$data->idgrupo0->grupo',
					'name'=>'idgrupo',
					'htmlOptions'=>array('style'=>'text-align:center;width:185px'),
				),
				array(
					'headerHtmlOptions'=>array('style'=>'width:50px'),
					'header'=>'Eliminar',
					'class'=>'CButtonColumn',
					 'template'=>'{delete}',
					 'afterDelete'=>'function(link,success,data){
	                               actualizarEstado($("#plantilla option:selected").val());
								   $.fn.yiiGridView.update("plantillagrup");
	                        }',
					     'buttons'=>array(
						 
							'delete' => array(
								'url'=>'Yii::app()->createUrl("asigchasis/delete", array("id"=>$data->id))',
								
						),
					),
				),
			),
        ));
		?>
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

<div class='crugepanel user-assignments-role-list'>
<h1>Lista de plantillas asociadas</h1>
<div id="asociados">
<?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'plantillagrup',
				'summaryText'=>'',
			   // 'enableSorting' => false,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>0,
				'emptyText'=>'No hay registros',
                'dataProvider'=>$todo,
				'htmlOptions'=>array('style'=>'margin-top:10px;width:100%'),
				'columns'=>array(
				array(
					 'sortable'=>false,
					'header'=>'Plantilla',
					'value'=>'$data->idchasis0->nombre',
					'name'=>'idchasis',
					'htmlOptions'=>array('style'=>'text-align:center;width:185px'),
				),
				array(
					 'sortable'=>false,
					'header'=>'Grupo',
					'value'=>'$data->idgrupo0->grupo',
					'name'=>'idgrupo',
					'htmlOptions'=>array('style'=>'text-align:center;width:185px'),
				),
				
				array(
					'headerHtmlOptions'=>array('style'=>'width:50px'),
					'header'=>'Eliminar',
					'class'=>'CButtonColumn',
					 'template'=>'{delete}',
					 'afterDelete'=>'function(link,success,data){
	                               //$("#plantilla").change();
								   tieneGrupo($("#plantilla option:selected").val());
	                        }',
					     'buttons'=>array(
						 
							'delete' => array(
								'url'=>'Yii::app()->createUrl("asigchasis/delete", array("id"=>$data->id))',
								
						),
					),
				),
			),
        ));
?>
</div>
<style>
.nueva{
padding: 1px 9px 2px;
border-radius: 9px;
font-size: 11.844px;
font-weight: bold;
line-height: 14px;
color: #FFF;
text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.25);
white-space: nowrap;
vertical-align: baseline;
background-color: #88E993;
padding: 4px;
}
#asociados{
	padding:5px;
	border: 1px solid #A8C5F0;
	width:50%;
}
#divGrupo {
    margin-top: 10px;
    padding: 5px;
    border: 1px solid #A8C5F0;
    width: 370px;
    float: left;
    overflow: auto;
    margin-right: 10px;
}
#uno{
	width: 49%;
	float: left;
	margin-right: 10px;
}
#dos{
	width: 50%;
}
negro{
	color: rgba(0, 0, 0, 1);
}
rojo{
	color: rgba(255, 0, 0, 1);
}
estado{
	float:right;
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
#llantaRep {
    margin-top: 10px;
    padding: 5px;
    border: 1px solid #A8C5F0;
    width: 370px;
    float: left;
    overflow: auto;
    margin-right: 10px;
	min-height:117px;
	
}
#desplegable{
	padding:5px;
	border: 1px solid #A8C5F0;
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
<script>
$("#eje").hide();
$("#caucho").hide();
$("#cauchoRep").hide();
$("#llantaRep").hide();
$("#llantas").hide();
$("#divGrupo").hide();
function mostrarLinkRep(id){
	if(id=="")
		id=0;
var dir="<?php echo Yii::app()->baseUrl;?>"+"/neumaticos/mostrarLinkRep/";
	$.ajax({  		
          url: dir+id,
        })
  	.done(function(result) {    	
    	     if(result==0)
				$("#cauchoRep").show();
			 else
				$("#cauchoRep").hide();
  	});
}
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
function mostrarDivRep(id){
	if(id=="")
		id=0;
var dir="<?php echo Yii::app()->baseUrl;?>"+"/neumaticos/mostrarDivRep/";
	$.ajax({  		
          url: dir+id,
        })
  	.done(function(result) {    	
    	     if(result==0)
				 $("#llantaRep").hide();
			 if(result==1)
				 $("#llantaRep").show();
  	});		
}
function mostrarLinkRep(id){
	if(id=="")
		id=0;
var dir="<?php echo Yii::app()->baseUrl;?>"+"/neumaticos/mostrarLinkRep/";
	$.ajax({  		
          url: dir+id,
        })
  	.done(function(result) {    	
    	     if(result==1)
				 $("#cauchoRep").hide();
			 if(result==0)
				 $("#cauchoRep").show();
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
function actualizarEstado(id){
	if(id=="")
		id=0;
	var dir="<?php echo Yii::app()->baseUrl;?>"+"/neumaticos/actualizarEstado/";
	$.ajax({  		
          url: dir+id,
        })
  	.done(function(result) {
				if(result==-1)
					$('estado').text("");
				if(result==0){
					$('estado').attr('title', 'Debe completar la plantilla para que pueda agregarla a un grupo');
					$('estado').text("Plantilla incompleta").css({ "color": "#FF7500", "cursor":"pointer" });
					$("#agregarAgrupo").hide();
				}
				if(result==2){
					$('estado').attr('title', 'Se han agregado mas neumáticos de los establecidos en la plantilla');
					$('estado').text("Error en la plantilla").css({ "color": "#F00", "cursor":"pointer" });
					$("#agregarAgrupo").hide();
				}
				if(result==1){
					$('estado').text("Plantilla completa").css({ "color": "#66D45F", "cursor":"pointer" });
					$('estado').attr('title', 'La plantilla está completa, ahora puede agregarla a un grupo');
					agregarAgrupo();
					$("#agregarAgrupo").show(500);
				}	
  	});
}

function tieneGrupo(){
var dir="<?php echo Yii::app()->baseUrl;?>"+"/neumaticos/tieneGrupo";
	$.ajax({  		
          url: dir,
        })
  	.done(function(result) {    	
    	     /*if(result==0){
				$("#divGrupo").show();
				$("#agregarAgrupo").hide();
			 }
			 if(result==1){
				$("#divGrupo").hide();
				
			 }
			 if(result==2){
				 $("#divGrupo").hide();
				 $("#agregarAgrupo").hide();
			 }*/
			 $("#Asigchasis_idgrupo").html(result);
			 $('#boton').attr("disabled", false);
			 
  	});
}
var va="<?php echo $ca?>";
	$("#plantilla").val(va).change();
$( "#plantilla" ).change(function(){ 
	$.fn.yiiGridView.update('chasis',{ data : "data="+$(this).val()});
	$.fn.yiiGridView.update('ejes',{ data : "data="+$(this).val()});
	$.fn.yiiGridView.update('cauchos',{ data : "idEje=0"});
	$.fn.yiiGridView.update('rep',{ data : "data="+$(this).val()});
	$.fn.yiiGridView.update('grup',{ data : "data="+$(this).val()});
	var v = $("#plantilla option:selected").val();
	 $('rojo').text($( "#plantilla option[value="+v+"]").text());
	 if(v==""){
		 $('rojo').text("");
		 $('estado').text("");
		 $("#caucho").hide();
		 $("#agregarAgrupo").hide();
		 $("#llantas").hide();
	 }
	 else
		 $("#llantas").show();

	mostrarLinkEje($(this).val());
	mostrarLinkRep($(this).val());
	mostrarDivRep($(this).val());
	actualizarEstado($(this).val());
	tieneGrupo($(this).val());
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
										actualizarEstado($("#plantilla option:selected").val());
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
										actualizarEstado($("#plantilla option:selected").val());
                                }
                },
                'cache':false});
    return false; 
}
function nuevoCauchoRep(){
	$('#nuevoCauchoRep').show();
	$('#cauchoRep').hide();
	var id = $("#plantilla option:selected").val();
	jQuery.ajax({
                url: "<?php echo Yii::app()->baseUrl;?>"+"/cauchorep/agregar/"+id,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        $('#nuevoCauchoRep').html(data.div);
                                        $('#nuevoCauchoRep form').submit(nuevoCauchoRep);
                                }
                                else{
                                        $('#nuevoCauchoRep').html(data.div);
                                        setTimeout("$('#nuevoCauchoRep').hide();",2000);
										//setTimeout("mostrarRuedas()",2000);
										$.fn.yiiGridView.update('rep');
										actualizarEstado($("#plantilla option:selected").val());
                                }
                },
                'cache':false});
    return false; 
}

function agregarAgrupo(){
	
	var id = $("#plantilla option:selected").val();
	jQuery.ajax({
                url: "<?php echo Yii::app()->baseUrl;?>"+"/asigchasis/agregar/"+id,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        $('#agregarAgrupo').html(data.div);
                                        $('#agregarAgrupo form').submit(agregarAgrupo);
                                }
                                else{
                                        //$('#agregarAgrupo').html(data.div);
                                        //setTimeout("$('#agregarAgrupo').hide();",000);
										//setTimeout("$('#divGrupo').show();",000);
										$.fn.yiiGridView.update('grup');
										setTimeout("tieneGrupo()",000);
										$.fn.yiiGridView.update("plantillagrup");
										actualizarSpan();
										//setTimeout("mostrarRuedas()",2000);
										//$.fn.yiiGridView.update('rep');
										//actualizarEstado($("#plantilla option:selected").val());
                                }
                },
                'cache':false});
    return false; 
}

function actualizarSpan(){
	var dir="<?php echo Yii::app()->baseUrl;?>"+"/neumaticos/actualizarSpan";
	$.ajax({
		url: dir,
		'data':$(this).serialize(),
        'dataType':'json',
         'success':function( result ) {
			
    	     $('#mi').removeClass($('#mi').attr('class')).addClass('badge badge-'+result.color+' pull-right');
			 $('#mi').text(result.total);
		},});
}
</script>