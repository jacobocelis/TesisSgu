
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
	<h2>Neumáticos a rotar</h2>
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
				'columns'=>array(
				array(
					//'header'=>'Seleccione las actividades a incluir',
					'class'=>'CCheckBoxColumn',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'type'=>'raw',
					'header'=>'',
					'value'=>'\'<strong>Origen</strong>\'',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'header'=>'Unidad',
					'name'=>'idhistoricoCaucho',
					'value'=>'str_pad((int) $data->cauchoOrigen0->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:40px'),
				),
				array(
					'header'=>'Eje',
					'value'=>'$data->posicionOrigen0->iddetalleEje0->idposicionEje0->posicionEje',
					'name'=>'iddetalleRueda',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'header'=>'Posición',
					'value'=>'$data->posicionOrigen0->idposicionRueda0->posicionRueda',
					'name'=>'iddetalleRueda',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'type'=>'raw',
					'header'=>'',
					'value'=>'\'<strong>Destino</strong>\'',
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
					'value'=>'$data->posicionDestino0->iddetalleEje0->idposicionEje0->posicionEje',
					'name'=>'iddetalleRueda',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'header'=>'Posición',
					'value'=>'$data->posicionDestino0->idposicionRueda0->posicionRueda',
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
		?>				
		<?php echo CHtml::link('agregar rotación(+)', "",  // the link for open the dialog
    array(
		'id'=>'agregarRotacion',
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregarRotacion(); }"));
		?>	
		<div id="arotar" style="display:none"><?php $this->renderPartial('_formRotacion', array('model'=>new detalleEventoCa,'montadosR'=>$montadosR)); ?></div>
</div>
<style>
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

</style>
<script>
$('#formulario').hide();
function validar(){
var idren = $.fn.yiiGridView.getSelection('renovaciones');
var idfalla = $.fn.yiiGridView.getSelection('fallas');
var idrot = $.fn.yiiGridView.getSelection('rotaciones');

	if(idfalla=="" && idrot=="" && idren=="")
		$('#formulario').hide();
	else
		$('#formulario').show();
		
jQuery.ajax({
                url: "crearOrden",
                'data':$(this).serialize()+ '&idfalla=' + idfalla,
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        $('#formulario').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        $('#formulario form').submit(validar); // 
                                }
                                else{
                                        $('#formulario').html(data.div);
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
function agregarRotacion(){
	$('#arotar').show(800);
	$('#agregarRotacion').hide();
}
</script>