<?php
/* @var $this RepuestoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'neumáticos'=>array('neumaticos/index'),
	'Histórico de montajes',
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
	
	array('label'=>'      Crear orden de neumaticos', 'url'=>array('neumaticos/crearOrdenNeumaticos')  , 'visible'=>Yii::app()->user->checkAccess('action_neumaticos_crearordenneumaticos')),
	array('label'=>'      Ver órdenes abiertas <span class="badge badge-'.$this->Color($abiertas).' pull-right">'.$abiertas.'</span>', 'url'=>array('neumaticos/verOrdenes')),
	array('label'=>'      Órdenes listas para cerrar <span class="badge badge-'.$this->Color($listas).' pull-right">'.$listas.'</span>', 'url'=>array('neumaticos/cerrarOrdenes')  , 'visible'=>Yii::app()->user->checkAccess('action_neumaticos_cerrarordenes')),
	
	
	array('label'=>'<div id="menu"><strong>Historial</strong></div>'),
	array('label'=>'      Histórico de averías', 'url'=>array('historicoAverias')),
	array('label'=>'      Histórico de montajes', 'url'=>array('neumaticos/historicoMontajes')),
	//array('label'=>'      Histórico de rotaciones', 'url'=>array('historicoRotaciones')),
	array('label'=>'      Histórico de gastos', 'url'=>array('historicoGastos')),
	array('label'=>'      Histórico de ordenes', 'url'=>array('historicoOrdenes')),
	
	array('label'=>'<div id="menu"><strong>Administrar</strong></div>', 'visible'=>Yii::app()->user->checkAccess('action_neumaticos_parametros')),
	array('label'=>'      Parámetros y datos maestros', 'url'=>array('neumaticos/parametros'), 'visible'=>Yii::app()->user->checkAccess('action_neumaticos_parametros')),
);
?>
<div class='crugepanel user-assignments-role-list'>
<h1>Histórico de montajes</h1>
<div id="filtro" style="width:20%">
<i>Por # de unidad: </i>

		<?php $model=new Vehiculo;	
		echo CHtml::dropDownList('vehiculo',$model,CHtml::listData(Vehiculo::model()->findAll(),'id','numeroUnidad'),
              array('empty' => 'Todos',
                   'style'=>"width:80px;")); 
        ?>
</div>
<div id="fechas" style="float:left;">
<i>Por período: </i>
		<?php echo CHtml::textField('Fechaini', '',array('style'=>'width:80px;cursor:pointer;','size'=>"10","readonly"=>'readonly','placeholder'=>"Inicio",'id'=>'inicio')); ?>
		<?php echo CHtml::textField('Fechafin', '',array('style'=>'width:80px;cursor:pointer;',"readonly"=>'readonly','disabled'=>'disabled','id'=>'fin','placeholder'=>"Fin")); 
		echo CHtml::submitButton('Buscar',array("id"=>"boton","onclick"=>"FiltrarFecha()","style"=>"float:right;margin-top:2px;margin-left:10px;")); ?>
</div>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'historico',
				'summaryText'=>'',
				//se deben definir inicialmente los neumaticos que posee cada vehiculo
			   // 'enableSorting' => false,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>1,
				'emptyText'=>'No hay registros',
                'dataProvider'=>$dataProvider,
				'columns'=>array(
				array(
					'header'=>'Unidad',
					'name'=>'idhistoricocaucho',
					'value'=>'str_pad((int) $data->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:55px'),
				),
				array(
					'type'=>"raw",
					'header'=>'Fecha de montaje',
					'value'=>'$data->fecha=="0000-01-01"?$data->porDefinir($data->fecha):date("d/m/Y",strtotime($data->fecha))',
					'name'=>'fecha',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				/*array(
					'type'=>"raw",
					'header'=>'Serial',
					'value'=>'$data->serial=="0"?$data->porDefinir($data->serial):strtoupper($data->serial);',
					'name'=>'serial',
					'htmlOptions'=>array('style'=>'text-align:center;width:65px'),
				),
				array(
					'type'=>'raw',
					'header'=>'Marca',
					'value'=>'$data->idmarcaCaucho==""?$data->porDefinir(""):$data->idmarcaCaucho0->nombre',
					'name'=>'idmarcaCaucho',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'header'=>'Detalle',
					'value'=>'$data->idcaucho0->idmedidaCaucho0->medida.\' R\'.$data->idcaucho0->idrin0->rin.\' \'.$data->idcaucho0->idpiso0->piso',
					'name'=>'idcaucho',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),*/
				array(
					'header'=>'Eje',
					'value'=>'$data->iddetalleRueda0->iddetalleEje0->idposicionEje0->posicionEje',
					'name'=>'iddetalleRueda',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Posición',
					'value'=>'$data->iddetalleRueda0->idposicionRueda0->posicionRueda',
					'name'=>'iddetalleRueda',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
 
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;'),
					'header'=>'Precio base',
					'name'=>'costounitario',
					'value'=>'$data->costounitario<>0?number_format($data->costounitario, 2,",",".").\' Bs.\':"-"',
					'htmlOptions'=>array('style'=>'text-align:center;'),
					),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;'),
					'header'=>'IVA',
					'value'=>'$data->iva()<>0?number_format($data->iva(), 2,",",".").\' Bs.\':"-"',
					'htmlOptions'=>array('style'=>'text-align:center;'),
					),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;'),
					'header'=>'Total',
					'name'=>'costoTotal',
					'value'=>'$data->costounitario<>0?number_format($data->costounitario+$data->iva(), 2,",",".").\' Bs.\':"-"',
					'htmlOptions'=>array('style'=>' text-align:center;'),
					'footer'=>'<strong>Total: </strong>'.number_format($vehiculo->totalGastosMontajes($dataProvider->getData()), 2,",",".").' Bs.',
					'footerHtmlOptions'=>array("style"=>"text-align:center;background: none repeat scroll 0% 0% rgba(5, 255, 0, 0.35)"),
					
				),
				array(
					'type'=>"raw",
					'headerHtmlOptions'=>array('style'=>'text-align:center;'),
					'header'=>'Estatus',
					'value'=>'$data->coloresEstatus($data)',
					'name'=>'idestatusCaucho',
					'htmlOptions'=>array('style'=>'text-align:center;font-weight: bold;'),
				),
				
					
			),
        ));?>
		<?php
