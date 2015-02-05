<?php 
$this->breadcrumbs=array(
	'Neumáticos'=>array('neumaticos/index'),
	$nom=>array($dir),
	'Actualizar órden de neumáticos',
);
	$this->menu=array(
	array('label'=>'<div id="menu"><strong>Opciones de mantenimiento</strong></div>'),
		array('label'=>'      Registrar actividades de mantenimiento', 'url'=>array('planes')),
		
	array('label'=>'      Crear orden de mantenimiento', 'url'=>array('crearOrdenPreventiva')),

);
?>
<div class='crugepanel user-assignments-role-list'>
	<h1>Actualizar orden de neumáticos</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'ordenes',
				'summaryText'=>'',
			   // 'enableSorting' => false,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>0,
				'emptyText'=>'',
                'dataProvider'=>$orden,
				//'afterAjaxUpdate'=>'recargar',
				//'htmlOptions'=>array('style'=>'cursor:pointer'),
				'columns'=>array(
				array(
					'headerHtmlOptions'=>array('style'=>'width:7%'),
					'header'=>'Orden #',
					//'name'=>'id',
					'value'=>'str_pad((int) $data->id,6,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:150px'),
				),
				
				array(
					'header'=>'Fecha y hora',
					//'name'=>'fecha',
					'value'=>'date("d/m/Y h:i A",strtotime($data->fecha))',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px'),
				),
				array(
					'header'=>'Estado',
					//'name'=>'idestatus',
					'value'=>'$data->idestatus0->estatus',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px'),
				),
				array(
					'header'=>'C. operativo',
					'name'=>'cOperativo',
					'value'=>'$data->cOperativo0->nombre.\'  \'.$data->cOperativo0->apellido',
					'htmlOptions'=>array('style'=>'text-align:center;width:80px'),
				),
				array(
					'header'=>'C. de transporte',
					'name'=>'cTaller',
					'value'=>'$data->cTaller0->nombre.\'  \'.$data->cTaller0->apellido',
					'htmlOptions'=>array('style'=>'text-align:center;width:80px'),
				),
				array(
					'header'=>'Taller asignado',
					'name'=>'taller',
					'value'=>'$data->taller0->nombre',
					'htmlOptions'=>array('style'=>'text-align:center;width:80px'),
				),
				array(
						'headerHtmlOptions'=>array('style'=>'text-align:left;width:10px;text-align:center;background:#B0E3FF'),
						'htmlOptions'=>array('style'=>'text-align:center;width:10px;'),
						'header'=>'Registrar facturación',
						'type'=>'raw',
						'value'=>'CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
										  
                        Yii::app()->createUrl("neumaticos/registrarFacturacion", array("id"=>$data->id,"nom"=>"'.$nom.'","dir"=>"'.$dir.'")),
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                        )
                );',),
				array(
					'header'=>'Lista para cerrar',
					'value'=>'CHTML::checkBox("campo",$data->estado($data->idestatus),array(\'id\'=>"campo1",\'width\'=>4,\'maxlength\'=>2,\'onchange\'=>"return validar($data->id)"))',
					'type'=>'raw',
					'htmlOptions'=>array('style'=>'width: 50px;text-align: center'),
				),
			)
        ));?>
	</div>
