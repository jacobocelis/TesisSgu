<?php
/* @var $this NeumaticosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
'Neumáticos',
	
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
	array('label'=>'      Histórico de montajes', 'url'=>array('historicoMontajes')),
	//array('label'=>'      Histórico de rotaciones', 'url'=>array('historicoRotaciones')),
	array('label'=>'      Histórico de gastos', 'url'=>array('historicoGastos')),
	array('label'=>'      Histórico de ordenes', 'url'=>array('historicoOrdenes')),
	
	array('label'=>'<div id="menu"><strong>Administrar</strong></div>', 'visible'=>Yii::app()->user->checkAccess('action_neumaticos_parametros')),
	array('label'=>'      Parámetros y datos maestros', 'url'=>array('neumaticos/parametros'), 'visible'=>Yii::app()->user->checkAccess('action_neumaticos_parametros')),
);
?>
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
<div class='crugepanel user-assignments-detail'>

<h1>Neumáticos</h1>
<i style='float: left'> Mostrar alerta sí un neumatico no se ha reemplazado luego de
<select id="lista" >
		<?php for($i=1;$i<4;$i++)
			echo '<option value="'.$i.'">'.$i.'</option>';
			?>
		</select> año(s).</i>
<div id="sep">

 <?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'form',
    'enableAjaxValidation'=>false,
)); ?>
		<i>Buscar vehiculo por #:</i>
		<?php $model=new Vehiculo;
		echo CHtml::submitButton('Buscar',array("id"=>"boton","style"=>"float:right;margin-top:2px;margin-left:10px;")); 
		echo $form->dropDownList($model,'id',CHtml::listData(Vehiculo::model()->findAll('activo<>0'),'id','numeroUnidad'),array('prompt'=>'Todos ','style' => 'width:100px;float:right')); ?>
		
<?php $this->endWidget(); ?>
</div>
<?php  $i=0; $total=0;
foreach($montados as $mont){
	$idvehiculo=$veh[$i]->getData();
	if(count($idvehiculo)>0)
		$idve=$idvehiculo[0]["idvehiculo"];

if(count($idvehiculo)>0 and count($mont->getData())>0){ ?>
<div class="cuadro">
<?php
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$veh[$i],
	'emptyText'=>'No hay registros',
	'summaryText'=>'',
	'itemView'=>'vehiculos',
));?><i>*Neumáticos de uso</i><?php
$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>$idve,
				'summaryText'=>'',
				//se deben definir inicialmente los neumaticos que posee cada vehiculo
			   // 'enableSorting' => false,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>0,
			    'rowCssClassExpression'=>'$this->dataProvider->data[$row]->tiempoCambio($data->fecha)>='.$reposicionDias.'?"rojo":"odd"',
				'emptyText'=>'No hay registros',
                'dataProvider'=>$mont,
				'htmlOptions'=>array('style'=>'margin-top:10px;float: left;width:100%'),
				'columns'=>array(
				array(
					'type'=>"raw",
					'header'=>'Fecha de montaje',
					'value'=>'$data->fecha=="0000-01-01"?$data->porDefinir($data->fecha):date("d/m/Y",strtotime($data->fecha))',
					'name'=>'fecha',
					'htmlOptions'=>array('style'=>'text-align:center;width:5px'),
				),
				array(
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
					'header'=>'Medida',
					'value'=>'$data->idcaucho0->idmedidaCaucho0->medida.\' R\'.$data->idcaucho0->idrin0->rin.\' \'.$data->idcaucho0->idpiso0->piso',
					'name'=>'idcaucho',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'header'=>'Eje',
					'value'=>'$data->iddetalleRueda0->iddetalleEje0->idposicionEje0->posicionEje',
					'name'=>'iddetalleRueda',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'header'=>'Posición',
					'value'=>'$data->iddetalleRueda0->idposicionRueda0->posicionRueda',
					'name'=>'iddetalleRueda',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'type'=>"raw",
					'headerHtmlOptions'=>array('style'=>'text-align:center;width:50px;'),
					'header'=>'Estatus',
					'value'=>'$data->coloresEstatus($data)',
					'name'=>'idestatusCaucho',
					'htmlOptions'=>array('style'=>'text-align:center;width:45px;font-weight: bold;'),
				),
			),
        ));?>
<div id="agregar<?php echo $idve;?>" class="agregar"></div>
<br><i>*Neumático(s) de repuesto</i>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'rep'.$idve.'',
				'summaryText'=>'',
			   // 'enableSorting' => false,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>1,
				'emptyText'=>'No hay registros',
                'dataProvider'=>$rep[$i],
				'htmlOptions'=>array('style'=>'margin-top:10px;width:100%'),
				'columns'=>array(
				array(
					'type'=>"raw",
					'header'=>'Fecha de incorporado',
					'value'=>'$data->fecha=="0000-01-01"?$data->porDefinir($data->fecha):date("d/m/Y",strtotime($data->fecha))',
					'name'=>'fecha',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
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
				),
				array(
					"type"=>"raw",
					'header'=>'Estatus',
					'value'=>'$data->coloresEstatus($data)',
					'name'=>'idestatusCaucho',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px;font-weight: bold;'),
				),
			),
        ));
 $total++;	?>
</div>		
<?php
}$i++;}
if($total==0)
	echo "<i><strong>no hay neumáticos registrados</strong></i>";
?>

</div>
<style>
.rojo{
background: none repeat scroll 0% 0% #FFD6D6;
}
 
.agregar{
	float: left;
}
form {
    margin: 0px 0px 0px;
}
#sep{
	margin-bottom: 20px;
	text-align: right;
	font-size: 120%;
}
.cuadro {
    background: none repeat scroll 0% 0% #F9FDFD;
    padding: 5px;
    border: 1px solid #94A8FF;
    margin-top: 5px;

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
.grid-view table.items th {
    text-align: center;
    background: none repeat scroll 0% 0% rgba(0, 138, 255, 0.15);
	color: #000;
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
#lista{
	width:50px;
}
#menu{
	font-size:15px;
}
</style>
<script>
var valor="<?php echo $reposicionDias?>";
$("#lista").val(valor).change();
$("#lista").change(function(){
var dir="<?php echo Yii::app()->baseUrl;?>"+"/neumaticos/alertaCambioCauchos/"+$(this).val();
$.ajax({  		
          url: dir,
        })
  	.done(function( result ) {    	
			location.reload();
  	});
});
$('#form').submit(function() {
        $('#boton').val("Buscando...");
		$('#boton').attr("disabled", true);
        return true; // return false to cancel form action
    });
$( document ).ready(function() {
		$('#boton').val("Buscar");
		$('#boton').attr("disabled", false);
});
</script>
