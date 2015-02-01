
<div id="scrollingDiv" class="btn" style="display:none">Crear órden de neumáticos</div>
<?php 
	$this->breadcrumbs=array(
	'Neumáticos'=>array('neumaticos/index'),
	'Crear orden de neumáticos',
);
	$this->menu=array(
	array('label'=>'<div id="menu"><strong>Órdenes de neumáticos</strong></div>'),
	array('label'=>'      Crear orden de neumáticos', 'url'=>array('crearOrdenNeumaticos')),
	array('label'=>'      Ver órdenes abiertas <span class="badge badge-'.$this->Color($abiertas).' pull-right">'.$abiertas.'</span>', 'url'=>array('verOrdenes')),
	array('label'=>'      Órdenes listas para cerrar <span class="badge badge-'.$this->Color($listas).' pull-right">'.$listas.'</span>', 'url'=>array('cerrarOrdenes')),
);
?>
<h1>Crear órden de neumáticos</h1>
<i>Puede crear una orden de neumáticos para reparar una <strong>avería</strong> previamente registrada, realizar una <strong>rotación</strong> entre neumáticos de la misma unidad ó entre varias unidades ó para solicitar una <strong>renovación</strong> de los neumáticos actuales en una unidad.</i>
<div class='crugepanel user-assignments-role-list'>

	<h2>Averías por atender</h2>
	<?php //<p><b>Nota: </b><i>Sólo se mostrarán las actividades con menos de 5 dias restantes o que posean atraso</p></i>?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'fallas',
				'selectionChanged'=>'validar',
				'summaryText'=>'',
			    'enableSorting' => true,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>2,
				'emptyText'=>'No hay averías por atender',
                'dataProvider'=>$dataProvider,
				'columns'=>array(
				array(
					//'header'=>'Seleccione las actividades a incluir',
					'class'=>'CCheckBoxColumn',
					'htmlOptions'=>array('style'=>'text-align:center;'),
					//'cssClassExpression'=>'$data->idestatus=="accept" ? "" : "hidden"',
				),
				array(
					'header'=>'Unidad',
					'name'=>'idhistoricoCaucho',
					'value'=>'str_pad((int) $data->idhistoricoCaucho0->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:40px'),
				),
				array(
					'header'=>'Fecha',
					'name'=>'fechaFalla',
					'value'=>'date("d/m/Y",strtotime($data->fechaFalla))',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px'),
				),
			
				array(
					'header'=>'Falla reportada',
					'name'=>'idfallaCaucho',
					'value'=>'$data->idfallaCaucho0->falla',
					'htmlOptions'=>array('style'=>'text-align:center;width:250px'),
				),
				array(
					'header'=>'Reportó',
					'name'=>'idempleado',
					'value'=>'$data->idempleado0->nombre.\' \'.$data->idempleado0->apellido',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px'),
				),
				array(
					'header'=>'Estatus',
					'name'=>'idestatus',
					'value'=>'$data->idestatus0->estatus',
					'htmlOptions'=>array('style'=>'text-align:center;width:60px'),
				),	
			)
        ));
		?>
		</div>
		<div class='crugepanel user-assignments-role-list'>
	<h2>Neumáticos a renovar</h2>
	<?php //<p><b>Nota: </b><i>Sólo se mostrarán las actividades con menos de 5 dias restantes o que posean atraso</p></i>?>