<?php if(count($averias->getData())>0){?>
<div class='crugepanel user-assignments-role-list'>
<h1>Averías</h1>
<strong><p></p></strong>
	<?php
	$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'averias',
				'selectableRows'=>0,
				'summaryText'=>'',
			    //'enableSorting' => true,
				'emptyText'=>'no existen averias registradas en ésta orden',
                'dataProvider'=>$averias,
				'columns'=>array(
				array(
					'header'=>'Unidad',
					'name'=>'idhistoricocaucho',
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
					'name'=>'idfallacaucho',
					'value'=>'$data->idfallaCaucho==null?\' \':$data->idfallaCaucho0->falla',
					'htmlOptions'=>array('style'=>'text-align:center'),
				),
				array(
					'header'=>'Serial',
					
					'value'=>'$data->idhistoricoCaucho==null?\' \':$data->idhistoricoCaucho0->serial',
					'htmlOptions'=>array('style'=>'text-align:center;width:70px'),
				),
				array(
					'header'=>'Medida',
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
					'header'=>'Lado',
					'value'=>'$data->idhistoricoCaucho0->iddetalleRueda0->idposicionRueda0->posicionRueda',
					'name'=>'iddetalleRueda',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				
				array(
					'header'=>'Reportó',
					'name'=>'idempleado',
					'value'=>'$data->idempleado==""?\' \':$data->idempleado0->nombre.\' \'.$data->idempleado0->apellido',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px'),
				),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;background:#B0E3FF'),
					'header'=>'Fecha de reparación',
					'name'=>'fechaRealizada',
					'type'=>'raw',
					'value'=>'$data->valores($data->fechaRealizada)?date("d/m/Y",strtotime($data->fechaRealizada)).CHtml::link(
                     CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{registrarMR("\'.Yii::app()->createUrl("Detalleeventoca/actualizar",array("id"=>$data["id"])).\'"); $("#dialog").dialog("open");}\'
                        )
                ):$data->noasignado().CHtml::link(
                     CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{registrarMR("\'.Yii::app()->createUrl("Detalleeventoca/actualizar",array("id"=>$data["id"])).\'"); $("#dialog").dialog("open");}\'
                        )
                )',
					'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
				),
				/*array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;background:#B0E3FF'),
					'htmlOptions'=>array('style'=>'text-align:center;'),
					'header'=>'Registrar fecha',
					'type'=>'raw',
					'value'=>'CHtml::link(
                     CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{registrarMR("\'.Yii::app()->createUrl("Detalleeventoca/actualizar",array("id"=>$data["id"])).\'"); $("#dialog").dialog("open");}\'
                        )
                );',),*/
				array(
					'header'=>'Estado',
					'name'=>'idestatus',
					'type'=>'raw',
					'value'=>'$data->color($data->idestatus,$data->idestatus0->estatus)',
					'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
				),
			)
        ));
		
?>
</div>
<?php }?>
<?php if(count($renovaciones->getData())>0){?>
<div class='crugepanel user-assignments-role-list'>
<h1>Renovaciones</h1>
<strong><p></p></strong>
	<?php
	$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'renovaciones',
				'selectableRows'=>0,
				'summaryText'=>'',
			    //'enableSorting' => true,
				'emptyText'=>'no existen renovaciones a realizar en ésta orden',
                'dataProvider'=>$renovaciones,
				'columns'=>array(
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
					'header'=>'Fecha de renovación',
					'name'=>'fechaRealizada',
					'type'=>'raw',
					'value'=>'$data->valores($data->fechaRealizada)?date("d/m/Y",strtotime($data->fechaRealizada)):$data->noasignado()',
					'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
				),
				/*array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;background:#B0E3FF'),
					'htmlOptions'=>array('style'=>'text-align:center;'),
					'header'=>'Registrar fecha',
					'type'=>'raw',
					'value'=>'CHtml::link(
                     CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{registrarMR("\'.Yii::app()->createUrl("Detalleeventoca/actualizar",array("id"=>$data["id"])).\'"); $("#dialog").dialog("open");}\'
                        )
                );',),*/
				array(
					'header'=>'Estado',
					'name'=>'idestatus',
					'type'=>'raw',
					'value'=>'$data->color($data->idestatus,$data->idestatus0->estatus)',
					'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
				),
			)
        ));
		
?>
</div>
<?php }?>
<?php if(count($rotaciones->getData())>0){?>
<div class='crugepanel user-assignments-role-list'>
<h1>Rotaciones</h1>
<strong><p></p></strong>
	<?php
	$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'rotaciones',
				'selectableRows'=>0,
				'summaryText'=>'',
			    //'enableSorting' => true,
				'emptyText'=>'no existen rotaciones en ésta orden',
                'dataProvider'=>$rotaciones,
				'columns'=>array(
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
						'value'=>'('.$totMov.').CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/ver.png",
                                          "Agregar",array("title"=>"Agregar movimiento de neumáticos")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{mostrarMovimientos("\'.$data["id"].\'");}\'
                        )
                );',),
				array(
					'header'=>'Fecha realizada',
					'name'=>'fechaRealizada',
					'type'=>'raw',
					'value'=>'$data->valores($data->fechaRealizada)?date("d/m/Y",strtotime($data->fechaRealizada)):$data->noasignado()',
					'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
				),
				/*array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;background:#B0E3FF'),
					'htmlOptions'=>array('style'=>'text-align:center;'),
					'header'=>'Registrar fecha',
					'type'=>'raw',
					'value'=>'CHtml::link(
                     CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{registrarR("\'.Yii::app()->createUrl("Rotacioncauchos/actualizar",array("id"=>$data["id"])).\'"); $("#dialog").dialog("open");}\'
                        )
                );',),*/
				array(
					'header'=>'Estado',
					'name'=>'idestatus',
					'type'=>'raw',
					'value'=>'$data->color($data->idestatus,$data->idestatus0->estatus)',
					'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
				),
				
			)
        ));?>
		
		<div id="amovimiento" style="display:none">
