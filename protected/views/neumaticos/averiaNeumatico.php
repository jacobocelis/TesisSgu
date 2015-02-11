<?php 
	$this->breadcrumbs=array(
	'Neumáticos'=>array('index'),
	'Registro de averías',
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
);?>
<div class='crugepanel user-assignments-role-list'>
<div id="averia"></div>
<?php $this->renderPartial('_formAveria', array('model'=>$model,'montados'=>$montados)); ?>
</div>
<div id="averia"class='crugepanel user-assignments-role-list'>
<h1>Averías registradas</h1>
<div id="registrado">se registró la avería correctamente</div>
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
					'htmlOptions'=>array('style'=>'text-align:center;width:50px'),
				),
			
				array(
					'header'=>'Avería reportada',
					'name'=>'idfallacaucho',
					'value'=>'$data->idfallaCaucho==null?\' \':$data->idfallaCaucho0->falla',
					'htmlOptions'=>array('style'=>'text-align:center;width:250px'),
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
					'header'=>'Reportó',
					'name'=>'idempleado',
					'value'=>'$data->idempleado==""?\' \':$data->idempleado0->nombre.\' \'.$data->idempleado0->apellido',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px'),
				),
				array(
					'header'=>'Estado',
					'name'=>'idestatus',
					'value'=>'$data->idestatus0->estatus',
					'htmlOptions'=>array('style'=>'text-align:center;width:60px'),
				),
				array(
					'header'=>'Comentario',
					'name'=>'comentario',
					'value'=>'$data->comentario',
					'htmlOptions'=>array('style'=>'text-align:center;width:250px'),
				),
				array(
					'header'=>'Eliminar',
					'class'=>'CButtonColumn',
					 'template'=>'{delete}',
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
<style>
.badge {
    margin-left: 3px;
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
#menu {
    font-size: 15px;
}
#etiqueta{
	width: auto;
	float: left;
    height: 35px;
}
</style>
<style>

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
$("#registrado").hide();
var reg="<?php echo $registrado?>";
if(reg==1){
	$('#registrado').css('background','#9EF79C');
	$("#registrado").show();
	//$.scrollTo($('#averia').offset().top-100, { duration:300});
	
      $("html, body").animate({scrollTop:$(document).height()+"px"});


}
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
function agregarAveria(){
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
                                        //setTimeout("$('#dialog').dialog('close') ",1000);
                                        //window.setTimeout('agregarAveria()',1000);
										window.setTimeout('location.reload()', 1000);
										$.fn.yiiGridView.update('averias');
                                }
                        } ,
                'cache':false});
    return false; 
}
</script>