<?php
//if(count($renovaciones->getData())>0)
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'renovaciones',
				'selectionChanged'=>'validar',
				'summaryText'=>'',
			    'enableSorting' => true,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>2,
				'emptyText'=>'No hay neumáticos agregados para renovar',
                'dataProvider'=>$renovaciones,
				'columns'=>array(
				array(
					//'header'=>'Seleccione las actividades a incluir',
					'class'=>'CCheckBoxColumn',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Unidad',
					'name'=>'idhistoricoCaucho',
					'value'=>'str_pad((int) $data->idhistoricoCaucho0->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:40px'),
				),
				array(
					'type'=>"raw",
					'header'=>'Serial',
					'value'=>'$data->idhistoricoCaucho0->serial=="0"?$data->porDefinir($data->idhistoricoCaucho0->serial):strtoupper($data->idhistoricoCaucho0->serial);',
					//'name'=>'serial',
					'htmlOptions'=>array('style'=>'text-align:center;width:65px'),
				),
				array(
					'type'=>'raw',
					'header'=>'Marca',
					'value'=>'$data->idhistoricoCaucho0->idmarcaCaucho==""?$data->porDefinir(""):$data->idhistoricoCaucho0->idmarcaCaucho0->nombre',
					'name'=>'idmarcaCaucho',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'header'=>'Detalle',
					'value'=>'$data->idhistoricoCaucho0->idcaucho0->idmedidaCaucho0->medida.\' R\'.$data->idhistoricoCaucho0->idcaucho0->idrin0->rin.\' \'.$data->idhistoricoCaucho0->idcaucho0->idpiso0->piso',
					'name'=>'idcaucho',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'header'=>'Eje',
					'value'=>'$data->idhistoricoCaucho0->iddetalleRueda0->iddetalleEje0->idposicionEje0->posicionEje',
					'name'=>'iddetalleRueda',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'header'=>'Posición',
					'value'=>'$data->idhistoricoCaucho0->iddetalleRueda0->idposicionRueda0->posicionRueda',
					'name'=>'iddetalleRueda',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'header'=>'Eliminar',
					'class'=>'CButtonColumn',
					 'template'=>'{delete}',
					     'buttons'=>array(
							'delete' => array(
								'url'=>'Yii::app()->createUrl("detalleEventoCa/delete", array("id"=>$data->id))',
						),
					),
				),
				/*array(
					'header'=>'Fecha',
					'name'=>'fechaFalla',
					'value'=>'date("d/m/Y",strtotime($data->fechaFalla))',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px'),
				),*/
			)
        ));
		?>		
		<?php echo CHtml::link('agregar neumático(+)', "",  // the link for open the dialog
    array(
		'id'=>'agregarRenovacion',
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregarRenovacion(); }"));
		?>	
		<div id="arenovar" style="display:none"><?php $this->renderPartial('_formMontaje', array('model'=>new detalleEventoCa,'montados'=>$montados)); ?></div>
</div>

<div class='crugepanel user-assignments-role-list'>
	<h2>Rotaciones</h2>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'rotaciones',
				'selectionChanged'=>'validar',
				'summaryText'=>'',
			    'enableSorting' => true,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>2,
				'emptyText'=>'No hay neumáticos agregados para renovar',
                'dataProvider'=>$rotaciones,
				'htmlOptions'=>array('style'=>'cursor:pointer;'),
				'columns'=>array(
				array(
					//'header'=>'Seleccione las actividades a incluir',
					'class'=>'CCheckBoxColumn',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'type'=>'raw',
					'header'=>'Nombre',
					'name'=>'nombre',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'header'=>'Descripción',
					'name'=>'descripcion',
					'htmlOptions'=>array('style'=>'text-align:center;width:200px'),
				),
				array(
						'headerHtmlOptions'=>array('style'=>'text-align:center;width:12px;'),
						'htmlOptions'=>array('style'=>'text-align:center;'),
						'header'=>'Movimientos',
						'type'=>'raw',
						'value'=>'($data->id==0?\'-\':$data->id).CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/ver.png",
                                          "Agregar",array("title"=>"Agregar movimiento de neumáticos")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{mostrarMovimientos("\'.$data["id"].\'");}\'
                        )
                );',),
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
                                \'onclick\'=>\'{editarRotacion("\'.Yii::app()->createUrl("Rotacioncauchos/update",array("id"=>$data["id"])).\'"); $("#dialog").dialog("open");}\'
                        )
                );',),
				array(
					'header'=>'Eliminar',
					'class'=>'CButtonColumn',
					 'template'=>'{delete}',
					     'buttons'=>array(
							'delete' => array(
								'url'=>'Yii::app()->createUrl("Rotacioncauchos/delete", array("id"=>$data->id))',
						),
					),
				),
			)
        ));
		?>
				<?php echo CHtml::link('nueva rotación(+)', "",  // the link for open the dialog
    array(
		'id'=>'agregarRotacion',
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregarRotacion(); }"));
		?>	
		
<div id="amovimiento" style="display:none">
<i>La rotación seleccionada incluye los siguientes movimientos:</i>
<?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'movimientos',
				'selectionChanged'=>'validar',
				'summaryText'=>'',
			    'enableSorting' => true,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>0,
				'emptyText'=>'No hay movimientos agregados',
                'dataProvider'=>$movimientos,
				'columns'=>array(
			
				/*array(
					'type'=>'raw',
					'header'=>'',
					'value'=>'\'<strong>Origen</strong>\'',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),*/
				array(
					'header'=>'Unidad',
					'name'=>'idhistoricoCaucho',
					'value'=>'str_pad((int) $data->cauchoOrigen0->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:40px'),
				),
				array(
					'header'=>'Eje',
					'value'=>'$data->posicionOrigen==null?\'-\':$data->posicionOrigen0->iddetalleEje0->idposicionEje0->posicionEje',
					'name'=>'iddetalleRueda',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'header'=>'Lado',
					'value'=>'$data->posicionOrigen==null?\'Repuesto\':$data->posicionOrigen0->idposicionRueda0->posicionRueda',
					'name'=>'iddetalleRueda',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				/*array(
					'type'=>'raw',
					'header'=>'',
					'value'=>'\'<strong>Destino</strong>\'',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),*/
				array(
					'type'=>'raw',
					'header'=>'Movimiento',
					'value'=>'
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/arrow_right.png",
                                          "Movimiento",array("title"=>"desde->hacia"))',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'header'=>'Unidad',
					'name'=>'idhistoricoCaucho',
					'value'=>'str_pad((int) $data->cauchoDestino0->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:40px'),
				),
				array(
					'header'=>'Eje',
					'value'=>'$data->posicionDestino==null?\'-\':$data->posicionDestino0->iddetalleEje0->idposicionEje0->posicionEje',
					'name'=>'iddetalleRueda',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'header'=>'Lado',
					'value'=>'$data->posicionDestino==null?\'Repuesto\':$data->posicionDestino0->idposicionRueda0->posicionRueda',
					'name'=>'iddetalleRueda',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'header'=>'Eliminar',
					'class'=>'CButtonColumn',
					 'template'=>'{delete}',
					     'buttons'=>array(
							'delete' => array(
								'url'=>'Yii::app()->createUrl("detalleEventoCa/delete", array("id"=>$data->id))',
						),
					),
				),
			)
        ));
		 echo CHtml::link('agregar movimiento(+)', "",  // the link for open the dialog
    array(
		'id'=>'agregarMovimiento',
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregarMovimiento(); }"));
		
		echo CHtml::link('Cancelar', "",array('title'=>'Cancelar',
        'style'=>'cursor: pointer;font-size:10px;float:right;',
        'onclick'=>"{cancelarB()}"));
		
		?>				
</div>
		<div id="agregarmovimiento" style="display:none"><?php $this->renderPartial('_formRotacion', array('model'=>new detalleEventoCa,'montadosR'=>$montadosR)); ?></div>
</div>
<?php
/*ventana agregar recurso*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'formulario',
    'options'=>array(
        'title'=>'Crear orden de neumáticos',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>490,
        //'height'=>360,
		'position'=>array(null,100),
		'resizable'=>false
    ),
));?>
<div class="divForForm"></div>
 
<?php $this->endWidget();?>

<?php
/*ventana agregar informacion*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'dialog',
    'options'=>array(
        'title'=>'Nueva rotación',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>400,
        //'height'=>255,
		'position'=>array(null,100),
		'resizable'=>false
    ),
));?>
<div class="divForForm">
</div>
<?php $this->endWidget();?>
<style>
.hidden {
    display: none;
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
	overflow:auto;
}
.grid-view {
    padding: 15px 0px 0px;
}
form {
    margin: 0px 0px 0px;
}
h1 {
    font-size: 270%;
    line-height: 40px;
}
h2{
	font-size: 200%;
    line-height: 40px;
}
#scrollingDiv{
	position: fixed;
}
.btn {
	-moz-box-shadow:inset 0px 1px 0px 0px #54a3f7;
	-webkit-box-shadow:inset 0px 1px 0px 0px #54a3f7;
	box-shadow:inset 0px 1px 0px 0px #54a3f7;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #007dc1), color-stop(1, #0061a7));
	background:-moz-linear-gradient(top, #007dc1 5%, #0061a7 100%);
	background:-webkit-linear-gradient(top, #007dc1 5%, #0061a7 100%);
	background:-o-linear-gradient(top, #007dc1 5%, #0061a7 100%);
	background:-ms-linear-gradient(top, #007dc1 5%, #0061a7 100%);
	background:linear-gradient(to bottom, #007dc1 5%, #0061a7 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#007dc1', endColorstr='#0061a7',GradientType=0);
	background-color:#007dc1;
	-moz-border-radius:3px;
	-webkit-border-radius:3px;
	border-radius:3px;
	border:1px solid #124d77;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Verdana;
	font-size:13px;
	font-weight:bold;
	padding:6px 4px;
	text-decoration:none;
	text-shadow:0px 1px 0px #154682;
}
.btn:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #0061a7), color-stop(1, #007dc1));
	background:-moz-linear-gradient(top, #0061a7 5%, #007dc1 100%);
	background:-webkit-linear-gradient(top, #0061a7 5%, #007dc1 100%);
	background:-o-linear-gradient(top, #0061a7 5%, #007dc1 100%);
	background:-ms-linear-gradient(top, #0061a7 5%, #007dc1 100%);
	background:linear-gradient(to bottom, #0061a7 5%, #007dc1 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#0061a7', endColorstr='#007dc1',GradientType=0);
	background-color:#0061a7;
	color: #fff;
}

</style>
<script>
var ancho=$(window).width()-($(window).width()*0.20);
$('#scrollingDiv').css({
  'right':ancho,
  'bottom': '50px'
 });
	/*$().ready(function() {
		var $scrollingDiv = $("#scrollingDiv");
 
		$(window).scroll(function(){			
			$scrollingDiv
				.stop()
				.animate({"marginTop": ($(window).scrollTop()  -30) + "px"}, "fast" );			
		});
	});*/
	
var idRotacion;

$( "#scrollingDiv" ).click(function() {
	$('#scrollingDiv').hide(300);
	$("#formulario").dialog('open');
});

function validar(){
var idren = $.fn.yiiGridView.getSelection('renovaciones');
var idfalla = $.fn.yiiGridView.getSelection('fallas');
var idrot = $.fn.yiiGridView.getSelection('rotaciones');

	if(idfalla=="" && idrot=="" && idren=="")
		/*$('#formulario').hide(); */
		$('#scrollingDiv').hide(300);
	else
		$('#scrollingDiv').show(300);
		/*$('#formulario').show();*/
	
	var idrot = $.fn.yiiGridView.getSelection('rotaciones');
	if(idrot=="")
		$('#amovimiento').hide();
		
jQuery.ajax({
                url: "crearOrden",
                'data':$(this).serialize()+'&idfalla=' + idfalla + '&idren=' + idren + '&idrot=' + idrot,
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        $('#formulario div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        $('#formulario div.divForForm form').submit(validar); // 
                                }
                                else{
                                        $('#formulario div.divForForm').html(data.div);
										setTimeout("$('#formulario').dialog('close') ",1);
										$('#scrollingDiv').hide();
										window.setTimeout('location.reload()', 1);
                                }
                        } ,
                'cache':false});
		return false; 
}
function agregarRenovacion(){
	$('#arenovar').show(800);
	$('#agregarRenovacion').hide();
}