/*ventana agregar actividad*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'nuevaPos',
    'options'=>array(
 
        'autoOpen'=>false,
        'modal'=>true, 
    ),
));?>
<?php $this->endWidget();?>
</div>
<style>
.grid-view table.items th {
	color: #000;
}
#menu{
	font-size:15px;

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
.grid-view table.items th {
    text-align: center;
    background: none repeat scroll 0% 0% rgba(0, 138, 255, 0.15);
}
.grid-view table.items th a {
    color: #000!important;
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
<script type="text/javascript">
$(function($){
	    $.datepicker.regional['es'] = {
	        closeText: 'Cerrar',
	        prevText: 'Anterior',
	        nextText: 'Siguiente',
	        currentText: 'Hoy',
	        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
	        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
	        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
	        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
	        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
	        weekHeader: 'Sm',
	        dateFormat: 'dd/mm/yy',
	        firstDay: 1,
	        isRTL: false,
			changeMonth: true,
            changeYear: true,
	        showMonthAfterYear: false,
	        yearSuffix: '',
	        maxDate: '0d',
	        //minDate: '-30d',
	    };
	    $.datepicker.setDefaults($.datepicker.regional['es']);
		});  
		
		$("#inicio").datepicker({
			onSelect: function(selected) {
				$("#fin").datepicker("option","minDate", selected+" +1d");
				if($("#inicio").val().length==0)
					
					$('#fin').attr("disabled", true);
				else
					$('#fin').attr("disabled", false);
			}
		});
		$("#fin").datepicker({
			onSelect: function(selected) {
				
			}
		});
		
function FiltrarFecha(){
	var hoy="<?php echo date("d/m/Y")?>";
	if($("#fin").val().length==0 && $("#inicio").val().length>0)
		$("#fin").val(hoy);
	$.fn.yiiGridView.update('historico',{ data : "fechaIni="+$("#inicio").val()+"&fechaFin="+$("#fin").val()+"&vehiculo="+$("#vehiculo").val()});
}
</script>