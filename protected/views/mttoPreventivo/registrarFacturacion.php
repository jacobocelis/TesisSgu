<?php 
$this->breadcrumbs=array(
	'Mantenimiento preventivo'=>array('mttoPreventivo/index'),
	'Mantenimientos iniciales',
);
	$this->menu=array(
	array('label'=>'Ver programas de mantenimiento', 'url'=>array('planes')),
	array('label'=>'Crear programa de mantenimiento', 'url'=>array('crearPlan')),
	array('label'=>'Histórico de mantenimientos', 'url'=>array('')),
	array('label'=>'Regresar', 'url'=>array('index')),
);
?>
<div id="factura" class='crugepanel user-assignments-role-list'>
</div>
<div id="detalle" class='crugepanel user-assignments-role-list'>
<h1>Información de facturación</h1>
<?php

$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'factura',
				'summaryText'=>'',
			    'enableSorting' => false,
				'emptyText'=>'no existen mantenimientos preventivos registrados',
                'dataProvider'=>$factura,
				'columns'=>array(
					array(
					'header'=>'Fecha de factura',
					'name'=>'fechaFactura',
					'type'=>'raw',
					//'value'=>'',
					'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
				),
				array(
					'header'=>'Código de factura',
					'name'=>'codigo',
					'type'=>'raw',
					//'value'=>'',
					'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
				),
				array(
					'header'=>'Proveedor',
					'name'=>'idproveedor',
					'type'=>'raw',
					'value'=>'$data->idproveedor0->nombre',
					'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
				),
				array(
						'headerHtmlOptions'=>array('style'=>'text-align:left;width:20px;text-align:center;'),
						'htmlOptions'=>array('style'=>'text-align:center;width:30px;'),
						'header'=>'Modificar',
						'type'=>'raw',
						'value'=>'CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
										  
                        Yii::app()->createUrl("mttoPreventivo/mttopRealizados", array("id"=>$data->id)),
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                        )
                );',),
			)
    ));
?>	
	<p><b>Nota: </b><i>Seleccione una actividad para asignar los gastos individuales por vehiculo</p></i>

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
					'name'=>'idplan',
					'value'=>'str_pad((int) $data->idplan0->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT)',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px;'),
				),
				array(
					'header'=>'Parte',
					'name'=>'idplan',
					'value'=>'Plangrupo::model()->parte($data->idplan0->idplanGrupo)',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:150px;'),
				),
				array(
					'header'=>'Actividad',
					'name'=>'idactividadMtto',
					'value'=>'$data->idactividadMtto0->actividad',
					'htmlOptions'=>array('style'=>'text-align:center;width:180px;'),
				),
				array(
					'header'=>'Prioridad',
					'name'=>'idprioridad',
					'value'=>'$data->idprioridad0->prioridad',
					'htmlOptions'=>array('style'=>'width:50px;text-align:center;'),
				),
				array(
					'header'=>'Fecha de realizada',
					'name'=>'fechaRealizada',
					'type'=>'raw',
					'value'=>'$data->valores($data->fechaRealizada)?date("d/M/Y",strtotime($data->fechaRealizada)):$data->noasignado()',
					'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
				),
				array(
					'header'=>'Kilometraje al realizarla',
					'name'=>'kmRealizada',
					'type'=>'raw',
					/*'value'=>function($data){
						return '<div class="label label-info">'.$data->ultimoKm.'</div>';
					},*/
					'value'=>'number_format($data->valores($data->kmRealizada))?number_format($data->kmRealizada).\' Km \':$data->noasignado()',
					'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
				),
			)
        ));
?>
</div>
<div id='recur' class='crugepanel user-assignments-detail'>
<?php 
			$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'rec',
			'selectableRows'=>1,
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
					'value'=>'$data->costoUnitario.\' BsF.\'',
					'name'=>'costoUnitario',
					
					'htmlOptions'=>array('style'=>'width:50px;'),
					//'footer'=>'',
				),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:left;'),
					'header'=>'Total',
					'name'=>'costoTotal',
					'value'=>'$data->costoTotal.\' BsF.\'',
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
</div>
<?php
/*ventana agregar recurso*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'dialog',
    'options'=>array(
        'title'=>'Agregar costo',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>390,
        'height'=>260,
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
$('#dialog').dialog('open');
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
                                        $('#dialog div.divForForm form').submit(editarActividad); // updatePaymentComment
                                }
                                else
                                {
                                        $('#dialog div.divForForm').html(data.div);
                                        setTimeout("$('#dialog').dialog('close') ",1000);
                                        $.fn.yiiGridView.update('rec');
                                }
                        } ,
                'cache':false});
    return false; 
}
</script>