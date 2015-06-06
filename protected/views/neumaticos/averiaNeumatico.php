<style>
.badge {
    margin-left: 3px;
}

#etiqueta{
	width: auto;
	float: left;
    height: 35px;
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
.grid-view table.items tr.selected {
    background: none repeat scroll 0 0 #b6fcbb;
}
</style>
<?php 
	$this->breadcrumbs=array(
	'Neumáticos'=>array('index'),
	'Registro de averías',
);
$this->menu=array(
	array('label'=>'<div id="menu"><strong>Neumáticos</strong></div>'),
	array('label'=>'      Neumáticos actuales', 'url'=>array('neumaticos/index')),
	array('label'=>'      Plantillas de montaje', 'url'=>array('plantilla')),
	array('label'=>'      Montajes iniciales <span title="hay '.$iniciales.' montajes iniciales por definir" class="badge badge-'.$this->Color($iniciales).' pull-right">'.$iniciales.'</span>', 'url'=>array('montajeInicial')),
	
	array('label'=>'<div id="menu"><strong>Averías</strong></div>'),
	array('label'=>'      Registro de averías', 'url'=>array('neumaticos/averiaNeumatico')),
	
	array('label'=>'      Averías por atender <span id="aa" title="hay '.$totalFalla.' averías en neumaticos por atender" class="badge badge-'.$this->Color($totalFalla).' pull-right">'.$totalFalla.'</span>', 'url'=>array('neumaticos/listaAveriaNeumatico')),
	
	
	array('label'=>'<div id="menu"><strong>Órdenes de neumaticos</strong></div>'),
	
	array('label'=>'      Crear órden de neumaticos', 'url'=>array('crearOrdenNeumaticos')),
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
);?>
<div class='crugepanel user-assignments-role-list'>
<div id="averia"></div>
<?php $this->renderPartial('_formAveria', array('model'=>$model,'montados'=>$montados)); ?>
</div>
<div id="averia"class='crugepanel user-assignments-role-list'>
<h1>Averías por atender</h1>
<div id="resultado"></div>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'averias',
				'summaryText'=>'',
			    'enableSorting' => true,
				'emptyText'=>'No hay averias registradas',
                'dataProvider'=>$dataProvider,
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
					'htmlOptions'=>array('style'=>'text-align:center'),
				),
			
				array(
					'header'=>'Avería reportada',
					'name'=>'idfallacaucho',
					'value'=>'$data->idfallaCaucho==null?\' \':$data->idfallaCaucho0->falla',
					'htmlOptions'=>array('style'=>'text-align:center'),
				),
				array(
					'type'=>"raw",
					'header'=>'Serial',
					'value'=>'$data->idhistoricoCaucho0->serial=="0"?$data->porDefinir($data->idhistoricoCaucho0->serial):strtoupper($data->idhistoricoCaucho0->serial);',
					'name'=>'serial',
					'htmlOptions'=>array('style'=>'text-align:center'),
				),
				/*array(
					'header'=>'Detalle',
					'value'=>'$data->idhistoricoCaucho0->idcaucho0->idmedidaCaucho0->medida.\' R\'.$data->idhistoricoCaucho0->idcaucho0->idrin0->rin.\' \'.$data->idhistoricoCaucho0->idcaucho0->idpiso0->piso',
					'name'=>'idcaucho',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),*/
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
				/*array(
					'type'=>'raw',
					'header'=>'Neumático',
					//'name'=>'idempleado',
					'value'=>'\'<strong>Serial: </strong>\'.$data->idhistoricoCaucho0->serial.\'<br><strong>Eje:</strong> \'.$data->idhistoricoCaucho0->iddetalleRueda0->iddetalleEje0->idposicionEje0->posicionEje.\'<br><strong>Posición:</strong> \'.$data->idhistoricoCaucho0->iddetalleRueda0->idposicionRueda0->posicionRueda',
					'htmlOptions'=>array('style'=>'text-align:center;width:140px'),
				),*/
				/*array(
					'type'=>'raw',
					'header'=>'Neumático',
					//'name'=>'idempleado',
					'value'=>'\'<strong>Serial: </strong>\'.$data->idhistoricoCaucho0->serial.\'<br><strong>Eje:</strong> \'.$data->idhistoricoCaucho0->iddetalleRueda0->iddetalleEje0->idposicionEje0->posicionEje.\'<strong> Lado:</strong> \'.$data->idhistoricoCaucho0->iddetalleRueda0->idposicionRueda0->posicionRueda',
					'htmlOptions'=>array('style'=>'text-align:center;width:180px'),
				),*/
				array(
					'header'=>'Reportó',
					'name'=>'idempleado',
					'value'=>'$data->idempleado==""?\' \':$data->idempleado0->nombre.\' \'.$data->idempleado0->apellido',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				
				/*array(
					'header'=>'Comentario',
					'name'=>'comentario',
					'value'=>'$data->comentario',
					'htmlOptions'=>array('style'=>'text-align:center;width:250px'),
				),
				array(
					'header'=>'Estado',
					'name'=>'idestatus',
					'value'=>'$data->idestatus0->estatus',
					'htmlOptions'=>array('style'=>'text-align:center;width:80px'),
				),*/
				array(
					'header'=>'Eliminar',
					'class'=>'CButtonColumn',
					 'template'=>'{delete}',
					 'afterDelete'=>'function(link,success,data){
	                             actualizarSpanAverias()
	                        }',
					     'buttons'=>array(
							'delete' => array(
								'url'=>'Yii::app()->createUrl("Detalleeventoca/delete", array("id"=>$data->id))',
						),
					),
				),
			)
        ));
		?>
