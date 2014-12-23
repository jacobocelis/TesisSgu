<?php 
$this->breadcrumbs=array(
	'Mantenimiento correctivo'=>array('mttoCorrectivo/index'),
	$nom=>array($dir),
	'Actualizar órden'=>array('mttoCorrectivo/mttocRealizados/','id'=>$id,'nom'=>$nom,'dir'=>$dir),
	'Facturación',
);
	$this->menu=array(
	array('label'=>'<div id="menu"><strong>Historial</strong></div>'),
	array('label'=>'      Histórico de mantenimientos', 'url'=>array('historicoCorrectivo')),
	array('label'=>'      Histórico de gastos', 'url'=>array('historicoGastos')),
	array('label'=>'      Histórico de ordenes', 'url'=>array('historicoOrdenes')),	
);
?>
<div id="factura" class='crugepanel user-assignments-role-list'>
</div>
<div id="detalle" class='crugepanel user-assignments-role-list'>
<h1>Información de facturación</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'factu',
				'summaryText'=>'',
				'selectableRows'=>0,
			    //'enableSorting' => false,
				'emptyText'=>'no existen mantenimientos preventivos registrados',
                'dataProvider'=>$factura,
				'columns'=>array(
					array(
					'header'=>'Fecha de factura',
					'name'=>'fechaFactura',
					'type'=>'raw',
					'value'=>'date("d/m/Y",strtotime($data->fechaFactura))',
					'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
				),
				array(
					'name'=>'codigo',
					'type'=>'raw',
					'value'=>'str_pad((int) $data->codigo,8,"0",STR_PAD_LEFT);',
					'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
				),
				array(
					'header'=>'Proveedor',
					'name'=>'idproveedor',
					'type'=>'raw',
					'value'=>'$data->idproveedor0->nombre',
					'htmlOptions'=>array('style'=>'width:120px;text-align:center;'),
				),
				array(
					'headerHtmlOptions'=>array('style'=>'width:10px;text-align:center;'),
					'header'=>'Sub-Total',
					'name'=>'total',
					'type'=>'raw',
					'value'=>'number_format($data->total, 2,",",".").\' Bs.\'',
					'htmlOptions'=>array('style'=>'width:10px;text-align:center;'),
				),
				array(
					'headerHtmlOptions'=>array('style'=>'width:10px;text-align:center;'),
					'header'=>'IVA',
					'name'=>'iva',
					'type'=>'raw',
					'value'=>'number_format($data->iva, 2,",",".").\' Bs.\'',
					'htmlOptions'=>array('style'=>'width:10px;text-align:center;'),
				),
				array(
					'headerHtmlOptions'=>array('style'=>'width:10px;text-align:center;'),
					'header'=>'Total Facturado',
					'name'=>'totalFactura',
					'type'=>'raw',
					'value'=>'number_format($data->totalFactura, 2,",",".").\' Bs.\'',
					'htmlOptions'=>array('style'=>'width:10px;text-align:center;'),
				),
					array(
						'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;'),
						'htmlOptions'=>array('style'=>'text-align:center;'),
						'header'=>'Modificar datos de factura',
						'type'=>'raw',
						'value'=>'CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{editarFactura("\'.Yii::app()->createUrl("factura/update",array("id"=>$data["id"],"idorden"=>$data["idordenMtto"])).\'");}\'
                        )
                );',),
			)
    ));