<i>La rotación seleccionada incluye los siguientes movimientos:</i>
<?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'movimientos',
				//'selectionChanged'=>'validar',
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
				/*array(
					'header'=>'Eliminar',
					'class'=>'CButtonColumn',
					 'template'=>'{delete}',
					     'buttons'=>array(
							'delete' => array(
								'url'=>'Yii::app()->createUrl("detalleEventoCa/delete", array("id"=>$data->id))',
						),
					),
				),*/
			)
        ));
	/*	 echo CHtml::link('agregar movimiento(+)', "",  // the link for open the dialog
    array(
		'id'=>'agregarMovimiento',
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregarMovimiento(); }"));
		
		echo CHtml::link('Cancelar', "",array('title'=>'Cancelar',
        'style'=>'cursor: pointer;font-size:10px;float:right;',
        'onclick'=>"{cancelarB()}"));*/

?>
</div>
<?php }?>
<?php
/*ventana agregar informacion*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'dialog',
    'options'=>array(
        'title'=>'Registrar fecha',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>500,
        'position'=>array(null,100),
		'resizable'=>false
    ),
));?>
<div class="divForForm"></div>
 
<?php $this->endWidget();?>

<style>
.grid-view table.items tr.selected {
    background: none repeat scroll 0% 0% rgba(0, 249, 3, 0.3);
}
.grid-view {
    padding: 0px 0px;
}
.crugepanel {
    background-color: #FFF;
    border: 1px dotted #AAA;
    border-radius: 1px;
    box-shadow: 3px 3px 5px #EEE;
    display: block;
    margin-top: 10px;
    padding: 10px;
}
h1 {
    font-size: 250%;
    line-height: 40px;
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

var idorden="<?php echo $id;?>";
actualizarCheck(idorden);
function actualizarCheck(idorden){	
var dir="<?php echo Yii::app()->baseUrl."/neumaticos/actualizarCheck"?>";	
		jQuery.ajax({
                url: dir+"/"+idorden,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
				'success':function(data){
					if(data.estado==0)
						$('#campo1').attr('disabled',true);
						else
						$('#campo1').attr('disabled',false);
				},
                'cache':false});
}

var Uurl;
function registrarMR(id){

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
                                        $('#dialog div.divForForm form').submit(registrarMR); // updatePaymentComment
                                }
                                else
                                {
                                        $('#dialog div.divForForm').html(data.div);
										$.fn.yiiGridView.update('averias');
										$.fn.yiiGridView.update('renovaciones');
                                        setTimeout("$('#dialog').dialog('close') ",1000);
										actualizarCheck(idorden);
                                }
                        } ,
                'cache':false});
    return false; 
}
function registrarR(id){

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
                                        $('#dialog div.divForForm form').submit(registrarR); // updatePaymentComment
                                }
                                else
                                {
                                        $('#dialog div.divForForm').html(data.div);
										$.fn.yiiGridView.update('rotaciones');
                                        setTimeout("$('#dialog').dialog('close') ",1000);
										actualizarCheck(idorden);
                                }
                        } ,
                'cache':false});
    return false; 
}

function recargar(){
	window.location.replace("<?php echo Yii::app()->baseUrl."/neumaticos/verOrdenes"?>");	
}
function validar(id){

//var id="<?php echo $id?>";
	var dir="<?php echo Yii::app()->baseUrl."/neumaticos/estatusOrden"?>";
	var y = document.getElementById("campo1").checked;
	if(y==true){
		if(confirm('Confirma que desea poner la orden como lista?')){
			x=1;
			
		}else{
			x=0;
			y=false;
		}	
	}else
		x=0;
	jQuery.ajax({
                url: dir+"/"+x,
                'data':$(this).serialize()+ '&id=' + id,
                'type':'post',
                'dataType':'json',
				'success':function(){
					if(x==1)
						recargar();
				},
                'cache':false});		
				
	$.fn.yiiGridView.update('ordenes');
}
</script>