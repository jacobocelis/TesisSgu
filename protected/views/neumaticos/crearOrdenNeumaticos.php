<style>
.grid-view {
    padding: 15px 0px 0px;
}
form {
    margin: 0px 0px 0px;
}
</style>
<?php 
	$this->breadcrumbs=array(
	'Neumáticos'=>array('neumaticos/index'),
	'Crear orden de neumáticos',
);
$this->menu=array(
	array('label'=>'<div id="menu"><strong>Neumáticos</strong></div>'),
	array('label'=>'      Neumáticos actuales', 'url'=>array('neumaticos/index')),
	array('label'=>'      Plantillas de montaje', 'url'=>array('plantilla')),
	array('label'=>'      Montajes iniciales <span title="hay '.$iniciales.' montajes iniciales por definir" class="badge badge-'.$this->Color($iniciales).' pull-right">'.$iniciales.'</span>', 'url'=>array('montajeInicial')),
	
	array('label'=>'<div id="menu"><strong>Averías</strong></div>'),
	array('label'=>'      Registro de averías', 'url'=>array('averiaNeumatico')),
	
	array('label'=>'      Averías por atender <span title="hay '.$totalFalla.' averías en neumaticos por atender" class="badge badge-'.$this->Color($totalFalla).' pull-right">'.$totalFalla.'</span>', 'url'=>array('neumaticos/listaAveriaNeumatico')),
	
	
	array('label'=>'<div id="menu"><strong>Órdenes de neumaticos</strong></div>'),
	
	array('label'=>'      Crear orden de neumaticos', 'url'=>array('neumaticos/crearOrdenNeumaticos')),
	array('label'=>'      Ver órdenes abiertas <span class="badge badge-'.$this->Color($abiertas).' pull-right">'.$abiertas.'</span>', 'url'=>array('verOrdenes')),
	array('label'=>'      Órdenes listas para cerrar <span class="badge badge-'.$this->Color($listas).' pull-right">'.$listas.'</span>', 'url'=>array('cerrarOrdenes')),
	
	
		
	array('label'=>'<div id="menu"><strong>Historial</strong></div>'),
	array('label'=>'      Histórico de averías', 'url'=>array('historicoAverias')),
	array('label'=>'      Histórico de montajes', 'url'=>array('historicoMontajes')),
	//array('label'=>'      Histórico de rotaciones', 'url'=>array('historicoRotaciones')),
	array('label'=>'      Histórico de gastos', 'url'=>array('historicoGastos')),
	array('label'=>'      Histórico de ordenes', 'url'=>array('historicoOrdenes')),
	
	array('label'=>'<div id="menu"><strong>Administrar</strong></div>' , 'visible'=>'1'),
	array('label'=>'      Parámetros y datos maestros', 'url'=>array('neumaticos/parametros')),
);
?>
<div class='crugepanel user-assignments-role-list'>
<h1>Crear órden de neumáticos</h1>
<i>Puede crear una orden de neumáticos para reparar una <strong>avería</strong> previamente registrada ó para solicitar una <strong>renovación</strong> de los neumáticos actuales en una unidad.</i>
</div>
<div class='crugepanel user-assignments-role-list'>
	<h2>Neumáticos a renovar</h2>
	<?php //<p><b>Nota: </b><i>Sólo se mostrarán las actividades con menos de 5 dias restantes o que posean atraso</p></i>?>