<?php
/*ventana agregar informacion*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'dialog',
    'options'=>array(
        'title'=>'Registrar avería',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>500,
        'position'=>array(null,100),
		'resizable'=>false
    ),
));?>
<div class="divForForm"></div>
<?php $this->endWidget();?>
</div>

<script>

function AgregarAveriaNueva(){
	$('#dialog').dialog('open');
	var dir="<?php echo Yii::app()->baseUrl;?>"+"/neumaticos/AgregarAveriaNueva/";
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
                                $('#dialog div.divForForm form').submit(AgregarAveriaNueva); // updatePaymentComment
                        }
                        else
                        {
                                $('#dialog div.divForForm').html(data.div);
                                setTimeout("$('#dialog').dialog('close') ",1000);
								actualizarAverias();
                        }
                        },
                'cache':false});
    return false; 
}
function actualizarAverias(){
var dir="<?php echo Yii::app()->baseUrl;?>"+"/neumaticos/ajaxActualizarAverias";
	$.ajax({  		
          url: dir,
        })
  	.done(function(result) {    	
    	     $('#Detalleeventoca_idfallaCaucho').html(result);
  	});
}

//agregarAveria();
/*function agregarAveria(){
	jQuery.ajax({
                url: "RegistrarAveriaNeumatico",
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        $('#averia').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        $('#averia  form').submit(agregarAveria); // updatePaymentComment
                                }
                                else{
                                        $('#averia').html(data.div);
                                        $('#resultado').html(data.mensaje);
                                        $('body').scrollTo('#resultado',{duration:'slow', offsetTop : '0'});
                                        //setTimeout("$('#dialog').dialog('close') ",1000);
                                        //window.setTimeout('agregarAveria()',1000);
										//window.setTimeout('location.reload()', 1000);
										$.fn.yiiGridView.update('averias');
										
										
                                }
                        } ,
                'cache':false});
    return false; 
}*/
function actualizarSpanAverias(){
	var dir="<?php echo Yii::app()->baseUrl;?>"+"/neumaticos/ActualizarSpanAverias";
	$.ajax({
		url: dir,
		'data':$(this).serialize(),
        'dataType':'json',
         'success':function( result ) {
    	     $('#aa').removeClass($('#aa').attr('class')).addClass('badge badge-'+result.color+' pull-right');
			 $('#aa').text(result.total);
		},});
}

</script>