?>	
	<p><b>Nota: </b><i>Seleccione una falla para asignar los gastos individuales por vehiculo</p></i>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'actividad',
				'selectionChanged'=>'mostrarRecursos',
				'summaryText'=>'',
				'selectableRows'=>1,
			    'enableSorting' => true,
				'emptyText'=>'no existen mantenimientos preventivos registrados',
                'dataProvider'=>$dataProvider,
				'htmlOptions'=>array('style'=>'cursor:pointer;'),
				'columns'=>array(
				array(
					'header'=>'Unidad',
					'name'=>'idvehiculo',
					'value'=>'str_pad((int) $data->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
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
					'name'=>'idfalla',
					'value'=>'$data->idfalla0->falla',
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
<div id='recur' class='crugepanel user-assignments-detail'>
<?php 
			$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'rec',
			'selectableRows'=>0,
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
					'value'=>'(($data->idinsumo == null?\'\':$data->idinsumo0->insumo).\'\'.($data->idrepuesto == null?\'\':$data->idrepuesto0->repuesto).\'\'.($data->idservicio == null?\'\':$data->idservicio0->servicio)).\'\'.$data->detalle',
					'htmlOptions'=>array('style'=>'width:250px;'),
					//'footer'=>'',
				),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:left;'),
					'header'=>'Cantidad',
					'name'=>'cantidad',
					'htmlOptions'=>array('style'=>'width:50px;'),
					
					//'footer'=>'',
				),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:left;'),
					'header'=>'Unidad',
					'name'=>'idunidad',
					'value'=>'$data->idunidad0->corto',
					'htmlOptions'=>array('style'=>'width:50px;'),
					//'footer'=>'',
				),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:left;'),
					'header'=>'Precio unitario',
					'value'=>'number_format($data->costoUnitario, 2,",",".").\' BsF.\'',
					'name'=>'costoUnitario',
					
					'htmlOptions'=>array('style'=>'width:50px;'),
					//'footer'=>'',
				),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:left;'),
					'header'=>'Total',
					'name'=>'costoTotal',
					'value'=>'number_format($data->costoTotal, 2,",",".").\' Bs.\'',
					'htmlOptions'=>array('style'=>'width:50px;'),
					//'footer'=>'',
				),
				array(
						'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;'),
						'htmlOptions'=>array('style'=>'text-align:center;'),
						'header'=>'Agregar costo',
						'type'=>'raw',
						'value'=>'CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{editarActividad("\'.Yii::app()->createUrl("actividadrecurso/update",array("id"=>$data["id"])).\'"); $("#dialog").dialog("open");}\'
                        )
                );',),
				/*array(
					'header'=>'Eliminar',
					'class'=>'CButtonColumn',
					 'template'=>'{delete}',
					     'buttons'=>array(
							'delete' => array(
								'url'=>'Yii::app()->createUrl("actividadrecursogrupo/delete", array("id"=>$data->id))',
						),
					),
				),*/
			),
	));?>
	<?php echo CHtml::link('Agregar recurso', "",  // the link for open the dialog
    array(
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregarRecurso(); }"));
		?>	
</div>
<?php
/*ventana agregar recurso*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'ModFactura',
    'options'=>array(
        'title'=>'Editar información de factura',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>490,
		'resizable'=>false,
		'position'=>array(null,100),
    ),
));?>
<div class="divForForm"></div> 
<?php $this->endWidget();?>

<?php
/*ventana agregar costo*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'dialog',
    'options'=>array(
        'title'=>'Agregar costo',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>390,
		'position'=>array(null,100),
        //'height'=>260,
		'resizable'=>false
    ),
));?>
<div class="divForForm"></div> 
<?php $this->endWidget();?>

<?php
/*ventana agregar recurso*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'recurso',
    'options'=>array(
        'title'=>'Agregar recurso adicional',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>390,
		'position'=>array(null,100),
		'resizable'=>false
    ),
));?>
<div class="divForForm"></div>
 
<?php $this->endWidget();?>
<style>
.crugepanel {
    background-color: #FFF;
    border: 1px dotted #AAA;
    border-radius: 1px;
    box-shadow: 3px 3px 5px #EEE;
    display: block;
    margin-top: 10px;
    padding: 10px;
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
.grid-view {
    padding: 10px 0;
}
</style>
<script>
$('#recur').hide();
cargar();
function cargar(){
var data=<?php echo $total?>;
if(data==0){
	$('#factura').show();
	$('#detalle').hide();
}
else{
	$('#factura').hide();
	$('#detalle').show();
}
var id=<?php echo $id?>;
var dir="<?php echo Yii::app()->baseUrl."/mttoPreventivo/agregarFactura"?>";
jQuery.ajax({
                url: dir+"/"+id,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        $('#factura').html(data.div);
                                        $('#factura form').submit(cargar);
                                }
                                else{
                                        $('#factura').html(data.div);
										window.setTimeout('location.reload()', 1);
                                }
                        } ,
                'cache':false});
	return false; 
}
function mostrarRecursos(){
var altura = $(document).height();
//$("html, body").animate({scrollTop:altura+"px"},500);
$('#recur').show(500);
	var idAct = $.fn.yiiGridView.getSelection('actividad');
	if(idAct=="")
		$('#recur').hide();
	$.fn.yiiGridView.update('rec',{ data : "idAct="+idAct});
}
var Uurl;
function editarActividad(id){
<?php $factura=$factura->getData();
	if(isset($factura[0]["id"]))
		$idfac=$factura[0]["id"];
	else
		$idfac=0;
?>;
var idfac=<?php echo $idfac?>;
$('#dialog').dialog('open');
	 if (typeof(id)=='string')
                Uurl=id;
	jQuery.ajax({
                url: Uurl,
                'data':$(this).serialize()+'&idfac='+idfac,
                'type':'post',
                'dataType':'json',
                'success':function(data)
                        {
                                if (data.status == 'failure')
                                {
                                        $('#dialog div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        $('#dialog div.divForForm form').submit(editarActividad); // updatePaymentComment
                                }
                                else
                                {
                                        $('#dialog div.divForForm').html(data.div);
                                        setTimeout("$('#dialog').dialog('close') ",1000);
                                        $.fn.yiiGridView.update('rec');
										$.fn.yiiGridView.update('factu');
                                }
                        } ,
                'cache':false});
    return false; 
}
function editarFactura(id){
$('#ModFactura').dialog('open');
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
                                        $('#ModFactura div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        $('#ModFactura div.divForForm form').submit(editarFactura); // updatePaymentComment
                                }
                                else
                                {
                                        $('#ModFactura div.divForForm').html(data.div);
                                        setTimeout("$('#ModFactura').dialog('close') ",1000);
										$.fn.yiiGridView.update('factu');
                                }
                        } ,
                'cache':false});
    return false; 
}
function agregarRecurso(){
$('#recurso').dialog('open');
	var idAct = $.fn.yiiGridView.getSelection('actividad');
	var url="<?php echo Yii::app()->baseUrl."/mttoPreventivo/agregarRecursoAdicional/"?>";
	jQuery.ajax({
                url: url+idAct,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        $('#recurso div.divForForm').html(data.div);
                                        $('#recurso div.divForForm form').submit(agregarRecurso); // updatePaymentComment
                                }
                                else{
                                        $('#recurso div.divForForm').html(data.div);
                                        setTimeout("$('#recurso').dialog('close') ",1000);
                                        $.fn.yiiGridView.update('rec');
										
                                }
                        },
                'cache':false});
    return false; 
}
</script>