<?php
//if(count($renovaciones->getData())>0)
$this->widget('ext.selgridview.SelGridView', array(
                'id'=>'renovaciones',
				'selectionChanged'=>'validar',
				'summaryText'=>'',
			    'enableSorting' => true,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>2,
				'emptyText'=>'No hay neumáticos agregados para renovar',
                'dataProvider'=>$renovaciones,
                'htmlOptions'=>array('style'=>'cursor:pointer'),
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
					'type'=>"raw",
					'header'=>'Serial',
					'value'=>'$data->idhistoricoCaucho0->serial=="0"?$data->porDefinir($data->idhistoricoCaucho0->serial):strtoupper($data->idhistoricoCaucho0->serial);',
					//'name'=>'serial',
					'htmlOptions'=>array('style'=>'text-align:center;width:65px'),
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
		<?php echo CHtml::link('agregar neumático<img src='.Yii::app()->baseUrl.'/imagenes/agregar.png alt="agregar"/>', "",  // the link for open the dialog
    array(
		'id'=>'agregarRenovacion',
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregarRenovacion(); }"));
		?>
<?php
/*ventana agregar recurso*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'ventanaRenovar',
    'options'=>array(
        'title'=>' ',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'80%',
        //'height'=>360,
		'position'=>array(null,100),
		'resizable'=>false
    ),
));?>
<div id="arenovar" style="display:none"><?php $this->renderPartial('_formMontaje', array('model'=>new detalleEventoCa,'montados'=>$montados)); ?></div>
 
<?php $this->endWidget();?>

		
</div>
<div class='crugepanel user-assignments-role-list'>

	<h2>Averías por atender</h2>
	<?php //<p><b>Nota: </b><i>Sólo se mostrarán las actividades con menos de 5 dias restantes o que posean atraso</p></i>?>
<?php
$this->widget('ext.selgridview.SelGridView', array(
                'id'=>'fallas',
				'selectionChanged'=>'validar',
				'summaryText'=>'',
			    'enableSorting' => true,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>2,
				'emptyText'=>'No hay averías por atender',
				'htmlOptions'=>array('style'=>'cursor:pointer'),
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
					'header'=>'Avería reportada',
					'name'=>'idfallaCaucho',
					'value'=>'$data->idfallaCaucho0->falla',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'type'=>"raw",
					'header'=>'Marca',
					'value'=>'$data->idhistoricoCaucho0->idmarcaCaucho0->nombre;',
					//'name'=>'idmarca',
					'htmlOptions'=>array('style'=>'text-align:center'),
				),
				array(
					'header'=>'Eje',
					'value'=>'$data->idhistoricoCaucho0->iddetalleRueda0->iddetalleEje0->idposicionEje0->posicionEje',
					'name'=>'iddetalleRueda',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Posición',
					'value'=>'$data->idhistoricoCaucho0->iddetalleRueda0->idposicionRueda0->posicionRueda',
					'name'=>'iddetalleRueda',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'type'=>"raw",
					'header'=>'Serial',
					'value'=>'$data->idhistoricoCaucho0->serial=="0"?$data->porDefinir($data->idhistoricoCaucho0->serial):strtoupper($data->idhistoricoCaucho0->serial);',
					'name'=>'serial',
					'htmlOptions'=>array('style'=>'text-align:center'),
				),
				array(
					'header'=>'Reportó',
					'name'=>'idempleado',
					'value'=>'$data->idempleado0->nombre.\' \'.$data->idempleado0->apellido',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Estatus',
					'name'=>'idestatus',
					'value'=>'$data->idestatus0->estatus',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),	
			)
        ));
		?>
<?php echo CHtml::button('Crear orden correctiva', array('id'=>'boton','style'=>"float:left;margin-top:10px", 'onclick'=>'mostrarOrden()','disabled'=>'disabled','class'=>'btn btn-default')); ?>
		</div>

<div style="display:none" class='crugepanel user-assignments-role-list'>
	<h2>Rotaciones</h2>
<?php

		?>
				<?php echo CHtml::link('nueva rotación(+)', "",  // the link for open the dialog
    array(
		'id'=>'agregarRotacion',
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregarRotacion(); }"));
		?>	
	
</div>
<?php
/*ventana agregar recurso*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'rota',
    'options'=>array(
        'title'=>'Movimientos',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>"80%",
        //'height'=>360,
		'position'=>array(null,100),
		'resizable'=>false
    ),
));?>
<div id="amovimiento" style="display:none">
<i>La rotación seleccionada incluye los siguientes movimientos:</i>
<?php 
		 echo CHtml::link('agregar movimiento(+)', "",  // the link for open the dialog
    array(
		'id'=>'agregarMovimiento',
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregarMovimiento(); }"));
		
		echo CHtml::link('Cerrar', "",array('title'=>'Cancelar',
        'style'=>'cursor: pointer;font-size:10px;float:right;',
        'onclick'=>"{cancelarB()}"));
		
		?>				

		<div id="agregarmovimiento" style="display:none"><?php $this->renderPartial('_formRotacion', array('model'=>new detalleEventoCa,'montadosR'=>$montadosR)); ?></div>
</div>
 
<?php $this->endWidget();?>

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

<script>
/*var ancho=$(window).width()-($(window).width()*0.20);
$('#scrollingDiv').css({
  'right':ancho,
  'bottom': '50px'
 });
	$().ready(function() {
		var $scrollingDiv = $("#scrollingDiv");
 
		$(window).scroll(function(){			
			$scrollingDiv
				.stop()
				.animate({"marginTop": ($(window).scrollTop()  -30) + "px"}, "fast" );			
		});
	});*/
	


 function mostrarOrden(){

	
	$("#formulario").dialog('open');

}
var idfalla;

var idren;
function validar(){
idren = $("#renovaciones").selGridView("getAllSelection"); 
idfalla = $("#fallas").selGridView("getAllSelection"); 

	if(idfalla=="" &&  idren=="")
		$( "#boton" ).prop( "disabled", true );
	else
		$( "#boton" ).prop( "disabled", false );
	
	
	/*if(idrot=="")
		$('#amovimiento').hide();*/
	crear();
}
function crear(){
jQuery.ajax({
                url: "crearOrden",
                'data':$(this).serialize()+'&idfalla=' + idfalla + '&idren=' + idren,
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        $('#formulario div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        $('#formulario div.divForForm form').submit(crear); // 
                                }
                                else{
                                        $('#formulario div.divForForm').html(data.div);
										setTimeout("$('#formulario').dialog('close') ",1);
										$('#scrollingDiv').hide();
										//window.setTimeout('location.reload()', 1);
										window.location.replace("<?php echo Yii::app()->baseUrl."/neumaticos/verOrdenes"?>");	
                                }
                        } ,
                'cache':false});
		return false; 
}
function agregarRenovacion(){
	$('#arenovar').show();
	$.fn.yiiGridView.update('vehic2');
	$('#ventanaRenovar').dialog('open');
	//$('#agregarRenovacion').hide();
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
	//idRotacion=id;
	$('#amovimiento').show();
	$("#rota").dialog('open');
//$('#agregarRotacion').hide();
var altura = $(document).height();
//$("html, body").animate({scrollTop:altura+"px"},500);
//$('#recur').show(500);
	//var idAct = $.fn.yiiGridView.getSelection('act');
	
	//if(idAct=="")
	//	$('#recur').hide();
	$.fn.yiiGridView.update('movimientos',{ data : "idRot="+id});
	//$("html, body").animate({scrollTop:altura+"px"},1000);
}
function cancelarB(){
	$("#agregarRotacion").show();
	//$('#amovimiento').hide(500);
	$("#rota").dialog('close');
	//$('#agregarmovimiento').hide();
}
</script>