function agregarMovimiento(){
	$('#agregarmovimiento').show(800);
	$('#agregarMovimiento').hide();
}

function agregarRotacion(){
	$("#dialog").dialog("open");
	
	var dir="<?php echo Yii::app()->baseUrl;?>"+"/neumaticos/AgregarRotacionNueva/";
	jQuery.ajax({
                url: dir,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure')
                                {
                                        $('#dialog div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        $('#dialog div.divForForm form').submit(agregarRotacion); // updatePaymentComment
                                }
                                else
                                {
                                        $('#dialog div.divForForm').html(data.div);
                                        setTimeout("$('#dialog').dialog('close') ",1000);
										$.fn.yiiGridView.update('rotaciones');
                                }
                        },
                'cache':false});
    return false; 
	/*
	$("#listaA").val("").change();
	$("#listaB").val("").change();*/
	$('#agregarRotacion').hide();
}
function mostrarMovimientos(id){
	idRotacion=id;
$('#agregarRotacion').hide();
var altura = $(document).height();
//$("html, body").animate({scrollTop:altura+"px"},500);
//$('#recur').show(500);
	//var idAct = $.fn.yiiGridView.getSelection('act');
	$('#amovimiento').show(500);
	//if(idAct=="")
	//	$('#recur').hide();
	$.fn.yiiGridView.update('movimientos',{ data : "idRot="+id});
	$("html, body").animate({scrollTop:altura+"px"},1000);
}
function cancelarB(){
	$("#agregarRotacion").show();
	$('#amovimiento').hide(500);
	$('#agregarmovimiento').hide();
}
</script>